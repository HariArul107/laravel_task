<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        /* Navbar */
        .navbar {
            background: #007bff;
            color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .username {
            font-size: 22px;
            font-weight: bold;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 8px 15px;
            background: #0056b3;
            border-radius: 5px;
            transition: 0.3s;
            margin-left: 10px;
        }

        .navbar a:hover {
            background: #003f87;
        }

        /* Page Title */
        h1 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
        }

        /* Form Container */
        .form-container {
            max-width: 600px;
            margin: 0 auto 40px auto;
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #333;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 16px;
        }

        label:first-of-type {
            margin-top: 0;
        }

        input[type="text"],
        textarea {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            font-size: 15px;
            transition: 0.3s;
            color: #333;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        textarea {
            min-height: 120px;
            resize: none;
        }

        button {
            margin-top: 30px;
            padding: 12px 28px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            font-weight: 600;
            margin-top: 5px;
            display: block;
        }

        .back-btn {
            display: inline-block;
            text-align: center;
            margin-bottom: 20px;
            padding: 10px 18px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #5a6268;
        }
    </style>
</head>
<!-- i                have   -->
<!--  {{ session('user_id') }} -->
<!-- {{ session('user_name') }} -->

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="username">Welcome {{ session('user_name') }}</div>
        <a href="/logout">Logout</a>
    </div>

    <!-- Page Title -->
    <h1>Add New Purchase</h1>

    <!-- Form Container -->
    <div class="form-container">
        

        <form action="/database-purchase" method="post">


            @csrf

            <label for="item_id">Select Item:</label>
            <select name="item_id" id="item_id" required>
                <option value="">-- Select Item --</option>
                @foreach($items as $item)
                <option value="{{ $item->item_id }}" data-price="{{ $item->prize }}">
                    {{ $item->item_name }}
                </option>
                @endforeach
            </select>
            <br><br>

            <label for="price">Item Price:</label>
            <input type="number" id="price" name="price" readonly>
            <br><br>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1"  max="9999" required>
            <br><br>

            <label for="total">Total Price:</label>
            <input type="number" name="total" id="total" readonly>
            <br><br>
            <script>
                const itemSelect = document.getElementById('item_id');
                const priceInput = document.getElementById('price');
                const quantityInput = document.getElementById('quantity');
                const totalInput = document.getElementById('total');

                function updatePriceAndTotal() {
                    const selectedOption = itemSelect.options[itemSelect.selectedIndex];
                    const price = selectedOption.dataset.price || 0;
                    const quantity = quantityInput.value || 1;

                    priceInput.value = price;
                    totalInput.value = price * quantity;
                }

                itemSelect.addEventListener('change', updatePriceAndTotal);
                quantityInput.addEventListener('input', updatePriceAndTotal);
            </script>



            <button type="submit">Add Purchase</button>
            <br>
            <a href="/purchase" class="back-btn">← Back</a>
        </form>
    </div>
</body>

</html>