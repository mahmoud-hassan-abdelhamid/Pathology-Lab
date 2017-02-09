@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <p style="display: inline;vertical-align:middle;">Patients.</p>
                        <a href="{{url("/patients/add")}}">
                            <button class="btn btn-success" style="float: right">add new patient</button>
                        </a>
                    </div>
                    <table class="table table-responsive table-striped table-hover">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($patients as $patient)
                            <tr>
                                <td>{{$patient->id}}</td>
                                <td>{{$patient->name}}</td>
                                <td>{{$patient->email}}</td>
                                <td>
                                    <a href="{{url("/patients/edit/".$patient->id)}}">
                                        <button class="btn btn-success"><i class="glyphicon glyphicon-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{url("/patients/delete/".$patient->id)}}" onclick="return confirm('Are you sure?')">
                                        <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
