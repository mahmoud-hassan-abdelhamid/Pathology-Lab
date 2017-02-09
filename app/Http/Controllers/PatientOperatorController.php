<?php

namespace App\Http\Controllers;

use App\Decorations\Users\PatientOperatorUser;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PatientOperatorController extends Controller
{

    public function index()
    {
        return view("operators");
    }

    public function listPatients()
    {
        $patients=User::whereType('patient')->get();
        return Response::view("patients.list",
            [
                "patients" => $patients
            ]
        );
    }

    public function editPatient(User $patient, Request $request)
    {
        if ($request->submit) {
            $this->validate($request, [
                "email" => "required|email",
                "name" => "required",
                "password" => "required",
            ]);

            $user = $patient->addRecord($request->email, $request->name, $request->password, 'patient', 'manage_reports');
            $user->saveOrFail();
        }
        return Response::view("patients.edit",
            [
                "patient" => $patient
            ]
        );
    }

    public function addPatient(User $patient, Request $request)
    {
        if ($request->submit) {
            $this->validate($request, [
                "email" => "required|email|unique:users,email",
                "name" => "required",
                "password" => "required",
            ]);
            $user = $patient->addRecord($request->email, $request->name, $request->password, 'patient', 'manage_reports');
            $user->saveOrFail();
            return redirect("/patients");
        }
        return Response::view("patients.add");
    }

    public function deletePatient(User $patient)
    {
        $patient->delete();
        return redirect("/patients");
    }

}
