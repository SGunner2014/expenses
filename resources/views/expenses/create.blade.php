@extends("layouts.default")

@section("title")
    Create new one-off expense
@endsection

@section("content")
    <div class="container">
        <h1>Add a new one-off expense for {{$week->getFullName()}}</h1>
        <hr/>
        <form action="/expenses" method="post">
            @csrf

            <input type="hidden" name="weekid" value="{{$week->id}}">
            <div class="form-group">
                <label for="details">Details</label>
                <input class="form-control" type="text" name="details" id="details">
            </div>
            <div class="form-group">
                <label for="category">Category*</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="1">Food and Drink</option>
                    <option value="2">Toys and Equipment</option>
                    <option value="3">Heating and Lighting</option>
                    <option value="4">Water Rates/Council Tax</option>
                    <option value="5">Travel/Outings</option>
                    <option value="6">Miscellaneous</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount*</label>
                <input class="form-control" type="number" step=".01" name="amount" id="amount" required>
            </div>
            <button class="btn btn-success btn-md" type="submit">Create Expense</button>
        </form>
    </div>
@endsection
