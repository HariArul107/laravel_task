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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .navbar .username {
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
            font-weight: 500;
        }

        .navbar a:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        /* Page Heading */
        h1 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 40px;
            font-size: 36px;
            color: white;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Cards Layout */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto 60px auto;
            padding: 0 20px;
        }

        .card-container a {
            text-decoration: none;
            color: inherit;
        }

        .card {
            background: white;
            padding: 50px 30px;
            text-align: center;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .card:hover::before {
            left: 100%;
        }

        .card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .card h2 {
            margin: 0;
            font-size: 26px;
            color: #333;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .card a {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .card a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
                margin-top: 30px;
            }

            .card-container {
                grid-template-columns: 1fr;
                padding: 0 15px;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
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
    <h1>Inventory management</h1>

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