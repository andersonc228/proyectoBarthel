<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Reports;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Exception;

class DoctorController extends Controller
{

    /**
     * function validate the data input 
     */

    public function makeTest(Request $request)
    {
        $reports = new Reports();

        $reports->q1 = $request->eat;
        $reports->q2 = $request->micturition;
        $reports->q3 = $request->dressup;
        $reports->q4 = $request->stools;
        $reports->q5 = $request->toilet;
        $reports->q6 = $request->wander;
        $reports->q7 = $request->traveling;
        $reports->q8 = $request->wash;
        $reports->q9 = $request->hour;
        $reports->q10 = $request->micturition;
        $reports->total = 100; //por ahora
        $reports->dniPacient = $request->dni;
        $reports->save();

        json_encode($reports);



        return view("test.makeTest");
    }


    public function managePacient(Request $request)
    {

        $user = User::where("dni", $request->dni)->first();
        switch ($request->action) {
            case 'update':
                return view("pacient.editPacient", ['user' => $user]);;
                break;
            case 'makeTest':
                return view("test.makeTest", ['user' => $user]);;
                break;
            case 'viewResults':
                return $this->AllResultsPacient($request);
        }
    }

    public function viewPacient(Request $request)
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
                    if ($user[0]->role_id == 2) {
                        $message = "Pacient Find";
                        return view("pacient.viewPacient", ['user' => $user[0], 'message' => $message]);
                    } else {
                        $message = "User not found";
                        return view("findView", ['message' => $message]);
                    }
                } else {
                    $message = 'User not found ';
                    return view('findView', ['message' => $message]);
                }
            }
            $message = "Input DNI";
            return view('findView', ['message' => $message]);
        }
        $message = "Input the DNI Correct";
        return view('findView', ['message' => $message]);
    }


    public function modifyPacient(Request $request)
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
        //validar los datos fuera para practicas
        //$this->validateData($request);

        try {
            \DB::table('users')
                ->where('dni', $request->dni)
                ->update(['name' => $request->name, 'surname' => $request->surname, 'bornDate' => $request->bornDate, 'email' => $request->email]);
            $message = "Pacient Correctly Updated";
            $user = User::where("dni", $request->dni)->first();
            if ($user == null) {
                $message = "Any Updated";
                return view('pacient.editPacient', ['message' => $message]);
            } else {
                return view('pacient.editPacient', ['user' => $user, 'message' => $message]);
            }
        } catch (\Exception $ex) {
            if ($ex->getCode() == 23000) {
                $message = "Email Exist";
            } else {
                $message = "No Pacient Update ";
            }

            $user = User::where("dni", $request->dni)->first();
            return view('pacient.editPacient', ['user' => $user, 'message' => $message]);
        }
    }

    public function delete($request)
    {
        try {
            $user = User::where("dni", $request->dni)->first();

            $user->delete();

            $message = "User Delete";
            return view("findView", ['message' => $message]);
        } catch (\Exception $e) {
            $message = "Could not delete user" . $e->getMessage();
        }
        return view('pacient.editPacient', ['user' => $user, 'message' => $message]);
    }
    public function AllResultsPacient(Request $request)
    {
        $reports = Reports::all()->where('dniPacient', $request->dni);
        $allReports = [];
        for ($i = 0; $i < sizeof($reports); $i++) {
            $allReports[$i] = $allReports + $reports[$i]->toArray();
        }
        dd(json_encode($allReports));
    }

    public function makeAppointment(Request $request)
    {

        // $nAppointment = \DB::table('appointments')
        //     ->where('dniPacient', $request->dni)
        //     ->get()->last();

        $date = $this->validateDate($request->appointment);
        $dniValid = $this->validateDni($request->dni);

        if ($date) {
            if ($dniValid) {
                if (!empty($request->dni)) {
                    $user = \DB::table('users')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->where('users.dni', $request->dni)
                        ->get();
                    if (count($user) != 0) {
                        if ($user[0]->role_id == 2) {
                            try {
                                \DB::table('appointments')->insert(
                                    [
                                        'dateAppointment' => $request->appointment,
                                        'dniPacient' =>  $request->dni
                                    ]
                                );
                                $message = "Appointment created";
                                return view("appointments/newAppointment", ['message' => $message]);
                                dd("paso");
                            } catch (\Exception $ex) {
                                if ($ex->getCode() == 23000) {
                                    $message = "Pacient not Exist";
                                    dd($message);
                                } else {
                                    $message = "Pacient not Exist";
                                }
                            }
                        } else {
                            $message = "Pacient not Exist";
                            return view("appointments/newAppointment", ['message' => $message]);
                        }
                    } else {
                        $message = 'Pacient not Exist';
                        return view('appointments/newAppointment', ['message' => $message]);
                    }
                }
            }
            $message = 'Input Correct DNI';
            return view('appointments/newAppointment', ['message' => $message]);
        }
        $message = 'The Date is less today';
        return view('appointments/newAppointment', ['message' => $message]);
    }

    public function searchAppointment(Request $request)
    {

        dd($request->all());
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

    public function validateData(Request $request)
    {
        $alphabetic = "/^[a-z]*$/i";
        $numeric = "/[0-9]{9}/";

        $request->validate([
            'dni' => "required|min:9|max:9",
            'name' => "required|min:1|max:50|regex:$alphabetic",
            'surname' => "required|min:1|max:50|regex:$alphabetic",
            'email' => "required|min:1|max:50",
            'bornDate' => "required",
            'phone' => "required|regex:$numeric"
        ]);
    }

    public static function validateDni($dni)
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
}
