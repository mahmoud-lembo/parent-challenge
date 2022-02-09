<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- Required meta tags-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Parent.cloud Challenge">
        <meta name="author" content="Mahmoud Mohamed">
        <meta name="keywords" content="Challenge">
    <head>
    <style>
    body{background-color: #eee};
    </style>
    <!--Page Title-->
    <title>Parent Challenge</title>

    <center>
    <h1>Welcome</h1>
    <a href="{{ url('/api/v1/users') }}">API JSON - </a>
    <a href="{{ url('/api/v1/users?gui') }}">API GUI</a></br>
    <h2>Availble Filters Examples </br> ( provider=DataProviderX | statusCode=authorised | balanceMin=10 | balanceMax=100 | balanceMin=10&balanceMax=100 | currency=EGP )</h2>
    </center>
</html>