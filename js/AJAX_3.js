$(document).ready(function() {
	$("#SendMail").click(function() {
           
		var full_name = $("#full_name").val();
                var address = $("#address").val();
                var title = $("#title").val();
                var content = $("#content").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		var captcha = $("#captcha").val();
		var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
                var phone_regex = /^[0-9]+$/;
                var birth_regex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
		var data_string = 'full_name=' + full_name + '&address=' + address +'&title=' + title +'&content=' + content +'&email=' + email + '&phone=' + phone +   '&captcha=' + captcha; 
		
       
       if(full_name == "") {
           $("#full_nameError").slideDown('slow').delay(3000).slideUp('slow');
           $("#full_name").focus();
           return false;
        }
         if(!email_regex.test(email) || email == "") {
           $("#emailError").slideDown('slow').delay(3000).slideUp('slow');
           $("#email").focus()
           return false;
        }
         if(!phone_regex.test(phone)|| phone == "") {
           $("#phoneError").slideDown('slow').delay(3000).slideUp('slow');
           $("#phone").focus();
           return false;
        }
        if(address == "") {
           $("#addressError").slideDown('slow').delay(3000).slideUp('slow');
           $("#address").focus();
           return false;
        }
        
        if(content == "") {
           $("#contentError").slideDown('slow').delay(3000).slideUp('slow');
           $("#content").focus();
           return false;
        }
       
       

        

       
       if(captcha == "") {
           $("#captchaError").slideDown('slow').delay(3000).slideUp('slow');
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