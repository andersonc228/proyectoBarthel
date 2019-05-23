<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Reports;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{



    /**
     * function validate the data input 
     */
    public function createPacient(Request $request)
    {

        //validar los datos fuera para practicas
        $this->validateData($request);
        //validate dni
        //$this->validateDni($request->dni());
        try {
            RegisterController::createPacient($request->all());
            $message = "Pacient Created";
        } catch (\Exception $ex) {

            if ($ex->getCode() == 23000) {
                $message = "Pacient alredy Exist";
            } else {
                $message = "No Data created - " . $ex->getMessage();
            }
        }
        return view('registers.registerPacient', ['message' => $message]);
    }

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
        //validate DNI
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
        //validate dni
        //$this->validateDni($request->dni());

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

    public function validateData(Request $request)
    {

        $alphabetic = "/^[a-z]*$/i";

        $request->validate([
            'dni' => "required|min:9|max:9",
            'name' => "required|min:1|max:50|regex:$alphabetic",
            'surname' => "required|min:1|max:50|regex:$alphabetic",
            'email' => "required|min:1|max:50",
            'bornDate' => "required|min:1|max:50",
        ]);
    }

    public function validateDni($dni)
    {
        $nifRegEx = '/^[0-9]{8}[A-Z]$/i';
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        if (preg_match($nifRegEx, $dni)) {
            if ($letras[(substr($dni, 0, 7) % 23)] == $dni[8]) {
                return "funciona";
            }
            return "no sirve 1";
        }
        return "no sirve";
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
}
