<style>
    .row {
        display: block;
    }

    td {
        text-align: center;
    }
    table{
        border-collapse: collapse;
    }

</style>
<div style="width: 70%; margin: auto;">
    <div class="row">
        <p class="col-lg-2">
            Operator :
            {{$report->operator->name}}
        </p>
        <p>
            Patient  : {{$report->patient->name}}
        </p>
    </div>
    @foreach($report->tests as $test)
        <p style="text-align: center;">
            Test #{{$test->id}}
        </p>
        <div style="margin-left: 20px;">
            <p>
                Title : {{$test->title}}
            </p>
            <p>
                Desc : {{$test->desc}}
            </p>
        </div>
        <table class="table table-bordered" style="border: thin; width: 100%;" border="1">
            <tr>
                <th>
                    title
                </th>
                <th>
                    result
                </th>
            </tr>
            @foreach($test->results as $result)
                <tr>
                    <td>
                        <p>{{$result->title }}</p>
                    </td>
                    <td>
                        <p>{{$result->value }}</p>
                    </td>
                </tr>
            @endforeach
        </table>
    @endforeach
</div>
