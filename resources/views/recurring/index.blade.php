@extends("layouts.default")

@section("page-title")
    Recurring Payments
@endsection

@section("content")
    <div class="container">
        <h1>Recurring Payments</h1>
        <hr/>
        <a href="/recurring/create" class="btn btn-success btn-md mb-2">Create New Recurring Cost</a>
        <h5>Active Costs</h5>
        <table class="table mb-lg-2">
            <thead>
                <tr>
                    <th scope="col">Details</th>
                    <th scope="col">Category</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recurring as $recur)
                    <tr>
                        <td>{{$recur->details}}</td>
                        <td>{{$recur->getCategoryText()}}</td>
                        <td>£{{$recur->amount}}</td>
                        <td><a href="/recurring/{{$recur->id}}/edit" class="btn btn-primary btn-md">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h5 class="mt-4">Inactive Costs</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Details</th>
                    <th scope="col">Category</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inactive as $cost)
                    <tr>
                        <td>{{$cost->details}}</td>
                        <td>{{$cost->getCategoryText()}}</td>
                        <td>{{$cost->amount}}</td>
                        <td><a href="/recurring/{{$cost->id}}/edit" class="btn btn-primary btn-md">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
