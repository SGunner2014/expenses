@extends("layouts.default")

@section("page-title")
    Financial Year - {{$year->year}}
@endsection

@section("content")
    <div class="container">
        <h1>{{$year->year}}</h1>
        <hr/>
        <div class="row">
            <div class="col-sm-3">
                <a href="/years/{{$year->id}}/regenerate" class="btn btn-danger btn-sm mb-2">Regenerate Automatic Content</a>
            </div>
            <div class="col-sm-9">
                <p class="text-muted">Caution! This will delete all child payments and recurring payments for this month and cannot be undone!</p>
            </div>
            <div class="col-sm-3">
                <form action="/years/{{$year->id}}" method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger btn-sm mb-2">Delete Year</button>
                </form>
            </div>
            <div class="col-sm-9">
                <p class="text-muted">Caution! This will delete the year and all data associated with this year! This cannot be undone!</p>
            </div>
        </div>
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
