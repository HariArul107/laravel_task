<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Calculator</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
            color: #555;
        }

        input[type="date"] {
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px;
            width: 100%;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #45a049;
        }

        .error {
            margin-top: 20px;
            background: #ffdddd;
            padding: 15px;
            border-radius: 5px;
            color: #d8000c;
            font-size: 18px;
            font-weight: bold;
        }

        .result {
            margin-top: 20px;
            background: #e7f7e7;
            padding: 15px;
            border-radius: 5px;
            color: #2e7d32;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Age Calculator</h1>

        <form>
            @csrf
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            <input type="submit" value="Calculate Age">
        </form>
        <div id="res">
        </div>

    </div>
    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            fetch('/ageprocess', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById("res").innerHTML = data;
                })
        });
    </script>

</body>

</html>