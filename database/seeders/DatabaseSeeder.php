<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constants\Enum;
use App\Models\Permission;
use App\Models\Setting;
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

         $user = \App\Models\User::factory()->create([
             'name' => 'Break',
             'email' => 'break@gmail.com',
             'role' => Enum::SUPER_ADMIN,
             'password' => Hash::make('123456'),
         ]);
         Setting::query()->create();
        $this->call(LaratrustSeeder::class);
        $user->attachRole('super_admin');
        $user->attachPermissions(Permission::all()->pluck('name')->toArray());
//        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(20)->create();
        \App\Models\Addon::factory(5)->create();

    }
}
