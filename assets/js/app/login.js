$(function(){
    var $username = $('#username');
    var $password = $('#password');
    var $signIn   = $('#signIn');
    var $notification = $('#notification');

    $signIn.on('click', function(){
        if (!$username.val() && !$password.val()) 
            $notification.addClass('error-text').html("Please provide username or password");
        else {

            $.ajax({
                url: "user/authenticate",
                type: "POST",
                dataType: "json",   
                data: {
                    "email": $username.val(),
                    "password": $password.val()
                },
                success: function(response) {
                    var jsonResponse = response;
    
                    $notification.removeClass('error-text, success-text');

                    if (jsonResponse.status === "error") {
                        $notification.removeClass('success-text').addClass('error-text').html(jsonResponse.message);
                    } else {
                        $notification.removeClass('error-text').addClass('success-text').html(jsonResponse.message);
                        setTimeout(function(){
                            window.location.href = "dashboard";
                        },1500);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    $password.on('keypress', function(e){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            $signIn.trigger('click');
        }
    });
});