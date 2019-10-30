@extends("layouts.default")

@section("page-title")
    Expenses
@endsection

@section("content")
    <div class="container">
        <h1>Expenses</h1>
        <p class="text-muted">Welcome to Expenses. You can track children (when they join and leave), track recurring expenses each month and automatically generate your expenses. The system offers a great degree of flexibility with each month/week. The core features of the system can be accessed below.</p>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Years</h5>
                        <p class="card-text">View the financial years that you have logged.</p>
                        <a href="/years" class="btn btn-success btn-md">View Years >></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Children</h5>
                        <p class="card-text">View children that you have registered on the system.</p>
                        <a href="/children" class="btn btn-success btn-md">View Children >></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recurring Expenses</h5>
                        <p class="card-text">View recurring expenses and edit existing ones.</p>
                        <a href="/recurring" class="btn btn-success btn-md">View Recurring Expenses >></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manuals (Coming Soon!)</h5>
                        <p class="card-text">Get some help on how to use the site</p>
                        <a href="/manuals" class="disabled btn btn-success btn-md">View Manuals</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
