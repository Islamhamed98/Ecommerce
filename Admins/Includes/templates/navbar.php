<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo language('HOME_ADMIN')?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="#"><?php echo language('Categories')?></a></li>
        <li><a href="members.php?do=Manage&userid=<?php echo $_SESSION['ID']?>"><?php echo language('friends')?></a></li>
        <li><a href="#"><?php echo language('items')?></a></li>
        <li><a href="#"><?php echo language('stat')?></a></li>
     </ul>
    
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><?php echo language('Connect') ;?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">Edit Profile</a></li>
            <li><a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">Security</a></li>
            <li><a href="logout.php">Log Out</a></li>

          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>