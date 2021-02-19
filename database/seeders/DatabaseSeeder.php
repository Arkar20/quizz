<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $user= new User();
       $user->name="aung aung";
       $user->email="aung@gmail.com";
       $user->email_verified_at=null;
       $user->password=bcrypt('1234');
       $user->visible_password='1234';
       $user->occupation='something';
       $user->address='something address';
       $user->phone='098765';
       $user->is_admin=1;
       $user->remember_token=null;
    
       $user->save();

    }

}
