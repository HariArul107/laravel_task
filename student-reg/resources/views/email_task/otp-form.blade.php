<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .otp-box {
            width: 300px;
            margin: 80px auto;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: white;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .otp-box label {
            font-size: 18px;
            font-weight: bold;
            display: block;
            margin-bottom: 15px;
        }

        .otp-box input {
            width: 90%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: 0.2s;
        }

        .otp-box input:focus {
            border-color: #4a90e2;
        }

        .otp-box button {
            margin-top: 15px;
            width: 100%;
            padding: 12px;
            background: #4a90e2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .otp-box button:hover {
            background: #357ABD;
        }
    </style>
</head>

<body>
    <div class="otp-box">
        <form action="/verify-otp" method="POST">
            @csrf
            <label>Enter OTP</label>
            <input type="text" name="otp_input" placeholder="Enter your OTP" required>
            <button type="submit">Verify OTP</button>
        </form>
    </div>

</body>

</html>