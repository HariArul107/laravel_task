<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    @if(!empty($data))
    <div class="form-container">
        <div class="result">
            
            <h2>Submitted Data:</h2>
            <p><strong>First Name:</strong> {{ $data['Fname'] }}</p>
            <p><strong>Last Name:</strong> {{ $data['Lname'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Phone Number:</strong> {{ $data['phone'] }}</p>
            <p><strong>Date of Birth:</strong> {{ $data['dob'] }}</p>
            <p><strong>Gender:</strong> {{ $data['gender'] }}</p>
            <p><strong>Year of Passing:</strong> {{ $data['YOP'] }}</p>
            <p><strong>Skills:</strong> {{ is_array($data['skills']) ? implode(', ', $data['skills']) : 'None' }}</p>
            <p><strong>Address:</strong> {{ $data['address'] }}</p>
        </div>
    </div>
    @endif

</body>

</html>