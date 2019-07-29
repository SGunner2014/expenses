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
            <table class="table">
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
                    </tr>
                </thead>
                <tbody>
                @foreach($week->getChildExpenses() as $child)
                    <th scope="col">N/A</th>
                    <th scope="col">{{$child->name}}</th>
                @endforeach
                </tbody>
            </table>
            <br/>
        @endforeach
    </div>
@endsection
