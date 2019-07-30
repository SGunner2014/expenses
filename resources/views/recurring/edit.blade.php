@extends("layouts.default")

@section("page-title")
    {{$payment->details}}, £{{number_format($payment->amount / 100, 2)}}
@endsection

@section("content")
    <div class="container">
        <h1>{{$payment->details}}, £{{number_format($payment->amount / 100, 2)}}</h1>
        <hr/>
    </div>
@endsection