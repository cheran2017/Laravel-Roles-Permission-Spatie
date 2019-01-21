<?php

use Illuminate\Database\Seeder;
use App\Models\PermissionGroup;
class PermissionGroupTableSeeder extends Seeder
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
				'name' => 'Seeding Permissions',
				'permission_ids' => [1,2,3,4,5,6],
			],
		];
		echo "--------------------------------------------------" . "\n";
		echo "Seeding permissions groups table" . "\n";
		echo "--------------------------------------------------" . "\n";
		$seedCount = 0;
		foreach ($rows as $row) {
			$permission = PermissionGroup::firstOrNew(['name' => $row['name']]);
			foreach ($row as $column => $value) {
				$permission->$column = $value;
			}
			if ($permission->save()) {
				echo "creating permission group:- " . $permission->name . "\n";
				$seedCount++;
			} else {
				echo "Error while seeding: <pre>" . print_r($Model, 1) . "</pre>\n";
			}
		}
		echo 'Total of ' . $seedCount . ' permission groups have been seeded.' . "\n";
    }
}
