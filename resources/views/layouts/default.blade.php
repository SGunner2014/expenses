<!DOCTYPE html>
<html lang="en-gb">
<head>
    <link rel="stylesheet" href="{{secure_asset("css/bootstrap.min.css")}}"/>
    <title>@yield("page-title")</title>
</head>

<body>
@if(\Auth::check())
    @include("layouts.header-loggedin")
@else
    @include("layouts.header-loggedout")
@endif

@yield("content")

@include("layouts.footer")

<!-- js attached last so page load quicker -->
<script src="{{secure_asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{secure_asset("js/bootstrap.min.js")}}"></script>
</body>
</html>
