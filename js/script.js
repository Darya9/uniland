$(document).ready(function(){
	var video_back = $('.video_back').text();
	if (video_back) {
		$('.land').tubular({videoId: video_back, width: '100%'}) ////C2y2MoJN1Yc ///ab0TSkLe-E0
	}

	$('.main_form button').click(function(event){
		event.preventDefault();
		var this_form = $(this).closest('form');
		$('.main_form .alert-msg').hide();
		$error = 1;
		console.log('rrr');

		$('.main_form .required').each(function( index, el ) {
			if ($(el).val()=="") {
				$error = 0;
				var this_alert = '.alert-'+$(el).attr('name');
				$(this_alert).fadeIn('fast');
			}
		})
		if ($error) {
			if ($('input').is('.email')) {
				if ($('.email').val()!="") {
						console.log('rrr3');
					if (!ValidMail($('.email').val())) {
						$error = 0;
						$('.error-email').fadeIn('fast');
					}
				}	
			}
			if ($('input').is('.phone')) {
				if ($('.phone').val()!="") {
						console.log('rrr4');
					if (!ValidPhone($('.phone').val())) {
						$error = 0;
						$('.error-phone').fadeIn('fast');
					}
				}
			}
		}
		if ($error) {
		console.log('rrr2');
			$('.main_form .check_to_f').val('Y');
			$('.main_form .check_to_e').val('');

			jQuery.ajax({
	            url:     'ajaxForm.php?check_get=Y', //Адрес подгружаемой страницы
	            type:     "POST", //Тип запроса
	            dataType: "html", //Тип данных
	            data: jQuery(this_form).serialize(), 
	            success: function(data) { //Если все нормально
	            	//console.log('ok');
	            	//console.log(data);
					this_form.find('.success-msg').fadeIn('fast');
					if (data == '1') {
						//console.log('success');
	            		$('.main_form .input').val('');
	            		$('.main_form .success').fadeIn('fast');
	            		if ($("div").is(".file_to_download")) {
	            			window.open($('.file_to_download').text(), '_self');
	            		}
					} else {
						//console.log('success error');
	            		$('.main_form .error').fadeIn('fast');
					}


	        	},
		        error: function(data) { 
	            	//console.log('error');
	            	//console.log(data);
	            	$('.main_form .error').fadeIn('fast');
		        }
		    });

		}
	})


	function ValidMail(mail_str) {
	    var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
	    var myMail = mail_str;
	    var valid = re.test(myMail);
	    //if (valid) console.log( 'Адрес эл. почты введен правильно!');
	    //else console.log('Адрес электронной почты введен неправильно!');
	    return valid;
	}
	 
	function ValidPhone(phone_str) {
	    var re = /^[\d\(\)\ +-]{5,14}\d$/;
	    var myPhone = phone_str;
	    var valid = re.test(myPhone);
	    //if (valid) console.log('Номер телефона введен правильно!');
	    //else  console.log( 'Номер телефона введен неправильно!');
	    return valid;
	}  
})