<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAME-ASCII </title>
    <style>
        /* Reset some default styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f4f7f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        input[type="text"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        input[type="submit"] {
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            background: #007BFF;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        #error {
            color: red;
            margin-bottom: 10px;
            display: block;
            font-size: 14px;
        }

        #result {
            margin-top: 20px;
            padding: 15px;
            background: #e9f7ef;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            color: #155724;
            word-break: break-word;
        }

        #result h3 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <form>
        @csrf
        <label>
            <h2> ASCII values of characters in NAME </h2>
        </label>
        <input type="text" name="name" placeholder="Enter your name">
        <span id="error"></span>
        <input type="submit" value="Submit">
        <div id="result"></div>
    </form>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('/asciiprocess', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    const resultDiv = document.getElementById('result');
                    const errorSpan = document.getElementById('error');
                    if (data.status === 'error') {
                        errorSpan.textContent = data.error;
                        resultDiv.innerHTML = '';
                    } else {
                        errorSpan.textContent = '';
                        resultDiv.innerHTML = '<h3>ASCII Table:</h3>' + data.ascii;
                    }
                });
        });
    </script>
</body>

</html>