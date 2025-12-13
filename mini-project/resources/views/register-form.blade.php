<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register-page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ABE2, #5563DE);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            margin: 10px 0;
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            width: 600px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 2rem;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .gender-box {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            align-items: center;
        }

        .gender-box input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #5563DE;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #3b4bb0;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: -15px;
            margin-bottom: 10px;
            display: block;
        }
    </style>


</head>

<body>
    <div class="form-container">
        <form method="post" action="/store-data">
            <h2>Registration Form</h2>

            <label for="Fname">First Name:</label>
            <input type="text" id="Fname" name="Fname" value="{{ old('Fname') }}" required>
            @error('Fname') <span class="error">{{ $message }}</span> @enderror


            <label for="Lname">Last Name:</label>
            <input type="text" id="Lname" name="Lname" value="{{ old('Lname') }}" required>
            @error('Lname') <span class="error">{{ $message }}</span> @enderror


            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" maxlength="10" required>
            @error('phone') <span class="error">{{ $message }}</span> @enderror

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required>
            @error('dob') <span class="error">{{ $message }}</span> @enderror

            <label>Gender:</label>
            <div class="gender-box">
                <input type="radio" id="male" name="gender" value="male" {{ old('gender')=='male' ? 'checked' : '' }} required>
                Male
                <input type="radio" id="female" name="gender" value="female" {{ old('gender')=='female' ? 'checked' : '' }} required>
                Female
            </div>
            @error('gender') <span class="error">{{ $message }}</span> @enderror

            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror


            <input type="submit" value="Submit">

            @csrf
        </form>
</body>

</html>