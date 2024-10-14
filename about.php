<?php 
$page = 'about';
$title = "Sam Wiggins | About";
?><!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'views/head.php'; ?>
</head>
<body>
  <?php include 'views/nav.php'; ?>
  <?php include 'views/hero.php'; ?>
  
  <div class="container">
    <main id="about">
      <h1>About Me</h1>
      <p>Full stack developer with experience creating custom e-commerce, digital content subscriber, CMS and CRM using Laravel, PHP, MySQL, HTML and CSS.</p>
    </main>

    <div class="to-top">
      <a href="#">
        <i class="up-arrow"></i> 
        <p>Back to Top</p>
      </a>
    </div>
  </div>
  <footer class="main-footer">
    <p>Sam Wiggins 2024</p>
  </footer>

  <script src="js/app.js"></script>
</body>
</html>