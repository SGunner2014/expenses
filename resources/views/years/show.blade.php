@extends("layouts.default")

@section("page-title")
    Financial Year - {{$year->year}}
@endsection

@section("content")
    <div class="container">
        <h1>{{$year->year}}</h1>
        <hr/>
        @foreach($year->getMonths() as $month)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{$month->name}}</h5>
                    <a href="/years/{{$year->id}}/months/{{$month->id}}" class="btn btn-success btn-md">View Month >></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection