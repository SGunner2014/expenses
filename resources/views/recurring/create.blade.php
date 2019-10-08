@extends("layouts.default")

@section("page-title")
    Create Recurring Cost
@endsection

@section("content")
    <div class="container">
        <h1>Create New Recurring Cost</h1>
        <p class="text-muted">This will create a new recurring cost - this will automatically be accounted for each month when generating a new year in the system. You can decide whether it is a weekly expense or a monthly expense.</p>
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
            <div class="form-group">
                <label for="monthly">Monthly? (if not, weekly)*</label>
                <div class="row">
                    <div class="col-sm-1">
                        <input class="form-control left" type="checkbox" name="monthly" id="monthly" checked>
                    </div>
                    <div class="col-sm-11"></div>
                </div>
            </div>
            <input type="hidden" name="active" value="on">
            <button class="btn btn-success btn-md" type="submit">Create Cost</button>
        </form>
        @if($errors->any())
            <br/>
            <div class="alert alert-danger">
                <p><strong>The following errors must be corrected before continuing:</strong></p>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
