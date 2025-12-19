<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
    <style>
        /* General Body */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: #1e3a8a;
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .username {
            font-size: 20px;
            font-weight: 600;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            background: #2563eb;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
        }

        .navbar a:hover {
            background: #1d4ed8;
        }

        /* Page Title */
        h1 {
            text-align: center;
            margin: 40px 0 30px 0;
            font-size: 32px;
            font-weight: 600;
            color: #1e293b;
        }

        /* Form Container */
        .form-container {
            max-width: 650px;
            margin: 0 auto 50px auto;
            background: #fff;
            padding: 40px 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 15px;
            margin-top: 20px;
        }

        label:first-of-type {
            margin-top: 0;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 6px rgba(37, 99, 235, 0.3);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        button {
            margin-top: 25px;
            padding: 12px 20px;
            background: #2563eb;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background: #6b7280;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.3s ease;
        }

        .back-btn:hover {
            background: #4b5563;
        }

        /* Disabled inputs styling */
        input[disabled],
        select[disabled],
        textarea[disabled] {
            background: #e5e7eb;
            cursor: not-allowed;
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 28px;
            }

            .navbar .username {
                font-size: 18px;
            }
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
    <h1>Add New Sale</h1>

    <div class="form-container">
        <form action="/database-sale" method="post">
            @csrf

            <label for="customer_name">customer name</label>
            <input type="text" id="customer_name" name="customer_name" required>
            <br><br>

            <label for="sale_date">sale_date</label>
            <input type="date" id="sale_date" name="sale_date" required>
            <br><br>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required> </textarea>
            <br><br>

            <label for="purchase_id">Select Purchase:</label>
            <select name="purchase_id" id="purchase_id" required>
                <option value="">-- Select Purchase --</option>
                @foreach($purchases as $purchase)
                <option value="{{ $purchase->purchase_id }}"
                    data-price="{{ $purchase->item->prize }}"
                    data-quantity="{{ $purchase->quantity }}">
                    {{ $purchase->item->item_name }} (Available: {{ $purchase->quantity }})
                </option>
                @endforeach
            </select>
            <br><br>

            <label for="price">Item Price:</label>
            <input type="number" id="price" name="price" readonly>
            <br><br>

            <label for="discount">Discount Percentage:</label>
            <input type="number" id="discount" name="discount" min="1" max="99" required>
            <br><br>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" required>
            <br><br>

            <label for="total">Total Price ( discount applied):</label>
            <input type="number" name="total" id="total" readonly>
            <br><br>

            <button type="submit">Buy</button>
            <br>
            <a href="/sales" class="back-btn">← Back</a>
        </form>
    </div>

    <script>
        const purchaseSelect = document.getElementById('purchase_id');
        const priceInput = document.getElementById('price');
        const quantityInput = document.getElementById('quantity');
        const totalInput = document.getElementById('total');

        function updatePriceAndTotal() {
            const selectedOption = purchaseSelect.options[purchaseSelect.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price || 0);
            const maxQuantity = parseInt(selectedOption.dataset.quantity || 1);

            // Limit quantity to available quantity
            let quantity = parseInt(quantityInput.value);
            if (quantity > maxQuantity) quantity = maxQuantity;
            quantityInput.value = quantity;
            quantityInput.max = maxQuantity;

            priceInput.value = price;

            let discount = parseFloat(document.getElementById('discount').value) || 0;

            let total = price * quantity;
            total = total - (discount / 100 * total);
            totalInput.value = total.toFixed(2);

        }

        purchaseSelect.addEventListener('change', updatePriceAndTotal);
        quantityInput.addEventListener('input', updatePriceAndTotal);
        document.getElementById('discount').addEventListener('input', updatePriceAndTotal);
    </script>

</body>

</html>