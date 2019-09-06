@extends("layouts.default")

@section("title")
    Register a new child
@endsection

@section("content")
    <div class="container">
        <h1>Register a new child</h1>
        <p class="text-muted">This will register a new child in the system that will then automatically be accounted for each month when generating a new year in the system. Each child will appear once for each week in each month.</p>
        <hr/>
        <form action="/children" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name*</label>
                <input class="form-control" type="text" id="name" name="name" value="{{old("name")}}" required>
            </div>
            <div class="form-group">
                <label for="startDate">Start Date*</label>
                <input class="form-control" type="date" id="startDate" name="startDate" value="{{old("startDate")}}" required>
            </div>
            <div class="form-group">
                <label for="endDate">End Date</label>
                <input class="form-control" type="date" id="endDate" name="endDate" value="{{old("endDate")}}">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="active" name="active" checked>
                <label class="form-check-label" for="active">Child is Active</label>
            </div>
            <div class="form-group">
                <label for="foodCosts">Food/Drink Costs (weekly)*</label>
                <input class="form-control" type="number" step=".01" id="foodCosts" name="foodCosts" value="{{old("foodCost")}}" required>
            </div>
            <button class="btn btn-primary btn-md mt-2">Register Child</button>
        </form>
    </div>
@endsection
