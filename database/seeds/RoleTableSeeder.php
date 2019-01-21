<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'guard_name'    => 'web',
                'name'          => 'Super Admin'
            ],
        ];

        echo "--------------------------------------------------"."\n";
        echo "Seeding roles table"."\n";
        echo "--------------------------------------------------"."\n";
        $seedCount = 0;
        foreach ($rows as $row) {
            $role = Role::create(['name' => $row['name']]);
            foreach ($row as $column => $value) {
                $role->$column = $value;
            }
            echo "creating role:- " . $role->name. "\n";

            if ($role->save()) {
            	if($role->id == 1)
                {
                    $permissions = Permission::all();
                    foreach ($permissions as $permission) {
                        echo "giving persion to Super admin Role: $permission->name" . "\n";
                        $role->givePermissionTo($permission->name);
                    }
                }
                $seedCount++;
            } else {
                echo "Error while seeding: <pre>" . print_r($Model, 1) . "</pre>\n";
            }
        }
        echo 'Total of '.$seedCount.' roles have been seeded.'."\n";
    }
}
