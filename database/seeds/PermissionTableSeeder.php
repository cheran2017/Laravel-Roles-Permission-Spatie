<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
			
			// Dashboard
			[
				'name' => 'Dashboard',
				'guard_name' => 'web',
			],
			[
				'name' => 'Users',
				'guard_name' => 'web',
			],
			[
				'name' => 'Roles',
				'guard_name' => 'web',
			],
			[
				'name' => 'Permissions',
				'guard_name' => 'web',
			],
			[
				'name' => 'Permission Groups',
				'guard_name' => 'web',
			],
			[
				'name' => 'Dashboard-Roles-Permissions-Count',
				'guard_name' => 'web',
			],
		];
		echo "--------------------------------------------------" . "\n";
		echo "Seeding permissions table" . "\n";
		echo "--------------------------------------------------" . "\n";
		$seedCount = 0;
		foreach ($rows as $row) {
			$permission = Permission::firstOrNew(['name' => $row['name']]);
			foreach ($row as $column => $value) {
				$permission->$column = $value;
			}
			if ($permission->save()) {
				echo "creating permission:- " . $permission->name . "\n";
				$seedCount++;
			} else {
				echo "Error while seeding: <pre>" . print_r($Model, 1) . "</pre>\n";
			}
		}
		echo 'Total of ' . $seedCount . ' permissions have been seeded.' . "\n";
    }
}
