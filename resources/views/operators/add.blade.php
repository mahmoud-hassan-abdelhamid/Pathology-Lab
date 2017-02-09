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
                                    value="true">add
                            </button>
                        </div>
                        <div class="panel-body">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach

                            <div class="row">
                                <div class="col-lg-2" >
                                    <label>
                                        Name* 
                                        <input name="name" value="{{old('name') }}">
                                    </label>
                                </div>
                                <div class="col-lg-6"></div>
                                <label class="col-lg-2">
                                    Email*
                                    <input name="email" value="{{old('email') }}">
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>
                                        Password*
                                        <input name="password" value="{{old('password') }}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection
