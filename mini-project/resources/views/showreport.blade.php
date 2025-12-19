<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            background-color: #f1f3f6;
            color: #2c2c2c;
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

        /* Page Title */
        h1 {
            text-align: center;
            margin: 30px 0 15px;
            font-size: 22px;
            font-weight: 600;
            color: #111827;
        }

        /* Header */
        .header-section {
            max-width: 1200px;
            margin: 0 auto 15px;
        }

        .header-section a {
            background-color: #1145b6ff;
            color: #ffffff;
            padding: 6px 14px;
            font-size: 13px;
            border-radius: 4px;
            text-decoration: none;
        }

        /* Date Filter Section */
        label {
            font-size: 13px;
            font-weight: 600;
            margin-left: 20px;
        }

        input[type="date"] {
            padding: 6px 10px;
            font-size: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            margin-right: 15px;
        }

        /* Table Container */
        #reportTable_wrapper {
            max-width: 1200px;
            margin: 20px auto;
            background: #ffffff;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }

        /* DataTable */
        table.dataTable {
            border-collapse: collapse;
            font-size: 13px;
        }

        table.dataTable thead th {
            background-color: #f9fafb;
            color: #111827;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
            padding: 10px;
        }

        table.dataTable tbody td {
            padding: 9px;
            border-bottom: 1px solid #e5e7eb;
        }

        /* Remove hover effects */
        table.dataTable tbody tr:hover {
            background: none;
        }

        /* Pagination */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 4px 10px;
            margin: 0 2px;
            font-size: 12px;
            border-radius: 3px;
            border: 1px solid #d1d5db;
            background: #ffffff;
            color: #111827 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #2563eb !important;
            color: #ffffff !important;
            border: none;
        }

        /* Summary Section */
        h3 {
            max-width: 1200px;
            margin: 6px auto;
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
        }


        /* Filter Section Alignment */
        .filter-section {
            max-width: 1200px;
            margin: 0 auto 15px;
            display: flex;
            gap: 20px;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 4px;
            margin-left: 0;
        }

        /* Summary Alignment */
        .summary-section {
            max-width: 1200px;
            margin: 10px auto 30px;
        }

        #goFilter {
            padding: 7px 16px;
            font-size: 13px;
            font-weight: 600;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #goFilter:active {
            background-color: #1e40af;
        }

        /* Filter Section */
        .filter-section {
            max-width: 1200px;
            margin: 0 auto 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-end;
        }

        /* Each filter group */
        .filter-group {
            display: flex;
            flex-direction: column;
            min-width: 180px;
            /* Adjust width as needed */
        }

        /* Labels */
        .filter-group label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        /* Inputs and Selects */
        .filter-group input[type="date"],
        .filter-group select {
            padding: 6px 10px;
            font-size: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            background-color: #ffffff;
            outline: none;
        }

        /* Go Button */
        #goFilter {
            padding: 7px 16px;
            font-size: 13px;
            font-weight: 600;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #goFilter:active {
            background-color: #1e40af;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="username">Welcome {{ session('user_name') }}</div>
        <a href="/logout">Logout</a>
    </div>

    <h1>Report Page</h1>
    <div class="header-section">
        <a href="/home">← Back</a>

    </div>

    <div class="filter-section">

        <!-- Date Filters -->
        <div class="filter-group">
            <label for="minDate">From</label>
            <input type="date" id="minDate">
        </div>

        <div class="filter-group">
            <label for="maxDate">To</label>
            <input type="date" id="maxDate">
        </div>

        <!-- Purchase Select -->
        <div class="filter-group">
            <label for="item_name">Select Purchase</label>
            <select name="item_name" id="item_name" required>
                <option value="">-- Select Purchase --</option>
                @forelse($purchases as $purchase)
                <option value="{{ $purchase->item->item_name }}">
                    {{ $purchase->item->item_name }}
                </option>
                @empty
                <option disabled>No item available</option>
                @endforelse
            </select>
        </div>

        <!-- Category Select -->
        <div class="filter-group">
            <label for="name">Select Category</label>
            <select id="name" name="c_name" required>
                <option value="">-- Select Category --</option>
                @forelse($categories as $cat)
                <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                @empty
                <option disabled>No categories available</option>
                @endforelse
            </select>
        </div>

        <!-- Go Button -->
        <div class="filter-group">
            <label>&nbsp;</label>
            <button type="button" id="goFilter">Go</button>
        </div>

    </div>



    <table id="reportTable">
        <thead>
            <tr>
                <th>S.No</th>
                <th>sale date</th>
                <th>Item</th>
                <th>Category</th>
                <td>Bill NO</td>
                <th>Sold quantity</th>
                <th>bill price</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sale as $sa)
            <tr>
                <td></td>
                <td>{{ $sa->sale_date }}</td>
                <td>{{ $sa->purchase->item->item_name }}</td>
                <td>{{ $sa->purchase->item->category_name }}</td>
                <td>{{ $sa->bill_no }}</td>
                <td>{{ $sa->quantity }}</td>
                <td>{{ $sa->total_price}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;">No data found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="summary-section">
        <h3>Total Item Purchased: {{ $purchaseQty }}</h3>
        <h3>Total Item Sold: {{ $saleQty }}</h3>
        <h3>Total Stock Remaining: {{ $totalStock }}</h3>
    </div>


    <script>
        $(document).ready(function() {

            // Initialize DataTable
            let table = $('#reportTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthMenu: [5, 10, 25],
                pageLength: 5,
                columnDefs: [{
                    targets: 0, // S.No column index
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                }]
            });

            // Format date to YYYY-MM-DD
            function formatDateLocal(date) {
                let y = date.getFullYear();
                let m = String(date.getMonth() + 1).padStart(2, '0');
                let d = String(date.getDate()).padStart(2, '0');
                return `${y}-${m}-${d}`;
            }

            // Custom filter
            $.fn.dataTable.ext.search.push(function(settings, data) {

                // Filter values
                let min = $('#minDate').val();
                let max = $('#maxDate').val();
                let itemFilter = $('#item_name').val(); // Selected item name
                let categoryFilter = $('#name').val(); // Selected category

                let saleDate = data[1]; // Sale Date column
                let itemName = data[2]; // Item column
                let category = data[3]; // Category column

                // Date filter
                let dateCheck = true;
                if (min && saleDate < min) dateCheck = false;
                if (max && saleDate > max) dateCheck = false;

                // Item filter
                let itemCheck = true;
                if (itemFilter && itemFilter !== "") {
                    itemCheck = itemName === itemFilter;
                }

                // Category filter
                let categoryCheck = true;
                if (categoryFilter && categoryFilter !== "") {
                    categoryCheck = category === categoryFilter;
                }

                // Row passes only if all checks pass
                return dateCheck && itemCheck && categoryCheck;
            });

            // Set default dates (current month)
            let today = new Date();
            let firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            $('#minDate').val(formatDateLocal(firstDayOfMonth));
            $('#maxDate').val(formatDateLocal(today));

            // Initial draw
            table.draw();

            // Apply filters when GO button is clicked
            $('#goFilter').on('click', function() {
                table.draw();
            });

        });
    </script>


</body>

</html>