<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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
        }

        .navbar a:hover {
            background: #003f87;
        }

        /* Page Heading */
        h1 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
        }

        /* Cards Layout */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 40px 20px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card h2 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        .card a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
        }

        .card a:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="username">Welcome {{ session('user_name') }}</div>
        <a href="/logout">Logout</a>
    </div>

    <!-- Page Title -->
    <h1>Dashboard</h1>

    <!-- Card Layout -->
    <div class="card-container">

        <div class="card">
            <h2>Category</h2>
            <a href="/category">View</a>
        </div>

        <div class="card">
            <h2>Item</h2>
            <a href="/item">View</a>
        </div>

        <div class="card">
            <h2>Purchase</h2>
            <a href="/purchase">View</a>
        </div>

        <div class="card">
            <h2>Report</h2>
            <a href="/report">View</a>
        </div>

    </div>

</body>

</html>
