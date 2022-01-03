<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Fares;
use Illuminate\Support\Facades\Hash;

class AdminInsertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = User::create([
            'first_name' => "Admin",
            'last_name' => "Admin",
            'is_admin'=>true,
            'email' => "admin@admin.com",
            'password' => Hash::make("admin"),
        ]);

        $user->attachRole("admin");

        $fare = Fares::create([
            'id' => 1,
            'fare' => 0,]);
    }
}


