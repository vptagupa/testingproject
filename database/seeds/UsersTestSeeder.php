<?php

use Illuminate\Database\Seeder;

class UsersTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_mig_test')
        	->insert([
        		// 'id' => 1,
        		'user_id' => '123',
        		'password' => 'pswd123',
        		'fillname' => 'name',
        		'email' => 'victortagupa@gmail.com'
        	]);
    }
}
