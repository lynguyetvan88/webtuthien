$(document).ready(function() {
	$("#login-form").click(function() {
		
                var username = $("#username").val();
                var password = $("#password").val();
                
		var data_string = '&username=' + username +'&password=' + password ; 
		
		
        if(username == "") {
           $("#usernameError").slideDown('slow').delay(1000).slideUp('slow');
           $("#username").focus();
           return false;
        }
        if(password == "") {
           $("#passwordError").slideDown('slow').delay(1000).slideUp('slow');
           $("#password").focus();
           return false;
        }
        

        

	});

	function clear_form() {
        $("#name").val('');
		 $("#phone").val('');
        $("#email").val('');
        
        $("#subject").val('');
        $("#content").val('');
        $("#captcha").val('');
    }

    $("#load_captcha").click(function() {
        change_captcha();
    });

    function change_captcha() {
        document.getElementById('img_captcha').src="captcha.php?rnd=" + Math.random();
    }
});