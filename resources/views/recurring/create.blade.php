@extends("layouts.default")

@section("page-title")
    Create Recurring Cost
@endsection

@section("content")
    <div class="container">
        <h1>Create New Recurring Cost</h1>
        <hr/>
        <form method="post" action="/recurring">
            @csrf
            <div class="form-group">
                <label for="details">Details*</label>
                <input class="form-control" type="text" name="details" id="details" required>
            </div>
            <div class="form-group">
                <label for="category">Category*</label>
                <select name="category" id="category" class="form-control">
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
            <input type="hidden" name="active" value="on">
            <button class="btn btn-success btn-md" type="submit">Create Cost</button>
        </form>
    </div>
@endsection
