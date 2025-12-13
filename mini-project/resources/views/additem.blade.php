<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>

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
        input[type="number"],
        select {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            font-size: 15px;
            transition: 0.3s;
            color: #333;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
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

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="username">Welcome {{ session('user_name') }}</div>
        <div>
            <a href="/item">Back</a>
            <a href="/logout">Logout</a>
        </div>
    </div>

    <!-- Page Title -->
    <h1>Add New Item</h1>

    <!-- Form Container -->
    <div class="form-container">
        <a href="/item" class="back-btn">← Back</a>
        <form action="/database_item" method="post">
            @csrf
            <label for="name">Select Category</label>
            <select id="name" name="c_name" required>
                <option value="disabled">-- Select Category --</option>
                @forelse($categories as $cat)
                <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                @empty
                <option disabled>No categories available</option>
                @endforelse
            </select>
            @error('c_name')
            <span class="error">{{ $message }}</span>
            @enderror

            <label for="item">Item Name</label>
            <input type="text" id="item" name="item_name" required>

            <label for="prize">Prize</label>
            <input type="number" id="prize" name="prize" required min="1" max="999999">

            <button type="submit">ADD ITEM</button>
        </form>
    </div>
</body>

</html>