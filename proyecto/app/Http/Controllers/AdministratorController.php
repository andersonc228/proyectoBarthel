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
            $message = "User Created";
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

        // Preguntar al profe como enviar el mensaje

        if ($this->validatePassword($pass1, $pass2)) {
            $message = "User Created";
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

        // Preguntar al profe como enviar el mensaje

        if ($this->validatePassword($pass1, $pass2)) {
            //RegisterController::createDoctor($request->all());
            $message = "User Created";
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
}
