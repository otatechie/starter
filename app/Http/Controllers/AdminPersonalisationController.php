<?php

namespace App\Http\Controllers;

use App\Models\Personalisation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class AdminPersonalisationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view personalisation');
    }
    

    public function index()
    {
        $personalisation = Personalisation::first();

        return Inertia::render('Admin/Personalisation/IndexPage', [
            'personalisation' => $personalisation,
            'timezones' => $this->getTimezones(),
        ]);
    }


    public function upload(Request $request)
    {
        $this->authorize('upload personalisation files');

        $request->validate([
            'app_logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:2048', 'dimensions:width=32,height=32'],
        ]);

        if ($request->hasFile('app_logo') || $request->hasFile('favicon')) {
            $field = $request->hasFile('app_logo') ? 'app_logo' : 'favicon';

            $file = $request->file($field);
            $fileName = time() . '_' . $file->getClientOriginalName();

            $path = $request->file($field)->storeAs(
                'personalisation',
                $fileName,
                'public'
            );

            $personalisation = Personalisation::firstOrCreate();

            if ($personalisation->$field) {
                if (Storage::disk('public')->exists($personalisation->$field)) {
                    Storage::disk('public')->delete($personalisation->$field);
                }
            }

            $personalisation->update([$field => $path]);

            return response()->json(['path' => Storage::url($path)]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }


    public function update(Request $request)
    {
        $this->authorize('update personalisation');

        $validated = $request->validate([
            'app_logo' => ['nullable', 'string'],
            'app_name' => ['nullable', 'string', 'max:100'],
            'favicon' => ['nullable', 'string'],
            'timezone' => ['required', 'string', 'in:' . implode(',', timezone_identifiers_list())],
            'copyright_text' => ['nullable', 'string', 'max:50'],
        ]);

        $personalisation = Personalisation::firstOrCreate();

        foreach (['app_logo', 'favicon'] as $field) {
            if (array_key_exists($field, $validated) && $validated[$field] === null && $personalisation->$field) {
                Storage::disk('public')->delete($personalisation->$field);
                $validated[$field] = null;
            } else {
                unset($validated[$field]);
            }
        }

        $personalisation->update($validated);

        return redirect()->back()->with('success', 'Settings updated successfully');
    }


    public function delete(Request $request)
    {
        $this->authorize('delete personalisation files');

        $request->validate([
            'field' => ['required', 'string', 'in:app_logo,favicon'],
        ]);

        $field = $request->input('field');
        $personalisation = Personalisation::first();

        if ($personalisation && $personalisation->$field) {
            if (Storage::disk('public')->exists($personalisation->$field)) {
                Storage::disk('public')->delete($personalisation->$field);
            }
            $personalisation->update([$field => null]);
        }

        return response()->json(['success' => true]);
    }


    private function getTimezones()
    {
        $timezones = timezone_identifiers_list();
        $formatted = [];

        foreach ($timezones as $timezone) {
            $formatted[] = [
                'value' => $timezone,
                'label' => str_replace('_', ' ', $timezone)
            ];
        }

        return $formatted;
    }
}
