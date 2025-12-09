<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Reset some default styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f0f4f8;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            text-align: left;
        }

        input[type="tel"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
        }

        input[type="tel"]:focus {
            border-color: #007bff;
            outline: none;
        }

        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 12px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background: #0056b3;

        }

        #result {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }

        #error {
            color: red;
        }
    </style>
</head>

<body>
    <form>
        @csrf
        <h2>num to word</h2>
        <label for="number">Enter a number:</label>
        <input type="tel" id="number" name="number" required maxlength="12">
        <span id="error"></span>
        <input type="submit" value="Convert">
        <input type="reset" value="reset">
    </form>
    <div id="result"></div>

    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const number = document.getElementById('number').value;
            var result = document.getElementById("result");
            var err = document.getElementById("error");

            const formData = new FormData(this);
            if (number >= 0) {

                fetch('/numwordprocess', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    }).then(response => response.json())
                    .then(data => {
                        // err.innerHTML = "";
                        // result.innerHTML = data;
                        err.innerHTML = "";
                        result.innerHTML = '<p>' + data.res + '</p>';
                    })
                    .catch(error => {
                        console.error('Error:', error);

                    });
            } else {
                result.innerHTML = "";
                err.innerHTML = "Invalid Number";
            }
        });
    </script>
</body>

</html>