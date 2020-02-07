function Login(){
        
    console.log('Submit Clicked');

    var username = $("#myusername").val(), password = $("#mypassword").val();

    if ((username === "") || (password === "")) {
        $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username and a password</div>");
    } else {
        $.ajax({
            type: "POST",
            url: "login/checklogin.php",
            data: "myusername=" + username + "&mypassword=" + password,
            dataType: 'JSON',
            success: function (html) {
                //console.log(html.response + ' ' + html.username);
                if (html.response === 'true') {
                    //location.assign("../index.php");
                   location.reload();
                    return html.username;
                } else {
                    $("#message").html(html.response);
                }
            },
            error: function (textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
            },
            beforeSend: function () {
                $("#message").html("<p class='text-center loader'><img class='loading' src='login/images/ajax-loading.gif'></p>");
            }
        });
    }
    return false;
}