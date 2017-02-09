@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <p style="display: inline;vertical-align:middle;">Reports.</p>
                        @if(Auth::user()->type()=='admin' || Auth::user()->type()=='operator')
                            <a href="{{url("/reports/add")}}">
                                <button class="btn btn-success" style="float: right">add new report</button>
                            </a>
                        @endif
                    </div>
                    <table class="table table-responsive table-striped table-hover">
                        <tr>
                            <th>#</th>
                            <th>Operator</th>
                            <th>Patient</th>
                            <th>Action</th>
                        </tr>
                        @foreach($reports as $report)
                            <tr>
                                <td>{{$report->id}}</td>
                                <td>{{$report->operator->name}}</td>
                                <td>{{$report->patient->name}}</td>
                                <td>
                                    @if(Auth::user()->type()=='admin' || Auth::user()->type()=='operator')
                                        <a href="{{url("/reports/edit/".$report->id)}}">
                                            <button class="btn btn-success"><i class="glyphicon glyphicon-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{url("/reports/delete/".$report->id)}}" onclick="return confirm('Are you sure?')">
                                            <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>
                                            </button>
                                        </a>
                                        <a href="{{url("/reports/download/".$report->id)}}">
                                            <button class="btn btn-primary"><i class="glyphicon glyphicon-download"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('/reports/show/'.$report->id)}}">
                                            <button class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i>
                                            </button>
                                        </a>
                                    @endif
                                    @if(Auth::user()->type()=='patient')
                                    <a href="{{url('/patients/reports/download/'.$report->id)}}">
                                        <button class="btn btn-warning"><i class="glyphicon glyphicon-download"></i>
                                        </button>
                                    </a>
                                    <a href="{{url('/patients/reports/show/'.$report->id)}}">
                                        <button class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i>
                                        </button>
                                    </a>
                                    <a href="{{url('/patients/reports/email/'.$report->id)}}">
                                            <button class="btn btn-primary"><i class="glyphicon glyphicon-envelope"></i>
                                            </button>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
