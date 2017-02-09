@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <p style="display: inline;vertical-align:middle;">Operators.</p>
                        <a href="{{url("/operators/add")}}">
                            <button class="btn btn-success" style="float: right">add new operator</button>
                        </a>
                    </div>
                    <table class="table table-responsive table-striped table-hover">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($operators as $operator)
                            <tr>
                                <td>{{$operator->id}}</td>
                                <td>{{$operator->name}}</td>
                                <td>{{$operator->email}}</td>
                                <td>
                                    <a href="{{url("/operators/edit/".$operator->id)}}">
                                        <button class="btn btn-success"><i class="glyphicon glyphicon-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{url("/operators/delete/".$operator->id)}}" onclick="return confirm('Are you sure?')">
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
