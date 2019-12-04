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
        DB::table('users')->insert([
            [
                'first_name' => 'Stefan',
                'last_name' => 'Drobnjak',
                'profile_pic' => 'images/profile_pic/1552853937Profilna.png',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => 'b4d1a9de821ccf32107a1f3c846ec5e3',
                'role_id' => 1
            ],
            [
                'first_name' => 'Name',
                'last_name' => 'LastName',
                'profile_pic' => 'images/profile_pic/Default_profile_picture.jpg',
                'email' => 'test@gmail.com',
                'username' => 'korisnik',
                'password' => 'b4d1a9de821ccf32107a1f3c846ec5e3',
                'role_id' => 2
            ],
            [
                'first_name' => 'Name',
                'last_name' => 'LastName',
                'profile_pic' => 'images/profile_pic/Default_profile_picture.jpg',
                'email' => 'drobnjak.stefan18@gmail.com',
                'username' => 'name',
                'password' => 'b4d1a9de821ccf32107a1f3c846ec5e3',
                'role_id' => 2
            ],
        ]);
    }
}
