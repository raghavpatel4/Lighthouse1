<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php#about">About</a></li>
      <?php if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] > '0') {?>
      	<li><a href="messaging.php">Your Profile</a></li>
      <?php } else {?>
      	<li><a href="index.php#login">Login</a></li>
      <?php }?>
      <li><a href="index.php#the-team">The Team</a></li>
      <li><a href="index.php#contact">Contact</a></li>
    </ul>
</div>
