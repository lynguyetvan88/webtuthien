$(document).ready(function() {
	$("#posting").click(function() {
		var dictrict_id = $("#dictrict_id").val();
                var category_id = $("#category_id").val();
                var parent_id = $("#parent_id").val();
                var title = $("#title").val();
		//var images = $("#images").val();
		var description = $("#description").val();
		
		var captcha = $("#captcha").val();
		var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
                var phone_regex = /^[0-9]+$/;
                var birth_regex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
		var data_string = 'dictrict_id=' + dictrict_id + '&category_id=' + category_id +'&parent_id=' + parent_id +'&title=' + title+ '&description=' + description +   '&captcha=' + captcha; 
		
		
                
     if(dictrict_id == "") {
               
           $("#dictrict_idError").slideDown('slow').delay(3000).slideUp('slow');
           $("#dictrict_id").focus();
           return false;
        }
        if(category_id == "") {
           $("#category_idError").slideDown('slow').delay(3000).slideUp('slow');
           $("#category_id").focus();
           return false;
        }
        if(parent_id == "") {
           $("#parent_idError").slideDown('slow').delay(3000).slideUp('slow');
           $("#parent_id").focus();
           return false;
        }
        if(title == "") {
           $("#titleError").slideDown('slow').delay(3000).slideUp('slow');
           $("#title").focus();
           return false;
        }
        
//        if(images == "") {
//               
//           $("#imagesError").slideDown('slow').delay(3000).slideUp('slow');
//           $("#images").focus();
//           return false;
//        }
        
        if(description == "") {
           $("#descriptionError").slideDown('slow').delay(3000).slideUp('slow');
           $("#description").focus();
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