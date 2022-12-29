<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         $user = \App\Models\User::factory()->create([
             'name' => 'Talabat User',
             'email' => 'talabat@gmail.com',
             'password' => Hash::make('123456'),
         ]);
        $this->call(LaratrustSeeder::class);
        $user->attachRole('super_admin');
        $user->attachPermissions(Permission::all()->pluck('name')->toArray());
    }
}
