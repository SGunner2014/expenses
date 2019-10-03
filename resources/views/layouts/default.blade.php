<!DOCTYPE html>
<html lang="en-gb">
<head>
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}"/>
    <title>@yield("page-title")</title>
</head>

<body>
@if(\Auth::check())
    @include("layouts.header-loggedin")
@else
    @include("layouts.header-loggedout")
@endif

<br/>

<div class="mb-lg-5 pb-lg-4">
    @yield("content")
</div>

@include("layouts.footer")

<!-- js attached last so page load quicker -->
<script src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
</body>
</html>
