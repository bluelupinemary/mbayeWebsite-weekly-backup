<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class PermissionUserSeeder.
 */
class PermissionUserSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.permission_user_table'));

        // Attach executive user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(2);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(3);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(4);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(5);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(6);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(7);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(8);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(9);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(10);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(11);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(12);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        $this->enableForeignKeys();
    }
}
