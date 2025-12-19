<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        /* pop up */
        .success-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ffffffff;
            /* blue */
            color: #00ff2aff;
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.4s ease;
            z-index: 9999;
        }

        .success-toast.show {
            opacity: 1;
            transform: translateY(0);
        }

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

        /* Table Container */
        #categoriesTable_wrapper {
            max-width: 1200px;
            margin: 20px auto;
            background: #ffffff;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }

        /* Table */
        #categoriesTable {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        #categoriesTable thead th {
            background-color: #1f2937;
            color: #ffffff;
            font-weight: 600;
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        #categoriesTable tbody td {
            padding: 10px 12px;
            color: #111827;
            border-bottom: 1px solid #e5e7eb;
        }

        #categoriesTable tbody tr:hover {
            background-color: #f3f4f6;
        }

        /* Action buttons */
        .action-buttons a {
            width: 28px;
            height: 28px;
            font-size: 14px;
            text-align: center;
            line-height: 28px;
            border-radius: 4px;
            transition: none;
        }

        .action-buttons a.edit {
            background-color: #2563eb;
            color: #fff;
        }

        .action-buttons a.delete {
            background-color: #dc2626;
            color: #fff;
        }

        .action-buttons a.view {
            background-color: #10b981;
            color: #fff;
        }

        /* Pagination */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 4px 10px;
            margin: 0 2px;
            font-size: 13px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
            background-color: #f9fafb;
            color: #111827 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #2563eb !important;
            color: #ffffff !important;
            border: none;
        }

        /* Search input */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 5px 8px;
            font-size: 13px;
        }

        /* Length dropdown */
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 4px 6px;
            font-size: 13px;
        }

        .action-buttons svg {
            width: 18px;
            height: 18px;
        }

        .empty-message {
            text-align: center;
            color: #007bff;
            font-weight: 600;
        }

        .error-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc2626;
            /* red */
            color: #fff;
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.4s ease;
            z-index: 9999;
        }

        .error-toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="username">Welcome {{ session('user_name') }}</div>
        <a href="/logout">Logout</a>
    </div>

    <div class="container">
        <h1>Categories</h1>
        <div class="header-section">
            <a href="/home">← Back</a>
            <a href="/add_category">+ ADD NEW CATEGORY</a>
        </div>


        @if(session('success'))
        <div class="success-toast" id="successToast">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('successToast').classList.add('show');
            }, 100);

            setTimeout(() => {
                document.getElementById('successToast').classList.remove('show');
            }, 4000);
        </script>
        @endif

        @if(session('error'))
        <div class="error-toast" id="errorToast">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('errorToast').classList.add('show');
            }, 100);

            setTimeout(() => {
                document.getElementById('errorToast').classList.remove('show');
            }, 4000);
        </script>
        @endif


        <table id="categoriesTable">
            <thead>
                <tr>
                    <td>S.No</td>
                    <td>Category Name</td>
                    <td>Category Description</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td></td>
                    <td>{{ $cat->category_name }}</td>
                    <td>{{ $cat->category_description }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ url('/category/edit/' . $cat->category_id) }}?edit=1" class="edit"
                                title="Edit">✏️</a>
                            <a href="/category/delete/{{ $cat->category_id }}" class="delete"
                                onclick="return confirm('Are you sure you want to delete this category?')"
                                title="Delete">🗑️</a>
                            <a href="/category/edit/{{ $cat->category_id }}" class="view" title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty-message">No categories found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <script>
        $(document).ready(function() {
            $('#categoriesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                columnDefs: [{
                    targets: 0, // first column
                    orderable: false, // disable sorting on S.No
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // auto numbering
                    }
                }]
            });
        });
    </script>


</body>

</html>