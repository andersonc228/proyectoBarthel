<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use Symfony\Component\HttpFoundation\Session\Session;


class AdministratorController extends Controller
{
    public function createPacient(Request $request)
    {

        $pass1 = $request->password;
        $pass2 = $request->password2;

        // Preguntar al profe como enviar el mensaje

        if ($this->validatePassword($pass1, $pass2)) {
            $message = "Pacient Created";
            //dd("guarada");
            RegisterController::createDoctor($request->all());
            return view('registers.registerPacient', ['message' => $message]);
        } else {
            $message = "The Password is incorrect";
            return view('registers.registerPacient', ['message' => $message]);
        }
    }

    public function createDoctor(Request $request)
    {
        $pass1 = $request->password;
        $pass2 = $request->password2;


        if ($this->validatePassword($pass1, $pass2)) {
            $message = "Doctor Created";
            RegisterController::createDoctor($request->all());
            return view('registers.registerDoctor', ['message' => $message]);
        } else {
            $message = "The Password is incorrect";
            return view('registers.registerDoctor', ['message' => $message]);
        }
    }

    public function createAdministrator(Request $request)
    {
        $pass1 = $request->password;
        $pass2 = $request->password2;

        if ($this->validatePassword($pass1, $pass2)) {
            RegisterController::createAdministrator($request->all());
            $message = "Administrator Created";
            return view('home')->with(['message' => $message]);
        } else {
            $message = "The Password is incorrect";
            return view('registers.registerAdministrator', ['message' => $message]);
        }
    }

    /**
     * function validate the password is the same and not empty
     */

    public function validatePassword($passwor1, $passwor2)
    {

        $flag = false;

        if ($passwor1 == $passwor2) {
            $flag = true;
        }
        if ($passwor1 == "" && $passwor2 == "") {
            $flag = false;
        }
        return $flag;
    }


    public function find(Request $request)
    {

        //validate DNI
        if (!empty($request->dni)) {
            $user = User::where("dni", $request->dni)->first();

            if (!$user == null) {
                $message = "User Find";
                return view("pacient.edit", ['pacient' => $user, 'message' => $message]);
            } else {
                $message = 'Pacient not found ';
                return view('find', ['message' => $message]);
            }
        }
        $message = "Input DNI";

        //$message=Session::put('key', 'value');
        return view("find", ['message' => $message]);
    }

    public function updatePassword(Request $request)
    {
        $dni = Session::get('dni');

        if (!empty($request->dni)) { 
            //buscar el metodo de actualizar un campo de la bbdd
            $user = User::where("dni",$dni);
        }

        $message = "Input DNI";

        return view("find", ['message' => $message]);
    }
}
