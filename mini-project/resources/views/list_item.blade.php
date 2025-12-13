<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>

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

        /* Page Heading */
        h1 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
        }

        /* Container and Header Section */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 30px;
        }

        .header-section a {
            background: #007bff;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
            display: inline-block;
        }

        .header-section a:first-child {
            background: #6c757d;
        }

        .header-section a:first-child:hover {
            background: #5a6268;
        }

        .header-section a:hover {
            background: #0056b3;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        thead {
            background: #007bff;
            color: white;
        }

        thead td {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border: none;
            font-size: 16px;
        }

        tbody tr {
            border-bottom: 1px solid #e0e0e0;
            transition: 0.3s;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        td {
            padding: 15px;
            color: #333;
            font-size: 15px;
        }

        .empty-message {
            text-align: center;
            color: #007bff;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="username">Welcome {{ session('user_name') }}</div>
        <div>
            <a href="/logout">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Items</h1>
        <div class="header-section">
            <a href="/add_item">+ ADD NEW ITEM</a>
            <a href="/home">← Back</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Category Name</td>
                    <td>Item Name</td>
                    <td>Item Price</td>
                    <td >edit</td>
                    <td>delete</td>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>{{ $item->category_name }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->prize }}</td>
                    <td>
                        <a href="/item/edit/{{ $item->item_id }}" title="Edit">
                            ✏️
                        </a>
                    </td>
                    <td>
                        <a href="/item/delete/{{ $item->item_id}}">
                            🗑️
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty-message">No items found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>