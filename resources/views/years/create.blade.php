@extends("layouts.default")

@section("page-title")
    Register a new year
@endsection

@section("content")
    <div class="container">
        <h1>Register a new financial year</h1>
        <hr/>
        <form action="/years" method="post">
            @csrf
            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" max="3000" class="form-control" id="year" name="year" value="{{old("year")}}"/>
            </div>
            <button class="btn btn-success btn-md" type="submit">Register Year</button>
        </form>
    </div>
@endsection