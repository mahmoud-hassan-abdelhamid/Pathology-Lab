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
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <p>
                                        Operator :
                                        {{$report->operator->name}}
                                    </p>
                                </div>
                                <div class="col-lg-6 text-center">
                                    Report Form
                                </div>
                                <div class="col-lg-2">
                                    Patient Email:
                                    <p>{{$report->patient->email}}</p>
                                </div>
                            </div>
                            <div class="tests" count-tests="{{$report->tests->count()}}">
                                @foreach($report->tests as $test)
                                    <?php  $testIndex = $loop->index;?>
                                    <div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <p>
                                                    Title :
                                                    {{$test->title }}
                                                </p>
                                            </div>
                                            <div class="col-lg-6 text-center">
                                                Test Form
                                            </div>
                                            <div class="col-lg-2">
                                                Description :
                                                <p>{{$test->desc }}</p>
                                            </div>
                                        </div>
                                        <div class="results" tests="{{$loop->index}}"
                                             count-results="{{$test->results->count()}}">
                                            @foreach($test->results as $result)
                                               <div class="row">
                                                    <div class="col-lg-2">
                                                        <p>
                                                            Result Title :
                                                            {{$result->title }}
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-6 text-center">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <p>
                                                            Result Value :
                                                            {{$result->value }}
                                                        </p>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
