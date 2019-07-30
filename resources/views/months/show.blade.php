@extends("layouts.default")

@section("page-title")
    {{$month->name}}, {{$year->year}}
@endsection

@section("content")
    <div class="container">
        <h1>{{$month->name}}, {{$year->year}}</h1>
        <br/>
        @foreach($month->getWeeks() as $week)
            <h4>Week #{{$week->week}}</h4>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Details</th>
                        <th scope="col">Food and Drink</th>
                        <th scope="col">Toys and Equipment</th>
                        <th scope="col">Heating and Lighting</th>
                        <th scope="col">Water Rates/Council Tax</th>
                        <th scope="col">Travel/Outings</th>
                        <th scope="col">Miscellaneous</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($week->getChildExpenses() as $childExpenses)
                    <tr>
                        <td>N/A</td>
                        <td>{{$childExpenses[0]["name"]}}</td>
                        <td>£{{number_format($childExpenses[1]->amount, 2, ".", "")}}</td>
                        <td>£{{number_format($childExpenses[2]->amount, 2, ".", "")}}</td>
                        <td>£{{number_format($childExpenses[3]->amount, 2, ".", "")}}</td>
                        <td>£{{number_format($childExpenses[4]->amount, 2, ".", "")}}</td>
                        <td>£{{number_format($childExpenses[5]->amount, 2, ".", "")}}</td>
                        <td>£{{number_format($childExpenses[6]->amount, 2, ".", "")}}</td>
                        <td>tots</td>
                        <td><a href="/expenses/{{$childExpenses[0]["id"]}}"</td>
                    </tr>
                @endforeach
                @foreach($week->getPayments() as $payment)
                    <tr>
                        <td>N/A</td>
                        <td>{{$payment->details}}</td>
                        <td>£{{number_format($payment->category == 1 ? $payment->amount : 0, 2, ".", "")}}</td>
                        <td>£{{number_format($payment->category == 2 ? $payment->amount : 0, 2, ".", "")}}</td>
                        <td>£{{number_format($payment->category == 3 ? $payment->amount : 0, 2, ".", "")}}</td>
                        <td>£{{number_format($payment->category == 4 ? $payment->amount : 0, 2, ".", "")}}</td>
                        <td>£{{number_format($payment->category == 5 ? $payment->amount : 0, 2, ".", "")}}</td>
                        <td>£{{number_format($payment->category == 6 ? $payment->amount : 0, 2, ".", "")}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br/>
        @endforeach
    </div>
@endsection
