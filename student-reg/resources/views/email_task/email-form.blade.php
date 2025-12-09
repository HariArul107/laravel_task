<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Form with OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .email-form {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .email-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .email-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .email-form input[type="email"],
        .email-form input[type="file"],
        .email-form textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1.5px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
        }

        .email-form input:focus,
        .email-form textarea:focus {
            border-color: #4a90e2;
        }

        .email-form button {
            width: 100%;
            padding: 12px;
            background: #4a90e2;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .email-form button:hover {
            background: #357ABD;
        }
    </style>
</head>

<body>

    <div class="email-form">
        <h2>Email Form with OTP</h2>
        <form action="/send" method="POST" enctype="multipart/form-data">
            @csrf
            <label>From Email:</label>
            <input type="email" name="from_email" placeholder="Enter your email" required>

            <label>To Email:</label>
            <input type="email" name="to_email" placeholder="Recipient email" required>

            <label>Upload File:</label>
            <input type="file" name="uploadfile" required>

            <label>Message:</label>
            <textarea name="message" rows="4" placeholder="Type your message here" required></textarea>

            <button type="submit">Generate OTP</button>

        </form>
    </div>

</body>

</html>