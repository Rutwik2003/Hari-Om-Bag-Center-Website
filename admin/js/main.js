$(document).ready(function(){

    $(".register-btn").on("click", function(){

        $.ajax({
            url : 'classes/Credentials.php', // Updated path
            method : "POST",
            data : $("#admin-register-form").serialize(),
            success : function(response){
                console.log(response);
                var resp = $.parseJSON(response);
                if (resp.status == 202) {
                    $("#admin-register-form").trigger("reset");
                    $(".message").html('<span class="text-success">'+resp.message+'</span>');
                }else if(resp.status == 303){
                    $(".message").html('<span class="text-danger">'+resp.message+'</span>');
                }
            }
        });

    });

    $(".login-btn").on("click", function(){

        $.ajax({
            url : './classes/Credentials.php', // Updated path
            method : "POST",
            data : $("#admin-login-form").serialize(),
            success : function(response){
                console.log(response);
                var resp = $.parseJSON(response);
                if (resp.status == 202) {
                    $("#admin-register-form").trigger("reset");
                    console.log(window.location);
                    window.location.href = "./index.php";

                }else if(resp.status == 303){
                    $(".message").html('<span class="text-danger">'+resp.message+'</span>');
                }
            }
        });

    });

});
