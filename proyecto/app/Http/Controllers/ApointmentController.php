<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DoctorController;

class ApointmentController extends Controller
{

    public function viewAppointments(Request $request)
    {

        switch ($request->action) {
            case 'viewAppointments':
                return view('appointments/viewAppointments');
                break;
            case 'makeAppointment':
                return view('appointments/newAppointment');
                break;
            default:
                break;
        }
    }

    public function appointmentPacient(Request $request)
    {
        //$dniValid = DoctorController::validateDni($request->dni);
        $dniValid = True;
        if ($dniValid) {

            $nAppointment = \DB::table('appointments')
                ->where('dniPacient', $request->dni)
                ->get()->last();
            $message = 'Next Appointment Pacient';
            return view('appointments/appointmentFind', ['message' => $message, 'apointment' => $nAppointment]);
        } else {
            dd("dni mal weon");
        }
    }
}
