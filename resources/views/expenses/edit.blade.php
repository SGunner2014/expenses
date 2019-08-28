@extends("layouts.default")

@section("page-title")
    Edit Expense
@endsection

@section("content")
    <div class="container">
        <h1>Edit an existing expense</h1>
        <h5 class="text-muted">Week #{{$expense->getWeekNo()}} of {{$expense->getMonth()}}, {{$expense->getYear()}}</h5>
        <hr/>
        <form action="/expenses/{{$expense->id}}" method="post">
            @csrf
            @method("PATCH")
            @if($expense->details)
                <div class="form-group">
                    <label for="details">Details</label>
                    <input class="form-control" type="text" name="details" id="details" value="{{$expense->details}}" placeholder="Details">
                </div>
            @elseif($expense->childid)
                <div class="form-group">
                    <label for="name">Details</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{\App\Child::find($expense->childid)->name}}" disabled>
                </div>
            @endif
            <div class="form-group">
                <label for="amount">Amount*</label>
                <input class="form-control" step=".01" type="number" name="amount" id="amount" value="{{$expense->amount / 100}}">
            </div>
            @if($expense->date)
            <div class="form-group">
                <label for="date">Date*</label>
                <input class="form-control" type="date" name="date" id="date" value="{{date("Y-m-d", $expense->date)}}">
            </div>
            @endif
            <div class="form-group">
                <label for="category">Category*</label>
                <select name="category" id="category" class="form-control" value="{{$expense->category}}">
                    <option value="1">Food and Drink</option>
                    <option value="2">Toys and Equipment</option>
                    <option value="3">Heating and Lighting</option>
                    <option value="4">Water Rates/Council Tax</option>
                    <option value="5">Travel/Outings</option>
                    <option value="6">Miscellaneous</option>
                </select>
            </div>
            <button class="btn btn-md btn-success" type="submit">Submit Changes</button>
        </form>
    </div>
@endsection