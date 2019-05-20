<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $role_admin = Role::where('name', 'admin')->first();
        //  $role_doctor = Role::where('name', 'doctor')->first();
        // $role_pacient = Role::where('name', 'pepito')->first();


        // $user = new User();
        // $user->name = 'admin';
        // $user->email = 'admin@admin.com';
        // $user->password = bcrypt('secret');
        // $user->save();
        // $user->roles()->attach($role_admin);


        // $user = new User();
        // $user->name = 'doctor';
        // $user->email = 'doctor@doctor.com';
        // $user->password = bcrypt('secret');
        // $user->save();
        // $user->roles()->attach($role_doctor);


        // $table->bigIncrements('id');
        // $table->string('dni', 10)->unique();
        // $table->string('name', 20);
        // $table->string('surname', 20);
        // $table->dateTime('bornDate');
        // $table->string('email', 30)->unique();
        // $table->string('password');
        // $table->string('profesion')->nullable();
        // $table->rememberToken();
        // $table->timestamps();

        // $user = new User();
        // $user->dni = '04560839E';
        // $user->name = 'pepito';
        // $user->surname = 'perez';
        // $user->bornDate = now(+1);
        // $user->email = 'pacient@pacient.com';
        // $user->password = bcrypt('secret');
        // $user->save();
        // $user->roles()->attach($role_admin);
    }
}
