<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {    
        $user = User::create([
            'dni'=>$data['dni'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'bornDate' => $data['bornDate'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->roles()->attach(Role::where('name', 'admin')->get());

        // $user
        //     ->roles()
        //     ->attach(Role::where('name', 'user')->first());
        return $user;
    }

    public static function createPacient($data)
    {
        $user = User::create([
            'dni' => $data['dni'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'bornDate' => $data["bornDate"],
            'email' => $data['email'],
            'password' => bcrypt($data['dni']),
        ]);

        $user->roles()->attach(Role::where('name', 'pacient')->get());
        
    }
    public static function createDoctor($data)
    {
        $user = User::create([
            'dni' => $data['dni'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'bornDate' => $data["bornDate"],
            'email' => $data['email'],
            'password' => bcrypt($data[ 'dni']),
            'profesion' => $data['profession'],
        ]);

        $user->roles()->attach(Role::where('name', 'doctor')->get());  
    }

    public static function createAdministrator($data)
    {
        $user = User::create([
            'dni' => $data['dni'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'bornDate' => $data["bornDate"],
            'email' => $data['email'],
            'password' => bcrypt($data[ 'dni']),
            'profesion' => $data['profession'],
        ]);

        $user->roles()->attach(Role::where('name', 'admin')->get());  
    }
}
