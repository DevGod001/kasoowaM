
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Space with Twinkling Stars</title>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      overflow: hidden;
      background-color: black;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #earth {
      position: absolute;
      width: 200px;
      z-index: 1;
      animation: rotate 6s linear infinite;
    }

    @keyframes rotate {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

    .star {
      position: absolute;
      border-radius: 50%;
      background-color: white;
      opacity: 0;
      animation: twinkle 3s infinite alternate;
    }

    @keyframes twinkle {
      0% { opacity: 0.5; }
      100% { opacity: 1; }
    }
  </style>
</head>
<body>
  <img id="earth" src="https://test.kasoowa.com/banners/globe.png" alt="Earth">
  <script>
    // Create stars with random sizes, positions, and colors
    function createStars(number) {
      const starContainer = document.body;
      for (let i = 0; i < number; i++) {
        const star = document.createElement('div');
        star.classList.add('star');
        
        // Random size
        const size = Math.random() * 3 + 1;
        star.style.width = size + 'px';
        star.style.height = size + 'px';

        // Random position across the entire window
        const x = Math.random() * window.innerWidth;
        const y = Math.random() * window.innerHeight;
        star.style.left = x + 'px';
        star.style.top = y + 'px';

        // Random color for each star
        const color = `rgb(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255})`;
        star.style.backgroundColor = color;

        // Add twinkling effect, without random movement as the stars are already placed randomly
        star.style.animation = `twinkle ${Math.random() * 3 + 1}s infinite alternate`;

        starContainer.appendChild(star); 
      }
    }

    // Create 100 stars for the scene
    createStars(100);
    let address="<?php echo str_replace('.',",",$_GET['address']); ?>";
    let xhr=new XMLHttpRequest();
    xhr.open("GET","here.php?address=" + encodeURIComponent(address),true);
    xhr.onreadystatechange=function(){
    if(xhr.status==200 && xhr.readyState== 4){
        window.parent.postMessage(xhr.responseText);
    }
    }
    xhr.send();
  </script>
</body>
</html>