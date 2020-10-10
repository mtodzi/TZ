<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'name',
            'email' => 'name@test.test',
            'password' => Hash::make('123456'),
            'api_token' => Str::random(80),
        ]);
    }
}
