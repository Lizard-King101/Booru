<div id="navbar">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul id="nav-left">
                    <li class="nav-on-response"><a id="nav-toggle"><i class="fa fa-bars"></i></a></li>
                    <li><a href="index" id="logo">Search<span id="head-span"><span id="head-slider"></span>Booru</span></a></li>
                    <li class="nav-response"><a href="upload"><i class="fa fa-upload"></i></a></li>
                    <li id="search-item" class="nav-response">
                    	<a>
							<form id="search-form" action="/search" method="post">
								<input id="search" name="tags" type="text" placeholder="search" value="<?php if(isset($_SESSION['back_tags'])){echo $_SESSION['back_tags'];}?>">
							</form>
                    	</a>
                    </li>
                </ul>
                <ul id="nav-right">
                    <?php if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1){?>
                    <li class="nav-response"><a href="admin">Admin Panel</a></li>
                    <?php } ?>
                    <li class="nav-response"><a href="account">Account</a></li>
                    <li class="nav-response"><a href="settings">Settings</a></li>
                    <?php if(isset($_SESSION['username'])){ ?>
                    <li><a href="login/logout">Sign Out</a></li>
                    <?php }else{?>
                    <li><a onClick="SignIn();" class="pointer">Sign In</a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>