$(function(){
    var $firstName  = $('#first_name');
    var $lastName   =  $('#last_name');
    var $emailAddress = $('#email');
    var $password = $('#password');
    var $confirmPassword = $('#confirm_password');
    var baseURL = Utility.BaseUrl();

    $('#btn_save').on('click', function(){
        $.ajax({
            url: baseURL + "user/save",
            type: "POST",
            dataType: "json",
            data: {
                first_name: $firstName.val(),
                last_name: $lastName.val(),
                email: $emailAddress.val(),
                password: $password.val(),
                confirm_password: $confirmPassword.val()
            },
            success: function(response) {
                if (response.status === "error") {
                    toastr.error(response.message);
                } else {
                    toastr.success(response.message);
                    $.each($('input'), function(){
                        $(this).val('');
                    });
                }
            }, error: function(jqXHR, exception) {
                console.log(jqXHR);
            }
        });
    });
});