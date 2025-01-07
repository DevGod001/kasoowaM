<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4caf50;
            color: white;
            padding: 15px 20px;
            text-align: center;
            border-radius: 0px 0px 10px 10px;
        }
        header nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .search-filter {
            display: flex;
            justify-content: center;
            padding: 15px;
            gap: 10px;
            max-width: 800px; /* Set a maximum width */
            margin: 0 auto; /* Center the search filter */
        }
        .search-filter input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            flex: 1; /* Allow the input to grow */
            min-width: 200px; /* Minimum width for better appearance */
        }
        .filter {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
        }
        main {
            padding: 20px;
            flex: 1 0 auto;
        }
        .product-card {
            max-width: 300px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .product-card img {
            width: 100%;
            height: auto;
        }
        .product-card h2 {
            font-size: 1.5em;
            color: #2e7d32;
        }
        .product-card p {
            color: #666;
            margin: 10px 0;
        }
        .product-card .price {
            font-size: 1.2em;
            color: #388e3c;
        }
        .product-card button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        footer {
            background-color: #4caf50;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <h1>Welcome to Our E-Commerce Store</h1>
        <nav>
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="#">About Us</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <!-- Search and Filter Section -->
    <div class="search-filter">
        <input type="text" placeholder="Search for products..." aria-label="Search">
        <select class="filter" aria-label="Filter by category">
            <option value="">All Categories</option>
            <option value="electronics">Electronics</option>
            <option value="clothing">Clothing</option>
            <option value="home">Home Goods</option>
        </select>
        <button style="padding: 10px; background-color: #4caf50; color: white; border: none; border-radius: 5px;">
            Search
        </button>
    </div>

    <!-- Main Content -->
    <main>
        <section style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
            <!-- Product Card 1 -->
            <div class="product-card">
                <img src="pepper.jpg" alt="Product Image">
                <div style="padding: 15px;">
                    <h2>Product Title 1</h2>
                    <p>A brief description of the product highlighting its key features.</p>
                    <p class="price">$29.99</p>
                    <button>Add to Cart</button>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="product-card">
                <img src="pepper.jpg" alt="Product Image">
                <div style="padding: 15px;">
                    <h2>Product Title 2</h2>
                    <p>A brief description of the product highlighting its key features.</p>
                    <p class="price">$39.99</p>
                    <button>Add to Cart</button>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="product-card">
                <img src="pepper.jpg" alt="Product Image">
                <div style="padding: 15px;">
                    <h2>Product Title 3</h2>
                    <p>A brief description of the product highlighting its key features.</p>
                    <p class="price">$49.99</p>
                    <button>Add to Cart</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 E-Commerce Store. All rights reserved.</p>
    </footer>

</body>
</html>
