<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'This field must be accepted.',
    'accepted_if' => 'This field must be accepted when :other is :value.',
    'active_url' => 'This field must be a valid URL.',
    'after' => 'This field must be a date after :date.',
    'after_or_equal' => 'This field must be a date after or equal to :date.',
    'alpha' => 'This field must only contain letters.',
    'alpha_dash' => 'This field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => 'This field must only contain letters and numbers.',
    'array' => 'This field must be an array.',
    'ascii' => 'This field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'This field must be a date before :date.',
    'before_or_equal' => 'This field must be a date before or equal to :date.',
    'between' => [
        'array' => 'This field must have between :min and :max items.',
        'file' => 'This field must be between :min and :max kilobytes.',
        'numeric' => 'This field must be between :min and :max.',
        'string' => 'This field must be between :min and :max characters.',
    ],
    'boolean' => 'This field must be true or false.',
    'can' => 'This field contains an unauthorized value.',
    'confirmed' => 'This field password confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'This field must be a valid date.',
    'date_equals' => 'This field must be a date equal to :date.',
    'date_format' => 'This field must match the format :format.',
    'decimal' => 'This field must have :decimal decimal places.',
    'declined' => 'This field must be declined.',
    'declined_if' => 'This field must be declined when :other is :value.',
    'different' => 'This field and :other must be different.',
    'digits' => 'This field must be :digits digits.',
    'digits_between' => 'This field must be between :min and :max digits.',
    'dimensions' => 'This field has invalid image dimensions.',
    'distinct' => 'This field has a duplicate value.',
    'doesnt_end_with' => 'This field must not end with one of the following: :values.',
    'doesnt_start_with' => 'This field must not start with one of the following: :values.',
    'email' => 'This field must be a valid email address.',
    'ends_with' => 'This field must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'extensions' => 'This field must have one of the following extensions: :values.',
    'file' => 'This field must be a file.',
    'filled' => 'This field must have a value.',
    'gt' => [
        'array' => 'This field must have more than :value items.',
        'file' => 'This field must be greater than :value kilobytes.',
        'numeric' => 'This field must be greater than :value.',
        'string' => 'This field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'This field must have :value items or more.',
        'file' => 'This field must be greater than or equal to :value kilobytes.',
        'numeric' => 'This field must be greater than or equal to :value.',
        'string' => 'This field must be greater than or equal to :value characters.',
    ],
    'hex_color' => 'This field must be a valid hexadecimal color.',
    'image' => 'This field must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'This field must exist in :other.',
    'integer' => 'This field must be an integer.',
    'ip' => 'This field must be a valid IP address.',
    'ipv4' => 'This field must be a valid IPv4 address.',
    'ipv6' => 'This field must be a valid IPv6 address.',
    'json' => 'This field must be a valid JSON string.',
    'lowercase' => 'This field must be lowercase.',
    'lt' => [
        'array' => 'This field must have less than :value items.',
        'file' => 'This field must be less than :value kilobytes.',
        'numeric' => 'This field must be less than :value.',
        'string' => 'This field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'This field must not have more than :value items.',
        'file' => 'This field must be less than or equal to :value kilobytes.',
        'numeric' => 'This field must be less than or equal to :value.',
        'string' => 'This field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'This field must be a valid MAC address.',
    'max' => [
        'array' => 'This field must not have more than :max items.',
        'file' => 'This field must not be greater than :max kilobytes.',
        'numeric' => 'This field must not be greater than :max.',
        'string' => 'This field must not be greater than :max characters.',
    ],
    'max_digits' => 'This field must not have more than :max digits.',
    'mimes' => 'This field must be a file of type: :values.',
    'mimetypes' => 'This field must be a file of type: :values.',
    'min' => [
        'array' => 'This field must have at least :min items.',
        'file' => 'This field must be at least :min kilobytes.',
        'numeric' => 'This field must be at least :min.',
        'string' => 'This field must be at least :min characters.',
    ],
    'min_digits' => 'This field must have at least :min digits.',
    'missing' => 'This field must be missing.',
    'missing_if' => 'This field must be missing when :other is :value.',
    'missing_unless' => 'This field must be missing unless :other is :value.',
    'missing_with' => 'This field must be missing when :values is present.',
    'missing_with_all' => 'This field must be missing when :values are present.',
    'multiple_of' => 'This field must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'This field format is invalid.',
    'numeric' => 'This field must be a number.',
    'password' => [
        'letters' => 'This field must contain at least one letter.',
        'mixed' => 'This field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'This field must contain at least one number.',
        'symbols' => 'This field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'This field is required.',
    'present_if' => 'This field must be present when :other is :value.',
    'present_unless' => 'This field must be present unless :other is :value.',
    'present_with' => 'This field must be present when :values is present.',
    'present_with_all' => 'This field must be present when :values are present.',
    'prohibited' => 'This field is prohibited.',
    'prohibited_if' => 'This field is prohibited when :other is :value.',
    'prohibited_unless' => 'This field is prohibited unless :other is in :values.',
    'prohibits' => 'This field prohibits :other from being present.',
    'regex' => 'This field format is invalid.',
    'required' => 'This field is required.',
    'required_array_keys' => 'This field must contain entries for: :values.',
    'required_if' => 'This field is required when :other is :value.',
    'required_if_accepted' => 'This field is required when :other is accepted.',
    'required_unless' => 'This field is required unless :other is in :values.',
    'required_with' => 'This field is required when :values is present.',
    'required_with_all' => 'This field is required when :values are present.',
    'required_without' => 'This field is required when :values is not present.',
    'required_without_all' => 'This field is required when none of :values are present.',
    'same' => 'This field must match :other.',
    'size' => [
        'array' => 'This field must contain :size items.',
        'file' => 'This field must be :size kilobytes.',
        'numeric' => 'This field must be :size.',
        'string' => 'This field must be :size characters.',
    ],
    'starts_with' => 'This field must start with one of the following: :values.',
    'string' => 'This field must be a string.',
    'timezone' => 'This field must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'Failed to upload.',
    'uppercase' => 'This field must be uppercase.',
    'url' => 'This field must be a valid URL.',
    'ulid' => 'This field must be a valid ULID.',
    'uuid' => 'This field must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
