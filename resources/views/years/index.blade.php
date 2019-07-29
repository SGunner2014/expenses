@extends("layouts.default")

@section("page-title")
    Financial Years
@endsection

@section("content")
    <div class="container" class="pt-4">
        <h1>Financial Years</h1>
        <h5>Below you will see the most recent 5 financial years added to the system. You are also able to add more and to modify existing years.</h5>
        <hr/>
        @foreach($years as $year)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{$year->year}}</h5>
                    <a href="/years/{{$year->id}}" class="btn btn-md btn-success">View/Modify Year >></a>
                </div>
            </div>
        @endforeach
        <br/>
        <a href="/years/create" class="btn btn-md btn-success">Register New Year</a>
    </div>
@endsection