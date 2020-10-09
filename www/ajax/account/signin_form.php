<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-7 col-xs-11 shadow-container">
            <div class="shadow-head">
                <a onClick="CloseShadow();" class="item-right pointer button small dark"><i class="fa fa-times"></i></a>
            </div>
            <form onsubmit="Login();" id="usersignin" class="form-signin" name="form1">
                <h2 class="form-signin-heading">Please sign in</h2>
                <input name="myusername" id="myusername" type="text" class="form-control add-marg" placeholder="Username" autofocus>
                <input name="mypassword" id="mypassword" type="password" class="form-control add-marg" placeholder="Password">
                <input type="submit" style="display: none;">
                <!-- The checkbox remember me is not implemented yet...
                <label class="checkbox">
                  <input type="checkbox" value="remember-me"> Remember me
                </label>
                -->
                <a onClick="Login();" class="button dark hollow add-marg">Sign in</a>
                <a onClick="LoadCreate();" class="button dark hollow add-marg">Create new account</a>

                <div id="message"></div>
            </form>
        </div>
    </div>
</div>