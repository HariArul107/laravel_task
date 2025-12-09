<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication table</title>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
</head>

<body>
    <form method="POST" action="/multiprocess">
        @csrf
        <label> Enter No of Coloum </label>
        <input type="number" name="col" min="1" max="10" value="{{$col}}" required>
        <label> Enter No Of Row </label>
        <input type="number" name="row" min="1" max="10" value="{{$row}}" required>
        <button type="submit" name="click" value="full">FULL TABLE</button>
        <button type="submit" name="click" value="table">TABLE </button>
    </form>

    @if($action == 'full')
    <table border='1' cellpadding='5'>
        <tr>
            <td> * </td>
            @for ($j = 1; $j <= $col; $j++)
                <td> {{ $j }}</td>

                @endfor
        </tr>
        @for ($i = 1; $i <= $row; $i++)
            <tr>
            <td> {{ $i }} </td>
            @for ($j = 1; $j <= $col; $j++)
                <td> {{ $i }} X {{$j}} = {{ ($i * $j) }} </td>
                @endfor
                </tr>
                @endfor
    </table>
    @endif
    @if($action == 'table')
    <table border='1' cellpadding='5'>
        @for ($i = 1; $i <= $row; $i++)
            <tr>
            @for ($j = 1; $j <= $col; $j++)
                <td> {{ $i }} X {{$j}} = {{ ($i * $j) }} </td>
                @endfor
                </tr>
                @endfor
    </table>
    @endif

</body>
</html>