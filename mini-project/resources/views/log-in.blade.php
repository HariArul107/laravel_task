<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log-in</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ABE2, #5563DE);

            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        form {
            margin-left: 35%;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            width: 350px;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            background-color: #5563DE;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #3b4bb0;
        }

        p {
            text-align: center;
            color: #fff;
            margin-top: 15px;
        }

        a {
            color: #FFD700;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Log In Page</h1>
    <form action="/loginhome" method="post">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        @error('email')
        <div class="error" style="color:red; margin-bottom:10px; text-align:center;">{{ $message }}</div>
        @enderror
        <button type="submit">Log In</button>
    </form>
    <p> Don't have an account?
        <a href="/register"> Register here.</a>
    <p>
</body>

</html>