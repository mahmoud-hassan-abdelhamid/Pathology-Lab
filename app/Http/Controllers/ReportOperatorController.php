<?php

namespace App\Http\Controllers;

use App\Decorations\Users\ReportOperatorUser;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportOperatorController extends Controller
{
    public function listOfReports()
    {
        return Response::view("reports.list", [
            "reports" => \App\Report::get(),
        ]);
    }

    public function addReport(Request $request)
    {

        $this->validate($request, [
            "tests" => "required"
        ]);
        $patient = \App\User::whereType('patient')->whereEmail($request->patient)->firstOrFail();
        $operator = \Auth::user();
        $report = \App\Report::createReport($operator, $patient, $request->tests);
        return redirect("/reports");
    }

    public function showAddReportForm(Request $request)
    {
        return Response::view("reports.add", [
            "operator" => \Auth::user()
        ]);
    }


    public function editReport(Report $report, Request $request)
    {
        $this->validate($request, [
            "tests" => "required",
            "patient" => "required",
        ]);
        $patient = \App\User::whereType('patient')->whereEmail($request->patient)->firstOrFail();
        $operator = \Auth::user();
        $report->addRecord($operator, $patient, $request->tests);
        return redirect("/reports");
    }

    public function deleteReport(Report $report)
    {
        $report->delete();
        return redirect("/reports");
    }

    public function showEditReportForm(Report $report)
    {
        return Response::view("reports.edit", [
            "report" => $report
        ]);
    }

    public function showReport(Report $report)
    {
        return Response::view("reports.show", [
            "report" => $report
        ]);
    }
    public function exportPdfReport(Report $report)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('reports.pdf', [
            "report" => $report
        ]);
        return $pdf->download('report.pdf');
    }


}
