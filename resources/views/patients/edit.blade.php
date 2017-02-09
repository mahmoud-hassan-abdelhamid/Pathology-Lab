@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="height: 50px;">
                            <p style="display: inline;vertical-align:middle;">Edit Operator</p>
                            <button class="btn btn-success" style="float: right" name="submit" type="submit"
                                    value="true">save
                            </button>
                        </div>
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            {{-- I put this 'break' because I want to show only one error at the same time.  --}}
                            @break
                        @endforeach
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>
                                        Name :
                                        <input name="name" value="{{$patient->name}}">
                                    </label>
                                </div>
                                <div class="col-lg-6"></div>
                                <label class="col-lg-2">
                                    Email :
                                    <input name="email" value="{{$patient->email}}">
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>
                                        Password :
                                        <input name="password" value="{{ $patient->password}}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
