<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Reports;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;

class AdministratorController extends Controller
{
    public function createPacient(Request $request)
    {
        $this->validateData($request);

        $dniValid = $this->validateDni($request->dni);
        $dateValid = $this->validateDate($request->bornDate);

        if ($dateValid) {
            if ($dniValid) {
                try {
                    RegisterController::createDoctor($request->all());
                    $message = "Pacient Created";
                    return view('registers.registerPacient', ['message' => $message]);
                } catch (\Exception $ex) {
                    if ($ex->getCode() == 23000) {
                        $message = "DNI o Email Exist";
                    } else {
                        $message = "No pacient created - " . $ex->getMessage();
                    }
                    return view('registers.registerPacient', ['message' => $message]);
                }
            }
            $message = "Input DNI valid";
            return view('registers.registerPacient', ['message' => $message]);
        }
        $message = "The date is less today";
        return view('registers.registerPacient', ['message' => $message]);
    }

    public function createDoctor(Request $request)
    {

        $this->validateData($request);

        $dniValid = $this->validateDni($request->dni);

        if ($dniValid) {

            try {
                RegisterController::createDoctor($request->all());
                $message = "Doctor Created";
                return view('registers.registerDoctor', ['message' => $message]);
            } catch (\Exception $ex) {
                if ($ex->getCode() == 23000) {
                    $message = "DNI o Email Exist";
                } else {
                    $message = "No Doctor created - " . $ex->getMessage();
                }
                return view('registers.registerDoctor', ['message' => $message]);
            }
        }
        $message = "Input DNI valid";
        return view('registers.registerDoctor', ['message' => $message]);
    }

    public function createAdministrator(Request $request)
    {
        $this->validateData($request);

        $dniValid = $this->validateDni($request->dni);

        if ($dniValid) {
            try {
                RegisterController::createDoctor($request->all());
                $message = "Administrator Created";
                return view('registers.registerAdministrator', ['message' => $message]);
            } catch (\Exception $ex) {
                if ($ex->getCode() == 23000) {
                    $message = "DNI o Email Exist";
                } else {
                    $message = "No Administrator created - " . $ex->getMessage();
                }
                return view('registers.registerAdministrator', ['message' => $message]);
            }
        }
        $message = "Input DNI valid";
        return view('registers.registerAdministrator', ['message' => $message]);
    }

    public function findAdmin(Request $request)
    {
        $dniValid = $this->validateDni($request->dni);

        if ($dniValid) {
            if (!empty($request->dni)) {
                //SELECT U.`email`, RU.role_id FROM `users` U INNER JOIN role_user RU ON U.`id` = RU.user_id WHERE U.dni = '12345'
                $user = \DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->where('users.dni', $request->dni)
                    ->get();

                if (count($user) != 0) {

                    if ($user[0]->role_id == 1) {
                        $message = "Administrator Find";
                        return view("administrator.editAdministrator", ['user' => $user[0], 'message' => $message]);
                    } else if ($user[0]->role_id == 2) {
                        $message = "Pacient Find";
                        return view("pacient.editPacient", ['user' => $user[0], 'message' => $message]);
                    } else {
                        $message = "Doctor Find";
                        return view("doctor.editDoctor", ['user' => $user[0], 'message' => $message]);
                    }
                } else {
                    $message = 'User not found ';
                    return view('findView', ['message' => $message]);
                }
            }
            $message = "Input DNI";
            return view("findView", ['message' => $message]);
        }
        $message = "Input DNI valid";
        return view("findView", ['message' => $message]);
    }

    public function modifyUser(Request $request)
    {
        switch ($request->action) {
            case 'update':
                return $this->update($request);
                break;
            case 'delete':
                return $this->delete($request);
                break;
        }
    }

    public function update($request)
    {

        try {
            $this->validateData($request);
            \DB::table('users')
                ->where('dni', $request->dni)
                ->update(['name' => $request->name, 'surname' => $request->surname, 'bornDate' => $request->bornDate, 'email' => $request->email, 'phone' => $request->phone]);
            $message = "User Correctly Updated";
            $user = User::where("dni", $request->dni)->first();
            if ($user == null) {
                $message = "Any Updated";
                return view('administrator.editAdministrator', ['message' => $message]);
            } else {
                return view('administrator.editAdministrator', ['user' => $user, 'message' => $message]);
            }
        } catch (\Exception $ex) {
            if ($ex->getCode() == 23000) {
                $message = "Email Exist";
            } else {
                $message = "Check all the fields";
            }

            $user = User::where("dni", $request->dni)->first();
            return view('administrator.editAdministrator', ['user' => $user, 'message' => $message]);
        }
    }

    public function delete($request)
    {
        try {
            $user = User::where("dni", $request->dni)->first();

            $user->delete();

            $message = "User Delete";
        } catch (\Exception $e) {
            $message = "Could not delete user" . $e->getMessage();
        }
        return view('administrator.editAdministrator', ['user' => $user, 'message' => $message]);
    }

    public function validateData(Request $request)
    {
        $alphabetic = "/^[A-Za-z\s]*$/i";
        $numeric = "/[0-9]{9}/";
        $email = "/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/";

        $request->validate([
            'dni' => "required|min:9|max:9",
            'name' => "required|min:1|max:50|regex:$alphabetic",
            'surname' => "required|min:1|max:50|regex:$alphabetic",
            'email' => "required|min:1|max:50|regex:$email",
            'bornDate' => "required",
            'phone' => "required|regex:$numeric"
        ]);
    }

    public function validateDni($dni)
    {
        try {
            $letra = substr($dni, -1);
            $numeros = substr($dni, 0, -1);
            if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function validateDate($date1)
    {
        $fecha_actual = strtotime(date("d-m-Y", time()));
        $fecha_entrada = strtotime($date1);

        if ($fecha_entrada < $fecha_actual) {
            return false;
        } else {
            return true;
        }
    }
}
