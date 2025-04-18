<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = $this->createPermissions();
        $roles = $this->createRoles();
        $this->assignPermissions($roles, $permissions);
    }

    
    private function createPermissions(): array
    {
        $permissionData = [
            // User Management
            'manage-users' => 'Manage user accounts',
            'edit-profile' => 'Edit own profile',
            'ban-users' => 'Ban/suspend user accounts',
            
            // System
            'access-dashboard' => 'Access admin dashboard',
            'manage-settings' => 'Manage system settings',
            
            // Audit & Monitoring
            'view-audits' => 'View system audit logs',
            'view-login-history' => 'View user login history',
            'view-health-checks' => 'View system health checks',
            
            // Backup Management
            'manage-backups' => 'Create and manage system backups',
            'download-backups' => 'Download system backups',
            
            // Personalization
            'manage-personalization' => 'Manage system appearance and branding',
            
            // Roles & Permissions
            'manage-roles' => 'Manage user roles',
            'manage-permissions' => 'Manage permissions and assign to roles',
        ];
        
        $permissions = [];
        
        foreach ($permissionData as $name => $description) {
            $permissions[$name] = Permission::firstOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }
        
        return $permissions;
    }

    
    private function createRoles(): array
    {
        $roleData = [
            'superuser' => 'Superuser with full system access',
            'user' => 'Standard user with limited permissions'
        ];
        
        $roles = [];
        
        foreach ($roleData as $name => $description) {
            $roles[$name] = Role::updateOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }
        
        return $roles;
    }
    
    
    private function assignPermissions(array $roles, array $permissions): void
    {
        // Superuser gets all permissions
        $roles['superuser']->syncPermissions(array_values($permissions));
        
        // Regular user permissions
        $roles['user']->syncPermissions([
            $permissions['edit-profile'],
        ]);
    }
}
