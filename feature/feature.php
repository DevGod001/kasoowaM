<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            overflow-x: hidden;
        }
        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1em 0;
            position: relative;
        }
        .nav-menu {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #333;
            color: white;
            transition: left 0.3s ease;
            padding-top: 20px;
            z-index: 1000;
        }
        .nav-menu a {
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            display: block;
        }
        .nav-menu a:hover {
            background-color: #575757;
        }
        .toggle-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .trending-section {
            margin: 20px auto;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        .trending-container {
            display: flex;
            overflow-x: auto;
            padding: 10px 0;
            gap: 20px;
        }
        .product {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            min-width: 150px;
        }
        .trending-product {
            min-width: 112.5px;
        }
        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product h3 {
            color: #4CAF50;
            font-size: 1.2em;
        }
        .price {
            font-weight: bold;
            color: #4CAF50;
        }
        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .cart-popup {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            border-top: 1px solid #ddd;
            padding: 15px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            text-align: center;
        }
        .cart-popup h2 {
            margin: 0;
            color: #4CAF50;
        }
        .cart-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0;
        }
        .cart-controls button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            margin: 0 10px;
        }
        #total-price {
            font-size: 1.5em;
            color: #333;
        }
    </style>
</head>
<body>

<header>
    <button class="toggle-button" onclick="toggleMenu()">☰ Menu</button>
    <h1 id="header-text"></h1>
</header>

<nav class="nav-menu" id="nav-menu">
    <a href="#">Home</a>
    <a href="#">Products</a>
    <a href="#">About Us</a>
    <a href="#">Contact</a>
    <a href="#">Cart</a>
</nav>

<div class="trending-section">
    <h2>Trending Products</h2>
    <div class="trending-container">
        <div class="product trending-product">
            <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Fresh Mangoes">
            <h3>Fresh Mangoes</h3>
            <p class="price">$3.99 / lb</p>
            <button class="add-to-cart" onclick="addToCart('Fresh Mangoes', 3.99)">Add to Cart</button>
        </div>
        <div class="product trending-product">
            <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Strawberries">
            <h3>Strawberries</h3>
            <p class="price">$4.49 / lb</p>
            <button class="add-to-cart" onclick="addToCart('Strawberries', 4.49)">Add to Cart</button>
        </div>
        <div class="product trending-product">
            <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Blueberries">
            <h3>Blueberries</h3>
            <p class="price">$5.99 / lb</p>
            <button class="add-to-cart" onclick="addToCart('Blueberries', 5.99)">Add to Cart</button>
        </div>
        <div class="product trending-product">
            <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Pineapples">
            <h3>Pineapples</h3>
            <p class="price">$3.49 / lb</p>
            <button class="add-to-cart" onclick="addToCart('Pineapples', 3.49)">Add to Cart</button>
        </div>
    </div>
</div>

<div class="container">
    <div class="product">
        <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Fresh Apples">
        <h3>Fresh Apples</h3>
        <p class="price">$2.99 / lb</p>
        <button class="add-to-cart" onclick="addToCart('Fresh Apples', 2.99)">Add to Cart</button>
    </div>
    <div class="product">
        <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Bananas">
        <h3>Bananas</h3>
        <p class="price">$1.29 / lb</p>
        <button class="add-to-cart" onclick="addToCart('Bananas', 1.29)">Add to Cart</button>
    </div>
    <div class="product">
        <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Organic Carrots">
        <h3>Organic Carrots</h3>
        <p class="price">$1.49 / lb</p>
        <button class="add-to-cart" onclick="addToCart('Organic Carrots', 1.49)">Add to Cart</button>
    </div>
    <div class="product">
        <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Tomatoes">
        <h3>Tomatoes</h3>
        <p class="price">$3.49 / lb</p>
        <button class="add-to-cart" onclick="addToCart('Tomatoes', 3.49)">Add to Cart</button>
    </div>
    <div class="product">
        <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Broccoli">
        <h3>Broccoli</h3>
        <p class="price">$2.99 / lb</p>
        <button class="add-to-cart" onclick="addToCart('Broccoli', 2.99)">Add to Cart</button>
    </div>
    <div class="product">
        <img src="https://kasoowa.nairagigs.org.ng/assets/pepper.jpg" alt="Lettuce">
        <h3>Lettuce</h3>
        <p class="price">$1.99 / lb</p>
        <button class="add-to-cart" onclick="addToCart('Lettuce', 1.99)">Add to Cart</button>
    </div>
</div>

<div class="cart-popup" id="cart-popup">
    <h2>Your Cart</h2>
    <div class="cart-controls">
        <button onclick="adjustQuantity(-1)">-</button>
        <span id="total-price">Total: $0.00</span>
        <button onclick="adjustQuantity(1)">+</button>
    </div>
    <ul id="cart-items"></ul>
</div>

<script>
    const headerText = "Welcome to Our Grocery Store";
    const headerElement = document.getElementById("header-text");
    let index = 0;

    function typeLetter() {
        if (index < headerText.length) {
            headerElement.textContent += headerText.charAt(index);
            index++;
            setTimeout(typeLetter, 100);
        }
    }

    let cart = [];
    let total = 0;

    function addToCart(name, price) {
        cart.push({ name, price });
        total += price;
        updateCart();
    }

    function updateCart() {
        const cartItems = document.getElementById("cart-items");
        const totalPrice = document.getElementById("total-price");
        const cartPopup = document.getElementById("cart-popup");

        cartItems.innerHTML = ''; // Clear previous items
        cart.forEach(item => {
            const listItem = document.createElement("li");
            listItem.textContent = ${item.name} - $${item.price.toFixed(2)};
            cartItems.appendChild(listItem);
        });

        totalPrice.textContent = Total: $${total.toFixed(2)};
        cartPopup.style.display = 'block'; // Show the cart popup
    }

    function adjustQuantity(direction) {
        // Logic to adjust total based on quantity changes can be added here
        // This is a placeholder for future functionality
    }

    function toggleMenu() {
        const navMenu = document.getElementById("nav-menu");
        navMenu.style.left = navMenu.style.left === "0px" ? "-250px" : "0px"; // Slide in/out from the left
    }

    window.onload = typeLetter;
</script>

</body>
</html>