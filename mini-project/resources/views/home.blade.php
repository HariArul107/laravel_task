<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f4ff;
            /* light blue background */
            min-height: 100vh;
            font-size: 14px;
            color: #333;
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


        /* Page Heading */
        h1 {
            text-align: center;
            margin: 40px 0 30px 0;
            font-size: 22px;
            font-weight: 700;
            color: #1e3a8a;
            /* dark blue */
        }

        /* Cards Layout */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            max-width: 1100px;
            margin: 0 auto 50px auto;
            padding: 0 20px;
        }

        .card-container a {
            text-decoration: none;
            color: inherit;
        }

        .card {
            background: #fff;
            /* white cards */
            padding: 25px 20px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #d1d5db;
            /* light gray border */
        }

        .card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 12px 30px rgba(30, 64, 175, 0.2);
            /* soft blue shadow */
        }

        .card h2 {
            font-size: 18px;
            font-weight: 600;
            color: #1e3a8a;
            /* dark blue text */
            margin-bottom: 12px;
        }

        .card p {
            font-size: 14px;
            color: #555;
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 22px;
            }

            .navbar {
                flex-direction: column;
                gap: 10px;
            }

            .card-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card {
                padding: 20px 15px;
            }

            .card h2 {
                font-size: 16px;
            }
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
    <h1>Inventory Management</h1>

    <!-- Card Layout -->
    <div class="card-container">
        <a href="/category">
            <div class="card">
                <h2>Category</h2>
            </div>
        </a>

        <a href="/item">
            <div class="card">
                <h2>Item</h2>
            </div>
        </a>

        <a href="/purchase">
            <div class="card">
                <h2>Purchase</h2>
            </div>
        </a>

        <a href="/sales">
            <div class="card">
                <h2>Sales</h2>
            </div>
        </a>

        <a href="/report">
            <div class="card">
                <h2>Report</h2>
            </div>
        </a>
    </div>

</body>

</html>