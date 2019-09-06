@extends("layouts.default")

@section("page-title")
    Children
@endsection

@section("content")
    <div class="container">
        <h1>Children</h1>
        <h5>Here you can view currently active children, as well as modify existing ones.</h5>
        <hr/>
        <a class="btn btn-success btn-md mb-2" href="/children/create">Register a new child</a>
        <h5>Active Children</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Date Registered</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($active as $child)
                    <tr>
                        <td>{{$child->name}}</td>
                        <td>{{date("d/m/Y", $child->startDate)}}</td>
                        <td>
                            <form method="post" action="/children/{{$child->id}}">
                                @method("PATCH")
                                @csrf
                                <input type="hidden" name="childid" value="{{$child->id}}">
                                <input type="hidden" name="active" value="off">
                                <button type="submit" class="btn btn-md btn-danger">Make Inactive</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Inactive Children</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Date Registered</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inactive as $child)
                    <tr>
                        <td>{{$child->name}}</td>
                        <td>{{date("d/m/Y", $child->startDate)}}</td>
                        <td>{{date("d/m/Y", $child->endDate)}}</td>
                        <td>
                            <form method="post" action="/children/{{$child->id}}">
                                @csrf
                                @method("PATCH")
                                <input type="hidden" name="active" value="on">
                                <input type="hidden" name="childid" value="{{$child->id}}">
                                <button class="btn btn-success btn-md" type="submit">Make Active</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
