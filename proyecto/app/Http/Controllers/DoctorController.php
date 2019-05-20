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
    public function validateData(Request $request)
    {
        $alphabetic = "/^[a-z]*$/i";
        $password = "/^[a-z]*$/i";

        $request->validate([
            'name' => "required|min:1|max:30|regex:$alphabetic",
            'surname' => "required|min:1|max:30|regex:$alphabetic",
            'email' => "required|min:1|max:30",
            'dni' => "required|unique:users|min:1",
            'bornDate' => "required|min:1|max:30|regex:$alphabetic",
        ]);
    }
    public function createPacient(Request $request)
    {

        //validar los datos fuera para practicas
        //$this->validateData($request);
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
        //dd($pacient = User::where("dni", $request->dni)->first());

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
        $reports->dniPacient = 12345; //por ahora
        $reports->save();

        echo json_encode($reports);

        return view("test.create");
    }


    public function find(Request $request)
    {

        // if (!empty($request->dni)) {

        //     $pacient = User::where("dni", $request->dni)->first();

        //     $message = Session::get('message');

        //     if (!$pacient == null) {

        //         //recojo la fecha y la paso a date
        //         $p = date('d/m/Y', strtotime("2019-09-09"));

        //         //dd(var_dump($p));
        //         $newDateFormat = $p->format('d/m/Y');
        //         dd(var_dump($newDateFormat));
        //         //     dd(var_dump($pacient->bornDate));
        //         // return view("pacient.edit", ['pacient' => $pacient, 'message' => $message]);
        //     } else {
        //         $message = 'Pacient not found ';
        //         return view('find', ['message' => $message]);
        //     }
        //     // return view("find", ['message' => $message]); //->with('pacient',$pacient);
        // }

        // $message = "Input DNI";

        Session::put('dni', $request->dni);

        $message = Session::get('dni');


        return view("find", ['message' => $message]); //->with('pacient',$pacient);
    }


    public function edit($dni)
    {

        try {
            $pacient = User::findOrFail($dni);

            $message = "funciona";

            return view('pacient.edit', ['pacient' => $pacient, 'message' => $message]);
        } catch (\Exception $e) {
            $message = 'Pacient not found- ' . $e->getMessage();
        }
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
}
