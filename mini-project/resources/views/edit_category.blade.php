<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>

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
            margin-left: 10px;
        }

        .navbar a:hover {
            background: #1d4ed8;
        }

        /* Page Title */
        h2 {
            text-align: center;
            margin: 40px 0 30px 0;
            font-size: 32px;
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
        textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 6px rgba(37, 99, 235, 0.3);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            /* white text */
            background-color: #1e40af;
            /* solid blue background */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .back-btn:hover {
            background-color: #1e3a8a;
            /* slightly darker blue on hover */
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(30, 64, 175, 0.4);
        }











        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        button {
            flex: 1;
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

        .cancel-btn {
            flex: 1;
            background: #6b7280;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: 0.3s ease;
        }


        .cancel-btn:hover {
            background: #4b5563;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Disabled fields */
        input[disabled],
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

            h2 {
                font-size: 28px;
            }

            .navbar .username {
                font-size: 18px;
            }

            .button-group {
                flex-direction: column;
            }

        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="username">Welcome {{ session('user_name') }}</div>
        <div>
            <a href="/category">Back</a>
            <a href="/logout">Logout</a>
        </div>
    </div>

    <!-- Page Title -->
    <h2>Edit Category</h2>

    <!-- Form Container -->
    <div class="form-container">
        <form action="{{ url('/category/update/'.$category->category_id) }}" method="POST">
            @csrf

            <label for="category_name">Category Name</label>
            <input type="text" id="category_name" name="category_name"
                value="{{ old('category_name', $category->category_name) }}" @if(!$editable) readonly @endif required>
            @error('category_name')
            <span class="error">{{ $message }}</span>
            @enderror

            <label for="description">Description</label>
            <textarea id="description" name="description" @if(!$editable) readonly @endif
                required>{{ old('description', $category->category_description) }}</textarea>
            @error('description')
            <span class="error">{{ $message }}</span>
            @enderror
            @if($editable)
            <div class="button-group">
                <button type="submit">UPDATE</button>
                <a href="/category" class="cancel-btn">CANCEL</a>
            </div>
            @else
            <br>
            <a href="/category" class="back-btn">BACK</a>

            @endif

        </form>
    </div>
</body>

</html>