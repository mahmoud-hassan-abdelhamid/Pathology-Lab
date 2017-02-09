<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Report;
use App\User;
use Illuminate\Support\Facades\Response;


class PatientController extends Controller
{
    public function getPatientByEmail($email)
    {
        return \Response::json(User::select("email")->whereIsPatient(true)->where("email", "LIKE", "%$email%")->get());
    }


    //
    public function listOfReports()
    {
        return Response::view("reports.list", [
            "reports" => \App\Report::wherePatientId(\Auth::user()->id)->get()
        ]);
    }

    public function showReport(Report $report)
    {
        abort_if($report->patient_id!=\Auth::user()->id, 404);
        return Response::view("reports.show", [
            "report" => $report
        ]);
    }

    public function exportPdfReport(Report $report)
    {
        abort_if($report->patient_id!=\Auth::user()->id, 404);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('reports.pdf', [
            "report" => $report
        ]);
        return $pdf->download('report.pdf');
    }

    public function emailReport(Report $report)
    {
        abort_if($report->patient_id!=\Auth::user()->id, 404);
        \Mail::send("reports.pdf", [
            "report" => $report
        ], function ($m) use ($report) {
            $m->from('support@pathology.com', 'Pathology');
            $m->to($report->patient->email)->subject('Report Pathology');
        });
        return $this->listOfReports();
    }


}
