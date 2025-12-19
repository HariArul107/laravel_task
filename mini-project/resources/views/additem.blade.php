<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>

    <style>
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
            margin-left: 10px;
        }

        .navbar a:hover {
            background: #1d4ed8;
        }

        /* Page Title */
        h1 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
            color: #1e293b;
        }

        /* Form Container */
        .form-container {
            max-width: 600px;
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
        select {
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
        select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 6px rgba(37, 99, 235, 0.3);
        }

        button {
            margin-top: 30px;
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

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            background: #6b7280;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            transition: 0.3s ease;
        }

        .back-btn:hover {
            background: #4b5563;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
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
        <form action="/database_item" method="post">
            @csrf

            <label for="name">Select Category</label>
            <select id="name" name="c_name" required>
                <option value="">-- Select Category --</option>
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
            <a href="/item" class="back-btn">Back</a>
        </form>
    </div>
</body>
</html>