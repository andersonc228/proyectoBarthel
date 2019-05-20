<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Reports;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;

class AdministratorController extends Controller
{
    /**
     * Recibe pacient
     * return view
     */
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


    public function findAdmin(Request $request)
    {
        
        //validate DNI
        if (!empty($request->dni)) {
            //SELECT U.`email`, RU.role_id FROM `users` U INNER JOIN role_user RU ON U.`id` = RU.user_id WHERE U.dni = '12345'
            $user = \DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('users.dni',$request->dni)
            ->get();

            if (!$user == null) {
                if($user[0]->role_id == 1){
                    $message = "Administrator Find";
                    $user = User::where("dni", $request->dni)->first();
                    return view("administrator.editAdministrator", ['user' => $user, 'message' => $message]);
                }else if($user[0]->role_id == 2){
                    $message = "Pacient Find";
                    $user = User::where("dni", $request->dni)->first();
                    return view("pacient.editPacient", ['user' => $user, 'message' => $message]);
                }else{
                    $message = "Doctor Find";
                    $user = User::where("dni", $request->dni)->first();
                    return view("doctor.editDoctor", ['user' => $user, 'message' => $message]);
                
                }
                
            } else {
                $message = 'Pacient not found ';
                return view('findView', ['message' => $message]);
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

    public function modifyUser(Request $request){
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
    //    try {
            
            // $user = User::where("dni", $request->dni)->first();
            // $objCategory = User::findOrFail($user->id);
            // $objCategory->update($request->all());
            // $user = User::where("dni", $request->dni)->first();
            // $user->update($request->all()->except(['password']));
            
            // $user->update(['email' => $request->email])->except('_token');

            \DB::table('users')
            ->where('dni', $request->dni)
            ->update(['name' => $request->name]);

            $message = "User Update";
            $user = User::where("dni", $request->dni)->first();

            //with es crear una variable de session
           return view('administrator.editAdministrator', ['user' => $user, 'message' => $message]);;
        // } catch (\Exception $e) {
        //     $message = "No data update " . $e->getMessage();
        // }
        // return view('administrator.editAdministrator', ['user' => $user, 'message' => $message]);
   
    }

    public function delete($request)
    {
        try {
            $user = User::where("dni", $request->dni)->first();

            $user->delete();

            $message = "User Delete";

            return redirect()->to('/findView');


        } catch (\Exception $e) {
            $message = "No user delete" . $e->getMessage();
        }
        return view('administrator.editAdministrator', ['user' => $user, 'message' => $message]);
    }
}
