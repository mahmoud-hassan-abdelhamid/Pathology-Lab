@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="height: 50px;">
                            <p style="display: inline;vertical-align:middle;">Add Report</p>
                            <button class="btn btn-success" style="float: right" name="submit" type="submit"
                                    value="true">add
                            </button>
                        </div>
                        <div class="panel-body">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                {{-- I put this 'break' because I want to show only one error at the same time.  --}}
                                @break
                            @endforeach
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>
                                        Operator :
                                        {{$operator->name}}
                                    </label>
                                </div>
                                <div class="col-lg-6 text-center">
                                    Report Form
                                </div>
                                <label class="col-lg-2">
                                    Patient Email:
                                    <input  name="patient" class="typeahead " type="text" autocomplete="off" style=" border: thin solid lightgray;" url="{{url('patients/get/email/')}}">
                                </label>
                            </div>
                            <div class="tests" count-tests="1">
                                <div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>
                                                Title :
                                                <input name="tests[0][title]" value="{{old('tests[0][title]') }}">
                                            </label>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            Test Form
                                        </div>
                                        <label class="col-lg-2">
                                            Description :
                                            <input name="tests[0][desc]" value="{{old('tests[0][desc]') }}">
                                        </label>
                                    </div>
                                    <div class="results" tests="0" count-results="1">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label>
                                                    Result Title :
                                                    <input name="tests[0][results][0][title]"
                                                           value="{{old('tests[0][results][0][title]') }}">
                                                </label>
                                            </div>
                                            <div class="col-lg-6 text-center">
                                            </div>
                                            <label class="col-lg-2">
                                                Result Value :
                                                <input name="tests[0][results][0][value]" value="{{old('tests[0][results][0][value]') }}">
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="button"
                                            onclick="addNewResult(this.parentElement.getElementsByClassName('results')[0]);">
                                        add new result
                                    </button>
                                </div>
                            </div>
                            <button class="btn btn-warning" style="float: right;" type="button"
                                    onclick="addNewTest(this.parentElement.getElementsByClassName('tests')[0]);">
                                add new test
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
