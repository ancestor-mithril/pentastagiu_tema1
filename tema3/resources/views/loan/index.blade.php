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

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
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

<div class="content">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>User</td>
            <td>Book</td>
            <td>Loan start</td>
            <td>Loan end</td>
            <td>Created_at</td>
            <td>Updated_at</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($loans as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td><a href="/user/{{ $value->user->id }}"> {{ $value->user->name }} </a></td>
                <td><a href="/book/{{ $value->book->id }}"> {{ $value->book->title }} </a></td>
                <td>{{ $value->loan_begin }}</td>
                <td>{{ $value->loan_end }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->updated_at }}</td>
                <td>
                    {{ Form::open(array('url' => 'loan/' . $value->id, 'class' => 'pull-right')) }}
                    {{ method_field('DELETE') }}
                    {{ Form::submit('Delete this Loan', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}
                    <a class="btn btn-small btn-success" href="{{ URL::to('loan/' . $value->id) }}">
                        Show this Loan</a>
                    <a class="btn btn-small btn-info" href="{{ URL::to('loan/' . $value->id . '/edit') }}">
                        Edit this Loan</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/loan/create">Add a new Loan!</a><br>
    <a href="/book">Visit books</a><br>
    <a href="/author">Visit authors</a><br>
    <a href="/publisher">Visit publishers</a><br>
    <a href="/user">Visit users</a><br>

</div>

</body>
</html>
