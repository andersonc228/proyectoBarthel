<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;

class DoctorController extends Controller
{


    public function createPacient(Request $request){

        print_r($request->all());

        RegisterController::createPacient($request->all());
    }

}
