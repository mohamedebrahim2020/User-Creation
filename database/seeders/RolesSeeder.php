<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!App::runningUnitTests()) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        DB::table('model_has_roles')->truncate();
        Role::truncate();
        $this->seedRoles();
        if (!App::runningUnitTests()) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }

    private function seedRoles(){
        Role::insert([
            ['name' => "admin" , 'guard_name' => 'web'],
            ['name' => "staff", 'guard_name' => 'web'],
            ['name' => "customer", 'guard_name' => 'web'],
        ]);
    }
}
