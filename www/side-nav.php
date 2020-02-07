<ul class="side-nav">
    <?php if(isset($_SESSION['username'])){?>
    <li><a href="account"><i class="fa fa-user"></i> My Account</a></li>
    <?php } ?>
    <li><a href="search"><i class="fa fa-search"></i> Search</a></li>
    <li><a href="upload"><i class="fa fa-upload"></i> Upload</a></li>
    <li><a href="settings"><i class="fa fa-cogs"></i> Settings</a></li>
    <hr class="min">
    <?php if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 'true'){?>
    <li><a href="admin"><i class="fa fa-gavel"></i> Admin Panel</a></li>
    <?php } ?>
</ul>