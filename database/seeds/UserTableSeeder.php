<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
                'first_name' => 'Super Admin',
                'email'      => 'admin@gmail.com',
                'role_id'    => 1,
                'password'   => bcrypt('sst123'),
                'company_ids' => [1],
                'username'    => 'SST000'
            ],
         ];
        $seedCount = 0;
        echo "--------------------------------------------------"."\n";
        echo 'Seeding Users table'."\n";
        echo "--------------------------------------------------"."\n";
        foreach ($rows as $row) {
            $user = User::firstOrnew(['email' => $row['email']]);
            
            if($user->save()) {
                    $user->assignRole('Super Admin');
                    echo "User seeded" . $user->name . "\n";
                    echo "User seeded" . $user->username . "\n";
                    echo "User seeded Role" . $user->getRoleNames() . "\n";
                $seedCount++;

            }
            else {
                echo "Error while seeding: <pre>" . print_r($user, 1) . "</pre>\n";
            }
        }
        echo 'Total of '.$seedCount.' users have been seeded.'."\n";
    }
}
