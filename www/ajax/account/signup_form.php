<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-11 shadow-container">
            <div class="shadow-head">
                <a onClick="CloseShadow();" class="item-right pointer button small dark"><i class="fa fa-times"></i></a>
            </div>
            <form onsubmit="SignUp();" class="form-signup" id="usersignup" name="usersignup">
                <h2 class="form-signup-heading">Register</h2>
                <input name="newuser" id="newuser" type="text" class="form-control add-marg" placeholder="Username" autofocus>
                <input name="email" id="email" type="text" class="form-control add-marg" placeholder="Email">
                <input name="password1" id="password1" type="password" class="form-control add-marg" placeholder="Password">
                <input name="password2" id="password2" type="password" class="form-control add-marg" placeholder="Repeat Password">
                <input type="submit" style="display: none;">
                <a onClick="SignUp();" class="button dark hollow add-marg">Sign up</a>

                <div id="message"></div>
            </form>
            <!-- <script>
                $( "#usersignup" ).validate({
                  rules: {
                    email: {
                        email: true,
                        required: true
                    },
                    password1: {
                      required: true,
                      minlength: 4
                    },
                    password2: {
                      equalTo: "#password1"
                    }
                  }
                });
            </script> -->
        </div>
    </div>
</div>