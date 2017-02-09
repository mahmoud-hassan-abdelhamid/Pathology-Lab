<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{


    public function index()
    {
        return view("operators");
    }

    public function listOperators()
    {
        $operators=\App\User::whereType('operator')->get();
        return Response::view("operators.list",
            [
                "operators" => $operators
            ]
        );
    }

    public function editOperator(User $operator, Request $request)
    {
        if ($request->submit) {
            $this->validate($request, [
                "email" => "required|email",
                "name" => "required",
                "password" => "required",
            ]);

            $operator->addRecord($request->email, $request->name, $request->password, 'operator');
            $operator->saveOrFail();
        }

        return Response::view("operators.edit",
            [
                "operator" => $operator
            ]
        );
    }

    public function addOperator(User $operator,Request $request)
    {
        if ($request->submit) {
            $this->validate($request, [
                "email" => "required|email|unique:users,email",
                "name" => "required",
                "password" => "required",
            ]);
            $operator->addRecord($request->email, $request->name, $request->password, 'operator');
            $operator->saveOrFail();
            return redirect("/operators");
        }
        return Response::view("operators.add");
    }

    public function deleteOperator(User $operator)
    {
        $operator->delete();
        return redirect("/operators");
    }


}
