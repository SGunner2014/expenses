@extends("layouts.default")

@section("page-title")
    {{$month->name}}, {{$year->year}}
@endsection

@section("content")
    <div class="container">
        <h1>{{$month->name}}, {{$year->year}}</h1>
    </div>
@endsection