<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Reports;

class DoctorController extends Controller
{


    public function createPacient(Request $request){

        print_r($request->all());

        RegisterController::createPacient($request->all());
    }

    public function makeTest(Request $request){

        $reports = new Reports();

        $reports->q1 = $request-> eat;
        $reports->q2 = $request->micturition;
        $reports->q3 = $request-> dressup;
        $reports->q4 = $request-> stools;
        $reports->q5 = $request-> toilet;
        $reports->q6 = $request-> wander;
        $reports->q7 = $request-> traveling;
        $reports->q8 = $request-> wash;
        $reports->q9 = $request-> hour;
        $reports->q10 = $request-> micturition;
        $reports->total = 100; //por ahora
        $reports->dniPacient = 12345 ;//por ahora
        $reports->save();

        echo json_encode( $reports);

        return view("test.create");

    }

}
