<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title> Home | HungryClicks </title>
    <link rel="stylesheet" type = "text/css" href ="css/index.css">
  </head>
  <body>
    <nav class="navbar">
      <img src="images/logo.webp" class="logo" width="200px">
      <a class="navbar-brand" href="index.php">HungryClicks</a>
      <ul class="navbar-nav">
        <li><a href="index.php">Home</a></li>
      </ul>
    </nav>

    <div class="slideshow-container">
      <div class="mySlides fade">
        <img src="images/slide1.jpg">
      </div>
      <div class="mySlides fade">
        <img src="images/slide2.jpg">
      </div>
      <div class="mySlides fade">
        <img src="images/slide3.webp">
      </div>
    </div>
    <div class="box">
      <div class="tagline">
        <h1 class="text-4xl">Good Food is Good Mood</h1>
        <p class="text-lg mt-4">Satisfy your cravings with our delicious dishes</p>
      </div>
      <div class="orderblock">
        <h2>Feeling Hungry?</h2><br>
        <center><a class="btn btn-success btn-lg" href="customerlogin.php" role="button" > Order Now </a></center>
      </div>
    </div>
    <script>
      var slideIndex = 0;
      showSlides();
      function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].style.display = "block";
        setTimeout(showSlides, 3000); // Change image every 3 seconds
      }
    </script>
  </body>
</html>