<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['id' => 1],[
             'name' => 'admin' ,
             'email' => 'admin@admin.com',
             'password' => '$2y$10$g64LbWx7pVOl17PBAQvO6u.O6YjYnyc99eLZmRFwegWkLA.SbOaNC'      ]);
    }
}
