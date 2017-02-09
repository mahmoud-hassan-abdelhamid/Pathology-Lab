@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="height: 50px;">
                            <p style="display: inline;vertical-align:middle;">Report</p>
                            <button class="btn btn-success" style="float: right" name="submit" type="submit"
                                    value="true">add
                            </button>
                        </div>
                        <div class="panel-body">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @break
                            @endforeach
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>
                                        Operator :
                                        {{$report->operator->name}}
                                    </label>
                                </div>
                                <div class="col-lg-6 text-center">
                                    Report Form
                                </div>
                                <label class="col-lg-2">
                                    Patient Email:
                                    <input name="patient" class="typeahead " type="text" autocomplete="off"
                                           style=" border: thin solid lightgray;" value="{{$report->patient->email}}" url="{{url('patients/get/email/')}}">
                                </label>
                            </div>
                            <div class="tests" count-tests="{{$report->tests->count()}}">
                                @foreach($report->tests as $test)
                                    <?php  $testIndex = $loop->index;?>
                                    <div>
                                        <hr>
                                        <input type="hidden" name="tests[{{$loop->index}}][id]" value="{{$test->id }}">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label>
                                                    Title :
                                                    <input name="tests[{{$loop->index}}][title]"
                                                           value="{{$test->title }}">
                                                </label>
                                            </div>
                                            <div class="col-lg-6 text-center">
                                                Test Form
                                            </div>
                                            <label class="col-lg-2">
                                                Description :
                                                <input name="tests[{{$loop->index}}][desc]" value="{{$test->desc }}">
                                            </label>
                                        </div>
                                        <div class="results" tests="{{$loop->index}}" count-results="{{$test->results->count()}}">
                                            @foreach($test->results as $result)
                                                <input type="hidden"
                                                       name="tests[{{$testIndex}}][results][{{$loop->index}}][id]"
                                                       value="{{$result->id }}">
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <label>
                                                            Result Title :
                                                            <input name="tests[{{$testIndex}}][results][{{$loop->index}}][title]"
                                                                   value="{{$result->title }}">
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6 text-center">
                                                    </div>
                                                    <label class="col-lg-2">
                                                        Result Value :
                                                        <input name="tests[{{$testIndex}}][results][{{$loop->index}}][value]"
                                                               value="{{$result->value }}">
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="btn btn-success" type="button"
                                                onclick="addNewResult(this.parentElement.getElementsByClassName('results')[0]);">
                                            add new result
                                        </button>
                                    </div>
                                @endforeach
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
