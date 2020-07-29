<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>

@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Add a book</h1>


{{ Form::open(array('url' => 'book')) }}

<div class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', Request::old('title'), array('class' => 'form-control')) }}

    {{ Form::label('author_id', 'Author') }}
    {{ Form::select('author_id', $authors, null, array('class' => 'form-control')) }}

    {{ Form::label('publisher_id', 'Publisher') }}
    {{ Form::select('publisher_id', $publishers, null, array('class' => 'form-control')) }}

    {{ Form::label('publisher_year', 'Publisher year') }}
    {{ Form::text('publisher_year', Request::old('publisher_year'), array('class' => 'form-control')) }}
</div>


{{ Form::submit('Add a new book!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

<a href="/book">See all books!</a><br>

</body>
</html>
