<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .upload-form {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin:10px;
            max-width: 400px;
            padding:10px;
        }
        .upload-form h2 {
            margin-bottom: 20px;
            color: #4caf50;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        .form-group input[type="text"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group input[type="file"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group input[type="file"]:focus {
            border-color: #4caf50;
            outline: none;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        *{
            outline:none;
        }
    </style>
</head>
<body>
     <i style="color:#4caf50;font-size:0.8rem" class="note"><?php echo $_SESSION['notice']; ?></i>
    <div class="upload-form">
        <h2>Upload Image</h2>
       
        <form enctype="multipart/form-data" method="post" action="upload_process.php">
            <div class="form-group">
                <label for="title">Image Title</label>
                <input type="text" id="title" name="title" placeholder="Enter image title" required>
            </div>
            <div class="form-group">
                <label for="image">Select Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="submit-btn">Upload</button>
        </form>
    </div>
</body>
</html>
