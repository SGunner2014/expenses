@extends("layouts.default")

@section("page-title")
    {{$month->name}}, {{$year->year}}
@endsection

@section("content")
    <div class="container">
        <h1>{{$month->name}}, {{$year->year}}</h1>
        <hr/>
        <div class="row">
            <div class="col-sm-3">
                <a href="/years/{{$year->id}}/months/{{$month->id}}/regenerate" class="disabled btn btn-danger btn-sm mb-2">Regenerate Automatic Content</a>
            </div>
            <div class="col-sm-9">
                <p class="text-muted">Caution! This will delete all child payments and recurring payments for this month and cannot be undone!</p>
            </div>
        </div>
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
                <?php $expenses = $week->getExpenses(); ?>
                {{-- Show all child-related expenses --}}
                @foreach($expenses["child"] as $expense)
                    <tr>
                        <td>N/A</td>
                        <td>{{$expense["details"]}}</td>
                        <td>{{$expense[1]["display"]}}</td>
                        <td>{{$expense[2]["display"]}}</td>
                        <td>{{$expense[3]["display"]}}</td>
                        <td>{{$expense[4]["display"]}}</td>
                        <td>{{$expense[5]["display"]}}</td>
                        <td>{{$expense[6]["display"]}}</td>
                        <td>{{$expense["total"]["display"]}}</td>
                        <td>
                            <a href="/expenses/{{$expense["id"]}}/edit" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="/expenses/{{$expense["id"]}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                {{-- Show all recurring expenses --}}
                @foreach($expenses["recurring"] as $expense)
                    <tr>
                        <td>N/A</td>
                        <td>{{$expense["details"]}}</td>
                        <td>{{$expense[1]["display"]}}</td>
                        <td>{{$expense[2]["display"]}}</td>
                        <td>{{$expense[3]["display"]}}</td>
                        <td>{{$expense[4]["display"]}}</td>
                        <td>{{$expense[5]["display"]}}</td>
                        <td>{{$expense[6]["display"]}}</td>
                        <td>{{$expense["total"]["display"]}}</td>
                        <td>
                            <a href="/expenses/{{$expense["id"]}}/edit" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="/expenses/{{$expense["id"]}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @foreach($expenses["oneoff"] as $expense)
                    <tr>
                        <td>N/A</td>
                        <td>{{$expense["details"]}}</td>
                        <td>{{$expense[1]["display"]}}</td>
                        <td>{{$expense[2]["display"]}}</td>
                        <td>{{$expense[3]["display"]}}</td>
                        <td>{{$expense[4]["display"]}}</td>
                        <td>{{$expense[5]["display"]}}</td>
                        <td>{{$expense[6]["display"]}}</td>
                        <td>{{$expense["total"]["display"]}}</td>
                        <td>
                            <a href="/expenses/{{$expense["id"]}}/edit" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="/expenses/{{$expense["id"]}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                {{-- Show grand total --}}
                <tr class="table-success">
                    <td colspan="2"><strong>Total</strong></td>
                    <td>{{$expenses["total"][1]["display"]}}</td>
                    <td>{{$expenses["total"][2]["display"]}}</td>
                    <td>{{$expenses["total"][3]["display"]}}</td>
                    <td>{{$expenses["total"][4]["display"]}}</td>
                    <td>{{$expenses["total"][5]["display"]}}</td>
                    <td>{{$expenses["total"][6]["display"]}}</td>
                    <td>{{$expenses["total"]["total"]["display"]}}</td>
                    <td><a href="/expenses/create?week={{$week->id}}" class="btn btn-success btn-sm">Add Expense</a></td>
                </tr>
                </tbody>
            </table>
            <br/>
        @endforeach
    </div>
@endsection
