$(document).ready(function() {
	$("#SendMail").click(function() {
		var full_name = $("#full_name").val();
                var username = $("#username").val();
                var password = $("#password").val();
                var re_password = $("#re_password").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		var birth = $("#birth").val();
		
		var captcha = $("#captcha").val();
		var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
                var phone_regex = /^[0-9]+$/;
                var birth_regex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
                 var user_regex = /^\S+$/;
                 var user1_regex = /^.{8,16}$/;
		var data_string = 'full_name=' + full_name + '&username=' + username +'&password=' + password +'&re_password=' + re_password +'&email=' + email + '&phone=' + phone + '&birth=' + birth +  '&captcha=' + captcha; 
		
		if(full_name == "") {
           $("#full_nameError").slideDown('slow').delay(1000).slideUp('slow');
           $("#full_name").focus();
           return false;
        }
        if(!user_regex.test(username) || !user1_regex.test(username) ||username == "") {
           $("#usernameError").slideDown('slow').delay(1000).slideUp('slow');
           $("#username").focus();
           return false;
        }
        if(password == "" ||!user1_regex.test(password)||!user_regex.test(password)) {
           $("#passwordError").slideDown('slow').delay(1000).slideUp('slow');
           $("#password").focus();
           return false;
        }
        if(re_password == "") {
           $("#re_passwordError").slideDown('slow').delay(1000).slideUp('slow');
           $("#re_password").focus();
           return false;
        }
        if(!phone_regex.test(phone)|| phone == "") {
           $("#phoneError").slideDown('slow').delay(1000).slideUp('slow');
           $("#phone").focus();
           return false;
        }
        if(!email_regex.test(email) || email == "") {
           $("#emailError").slideDown('slow').delay(1000).slideUp('slow');
           $("#email").focus()
           return false;
        }

        

        if(!birth_regex.test(birth) ||birth == "") {
           $("#birthError").slideDown('slow').delay(1000).slideUp('slow');
           $("#birth").focus();
           return false;
        }

        if(content == "") {
           $("#contentError").slideDown('slow').delay(1000).slideUp('slow');
           $("#content").focus()
           return false;
        }

        if(captcha == "") {
           $("#captchaError").slideDown('slow').delay(1000).slideUp('slow');
           $("#captcha").focus()
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