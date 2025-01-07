<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #f4f7fc;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #2C3E50;
            width: 250px;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
            font-size: 24px;
            margin-bottom: 40px;
        }

        .sidebar a {
            color: #bdc3c7;
            text-decoration: none;
            font-size: 18px;
            margin-bottom: 15px;
            padding: 10px 20px;
            display: block;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background-color: #34495E;
            color: #fff;
        }

        .sidebar a.active {
            background-color: #1ABC9C;
            color: white;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar h3 {
            font-size: 22px;
            font-weight: 600;
            color: #34495E;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
        }

        .navbar .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Cards Styling */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card h3 {
            font-size: 20px;
            color: #34495E;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 18px;
            font-weight: bold;
            color: #1ABC9C;
        }

        /* Mobile Responsiveness */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .navbar {
                padding: 15px;
            }

            .navbar h3 {
                font-size: 20px;
            }
        }

        @media screen and (max-width: 576px) {
            .sidebar {
                position: absolute;
                left: -250px;
                transition: left 0.3s ease-in-out;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .navbar h3 {
                font-size: 18px;
            }

            /* Responsive Cards */
            .cards {
                grid-template-columns: 1fr;
            }
        }

        /* Sidebar toggle button for mobile */
        .toggle-btn {
            background-color: #1ABC9C;
            color: #fff;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
            display: none;
        }

        @media screen and (max-width: 576px) {
            .toggle-btn {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1000;
            }

            .sidebar.show {
                left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="#dashboard" class="active">Dashboard</a>
        <a href="#products">Products</a>
        <a href="#orders">Orders</a>
        <a href="#users">Users</a>
        <a href="#settings">Settings</a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- Navbar -->
        <div class="navbar">
            <h3>Welcome, Admin</h3>
            <div class="user-info">
                <img src="https://via.placeholder.com/40" alt="Admin">
                <span>Admin</span>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="cards">
            <div class="card">
                <h3>Total Sales</h3>
                <p>$12,500</p>
            </div>

            <div class="card">
                <h3>Total Orders</h3>
                <p>350</p>
            </div>

            <div class="card">
                <h3>New Users</h3>
                <p>150</p>
            </div>

            <div class="card">
                <h3>Products</h3>
                <p>1200</p>
            </div>
        </div>
    </div>

    <!-- Toggle Button for Mobile -->
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>

    <script>
        // Sidebar toggle functionality for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
    </script>

</body>
</html>
