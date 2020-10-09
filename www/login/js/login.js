function Login(){
        
    console.log('Submit Clicked');

    var formData = { };
    var data = $("#usersignin").serializeArray();
    data.forEach((input) => {
      formData[input.name] = input.value;
    });

    var username = $("#myusername").val();
    var password = $("#mypassword").val();
    console.log(formData);

    if ((username === "") || (password === "")) {
        $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username and a password</div>");
    } else {
        $("#message").html("<p class='text-center loader'><img class='loading' src='login/images/ajax-loading.gif'></p>");
        $.ajax({
            url: "login/checklogin",
            type: "POST",
            data: formData,
            dataType: 'JSON',
            success: function (html) {
                console.log(html.response + ' ' + html.username);
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
            }
        });
    }
    return false;
}