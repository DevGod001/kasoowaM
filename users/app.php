<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4caf50">
    <title>Shop Food Worldwide</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }

        header {
            background-color: #4caf50;
            color: white;
            padding: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 1.2rem;
        }

        .container {
            padding: 20px;
        }

        .download-button {
            display:flex;
            align-items:center;
            justify-content:center;
            
            background: linear-gradient(to right, #4caf50, #8bc34a);
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 15px 3px;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .download-button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }
        @keyframes bounce {
            0% {
                transform: translateY(0); /* Start at the ground */
            }
            20% {
                transform: translateY(-7px); /* First big bounce */
            }
            40% {
                transform: translateY(0); /* Back to ground */
            }
            50% {
                transform: translateY(-5px); /* Smaller bounce */
            }
            70% {
                transform: translateY(0); /* Back to ground */
            }
            75% {
                transform: translateY(-2px); /* Smallest bounce */
            }
            90% {
                transform: translateY(0); /* Back to ground */
            }
            100% {
                transform: translateY(0); /* Pause at rest before repeating */
            }
        }
        .download-button .material-icons{
            color:gold;
            animation:bounce 1.5s infinite;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .feature-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        .feature-card h3 {
            color: #4caf50;
        }

        footer {
            display:none;
            margin-top: 20px;
            background: #333;
            color: white;
            padding: 10px;
            font-size: 0.9rem;
        }

        footer a {
            color: #4caf50;
            text-decoration: none; 
        }
    </style>
</head>
<body>
    <header>
        <h1>Enjoy Real Time updates on orders</h1>
    </header>
    <div class="container">
        <p>Download our app to shop globally, track orders, and access exclusive deals.</p>
        <a download href="kasoowa.apk" class="download-button"><i class="material-icons">android</i>Download the App</a>
        <div class="features">
            <div class="feature-card">
                <h3>Personalized Recommendations</h3>
                <p>Discover foods you’ll love with AI-powered suggestions tailored to your taste and preferences.</p>
            </div>
            <div class="feature-card">
                <h3>Real-Time Order Tracking</h3>
                <p>Stay updated with real-time notifications and live tracking for all your orders.</p>
            </div>
            <div class="feature-card">
                <h3>Exclusive App Discounts</h3>
                <p>Save more with app-only offers, flash sales, and personalized discount codes.</p>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Global Food Store. All rights reserved. | <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>
