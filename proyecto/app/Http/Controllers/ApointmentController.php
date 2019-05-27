<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DoctorController;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Session as IlluminateSession;

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

            if (!$nAppointment == null) {
                $message = 'Next Appointment Pacient';
                return view('appointments/appointmentFind', ['message' => $message, 'apointment' => $nAppointment]);
            } else {
                $message = 'No data found';
                return view('appointments/viewAppointments', ['message' => $message, 'apointment' => $nAppointment]);
            }
        } else {
            dd("Input corret Dni");
        }
    }

    public function manageAppointment(Request $request)
    {
        switch ($request->action) {
            case 'delete':
                $this->delete($request);
                $message = "Delete Correctly";
                return view('appointments/homeAppointments', ['message' => $message]);
                break;
            case 'modify':
                $id = $request->id;
                return view('appointments/modifyAppointment', ['id' => $id]);
                break;
        }
    }

    public function modify(Request $request)
    {
        \DB::table('appointments')
            ->where('id', $request->id)
            ->update(['dateAppointment' => $request->dateAppointment]);


        $message = "Update Correct";
        return view('appointments/homeAppointments', ['id' =>  $request->id, 'message' => $message]);
    }

    public function delete($request)
    {

        try {
            $user = \DB::table('appointments')->where('id', $request->id)->delete();
        } catch (\Exception $e) {
            $message = "Could not delete user" . $e->getMessage();
        }
    }

    public function pacientAppointment(Request $request)
    {
        $mail = IlluminateSession::get('dni');

        //SELECT a.dateAppointment from appointments a JOIN users u WHERE u.email='coronado@gmail.com'

        $users = \DB::table('appointments')
            ->join('users', 'users.dni', '=', 'users.dni')
            ->where('users.email', $mail)
            ->get()->last();
        //dd($users->dateAppointment);

        return view('pacient/pacientAppointments', ['apointment' => $users]);
    }
}
