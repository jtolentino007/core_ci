$(function(){
    var baseURL = Utility.BaseUrl();

    $.ajax({
        url: baseURL + "user/current",
        type: "GET",
        dataType: "json",
        success: function(user){
            $('#email').val(user.email);
            $('#first_name').val(user.first_name);
            $('#last_name').val(user.last_name);
        }, error: function(error) {
            console.log(error)
        }
    })
});