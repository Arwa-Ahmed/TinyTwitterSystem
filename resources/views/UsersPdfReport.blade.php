<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container mt-5">
    <h2 class="text-center mb-3">Users Report</h2>
    <h4> Total Number Of Tweets: {{$totalTweets}}</h4>
    <table class="table table-bordered mb-5" style="text-align: center">
        <thead>
        <tr class="table-info">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Birth Date</th>
            <th scope="col">Number Of Tweets</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users ?? '' as $user)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->birth_date }}</td>
                <td>{{ $user->tweets()->count() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h4> Average Number Of Tweets Per User: {{$averageNumberOfTweets}}</h4>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
