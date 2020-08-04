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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
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

<h1>Add a loan</h1>


{{ Form::open(array('url' => 'loan')) }}

<div class="form-group">
    {{ Form::label('book_id', 'Book') }}
    {{ Form::select('book_id', $books, null, array('class' => 'form-control')) }}

    {{ Form::label('user_id', 'User') }}
    {{ Form::select('user_id', $users, null, array('class' => 'form-control')) }}

    {{ Form::label('loan_begin', 'Date of loaning') }}
    {{ Form::text('loan_begin', Request::old('loan_begin'), array('id' => 'datepicker_1', 'class' => 'form-control')) }}

    {{ Form::label('loan_end', 'Date of return') }}
    {{ Form::text('loan_end', Request::old('loan_end'), array('id' => 'datepicker_2', 'class' => 'form-control')) }}
</div>


{{ Form::submit('Add a new loan!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
    $(function() {
        $( "#datepicker_1" ).datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
    $(function() {
        $( "#datepicker_2" ).datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
</script>

<a href="/loan">See all loans!</a><br>

</body>
</html>
