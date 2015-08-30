/*
 * @author Ryan Sutana
 * @description Pass all datas requested through wp-ajax
 * since v 1.0
 */

jQuery(document).ready(function($) {
	
	$("form#rs_contact, #rs_contact_widget").submit(function(){
		var submit = $("#rs_contact_wrapper #submit"),
			preloader = $("#rs_contact_wrapper #preloader"),
			message	= $("#rs_contact_wrapper #message"),
			contents = {
				action: 'theme_contact',
				nonce: 	this.rs_contact_nonce.value,
				name:	this.name.value,
				email:	this.email.value,
				message:this.message.value
			};
		
		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');
		
		// Display our pre-loading
		preloader.css({'visibility':'visible'});
		
		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');
			
			preloader.css({'visibility':'hidden'});
			
			// display return data
			message.html( data );
		});
		
		return false;
	});
	
	// for user registration form
	$("form#rs_user_registration").submit(function(){
		var submit = $("div#rs_user_registration_wrapper #submit"),
			preloader = $("div#rs_user_registration_wrapper #preloader"),
			message	= $("div#rs_user_registration_wrapper #message"),
			contents = {
				action: 	'user_registration',
				nonce: 		this.rs_user_registration_nonce.value,
				last_name:	this.last_name.value,
				first_name:	this.first_name.value,
				email:		this.email.value,
				username:	this.username.value,
				pwd1:		this.pwd1.value,
				pwd2:		this.pwd2.value
			};
		
		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');
		
		// Display our pre-loading
		preloader.css({'visibility':'visible'});
		
		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');
			
			// hide pre-loader
			preloader.css({'visibility':'hidden'});
			
			// check response data
			if( 1 == data ) {
				// redirect to home page
				window.location = theme_ajax.site_url;
			} else {
				// display return data
				message.html( data );
			}
		});
		
		return false;
	});
	
	// for user login form
	$("form#rs_user_login").submit(function(){
		var submit = $("div#rs_user_login_wrapper #submit"),
			preloader = $("div#rs_user_login_wrapper #preloader"),
			message	= $("div#rs_user_login_wrapper #message"),
			contents = {
				action: 	'user_login',
				nonce: 		this.rs_user_login_nonce.value,
				user_login:	this.log.value,
				user_pass:	this.pwd.value
			};
		
		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');
		
		// Display our pre-loading
		preloader.css({'visibility':'visible'});
		
		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');
			
			// hide pre-loader
			preloader.css({'visibility':'hidden'});
			
			// check response data
			if( 1 == data ) {
				// redirect to home page
				window.location = theme_ajax.site_url;
			} else {
				// display return data
				message.html( data );
			}
		});
		
		return false;
	});
	
	
	$("#bpprofbpg_change").on('click', '#bppg-del-image', function() {
		var $this = $(this);
		var noce = '';

		$.post( ajaxurl,{
			action:'bppg_delete_bg',
			cookie:encodeURIComponent(document.cookie),
			_wpnonce:$($this.parents('form').get(0)).find('#_wpnonce').val()
		},
		
		function(response){
			//remove the current image
			$("div#message").remove();
			$this.parent().before($("<div id='message' class='update'>"+response+"</div>"));
			$this.prev('current-bg').fadeOut(100);//hide current image
			$this.parent().remove();//remove from dom the delete link
			//give feedback
			//remove the body class
			$('body').removeClass('is-user-profile');
		}


		);
		return false;
	});
	
});