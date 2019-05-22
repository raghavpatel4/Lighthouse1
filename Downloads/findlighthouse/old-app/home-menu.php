<div id="navbar" class="navbar-collapse collapse menuBar">
    <ul class="nav navbar-nav">
      <li><a href="#" class="home-page">Home</a></li>
      <li><a href="#" class="about">About</a></li>
      <?php if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] > '0') {?>
      	<li><a href="messaging.php">Your Profile</a></li>
      <?php } else {?>
      	<li><a href="#" class="login">Login</a></li>
      <?php }?>
      <li><a href="#" class="the-team">The Team</a></li>
      <li><a href="#" class="contact">Contact</a></li>
    </ul>
</div>
