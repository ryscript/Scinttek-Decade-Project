<?php
/*
 * @author	Ryan Sutana
 * @desc	Process all datas coming from theme-ajax.js
 * since 	v 1.0
 */

add_action( 'wp_ajax_nopriv_theme_contact', 'theme_contact_callback' );
add_action( 'wp_ajax_theme_contact', 'theme_contact_callback' );
/*
 *	@desc	Process theme contact
 */
function theme_contact_callback() {
	global $wpdb, $data;
	
	$error = '';
	$success = '';
	$nonce = $_POST['nonce'];
 
    if ( ! wp_verify_nonce( $nonce, 'rs_contact_action' ) )
       die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = $_POST['message'];
	
	if( empty( $name ) ) {
		$error = 'Name field is required.';
	} else if( empty( $email ) ) {
		$error = 'Email field is required.';
	} else if( ! is_email( $email ) ) {
		$error = 'Invalid email address.';
	} else {
		$to = get_bloginfo('admin_email');
		$subject = get_bloginfo('name') . ' Contact';
		
		$message = '
			<html>
			<head>
			  <title>'. $subject .'</title>
			</head>
			<body>
				<p>
					<strong>Name: </strong>'. $name .' <br/>
					<strong>Email: </strong>'. $email .'
				</p>
				<p>'. $comment .'</p>
			</body>
			</html>
		';
		
		$headers[] = 'MIME-Version: 1.0' . "\r\n";
		$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers[] = "X-Mailer: PHP \r\n";
		$headers[] = 'From: ' . $name . ' <'. $email .'>' . "\r\n";
	
		$mail = wp_mail( $to, $subject, $message, $headers );
		
		if( $mail ) {
			if( $data['rsclean_contact_message'] )
				$success = $data['rsclean_contact_message'];
			else
				$success = 'Thank you! We will get back to you as soon as possible';
		}
		
	}
	
	if( ! empty( $error ) )
		echo '<p class="error">'. $error .'</p>';
	
	if( ! empty( $success ) )
		echo '<p class="success">'. $success .'</p>';
		
	// return proper result
	die();
}

add_action( 'wp_ajax_nopriv_user_registration', 'user_registration_callback' );
add_action( 'wp_ajax_user_registration', 'user_registration_callback' );
/*
 *	@desc	Process theme contact
 */
function user_registration_callback() {
	global $wpdb;
	
	$error = '';
	$success = '';
	$nonce = $_POST['nonce'];
	
	if ( ! wp_verify_nonce( $nonce, 'rs_user_registration_action' ) )
        die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
	
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$pwd1 = $_POST['pwd1'];
	$pwd2 = $_POST['pwd2'];
	
	if( empty( $email ) || empty( $pwd1 ) || empty( $pwd2 ) || empty( $username ) || empty( $first_name ) || empty( $last_name) ) {
        $error = 'All fields are required.';
    } else if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        $error = 'Invalid email address.';
    } else if( email_exists($email) ) {
        $error = 'Email already exist.';
    } else if( $pwd1 <> $pwd2 ) {
        $error = 'Password do not match.';        
    } else {
 
		$user_params = array (
			'first_name' 	=> apply_filters( 'pre_user_first_name', $first_name ), 
			'last_name' 	=> apply_filters( 'pre_user_last_name', $last_name ), 
			'user_pass' 	=> apply_filters( 'pre_user_user_pass', $pwd1 ), 
			'user_login' 	=> apply_filters( 'pre_user_user_login', $username ), 
			'user_email' 	=> apply_filters( 'pre_user_user_email', $email ), 
			'role' 			=> 'subscriber'
		);
        $user_id = wp_insert_user( $user_params );
		
        if( is_wp_error( $user_id ) ) {
            $error = 'Error on user creation.';
        } else {
            do_action( 'user_register', $user_id );
            
            $success = 1;
        }
        
    }
	
	if( ! empty( $error ) )
		echo '<p class="error">'. $error .'</p>';
	
	if( ! empty( $success ) )
		echo $success;
		
	// return proper result
	die();
}


add_action( 'wp_ajax_nopriv_user_login', 'user_login_callback' );
add_action( 'wp_ajax_user_login', 'user_login_callback' );
/*
 *	@desc	Process theme contact
 */
function user_login_callback() {
	global $wpdb;
	
	$error = '';
	$success = '';
	$nonce = $_POST['nonce'];
	
	if ( ! wp_verify_nonce( $nonce, 'rs_user_login_action' ) )
        die ( '<p class="error">Security checked!, Cheatn huh?</p>' );
	
	//We shall SQL escape all inputs to avoid sql injection.
	$username = $wpdb->escape($_POST['log']);
	$password = $wpdb->escape($_POST['pwd']);
	$remember = $wpdb->escape($_POST['remember']);
	
	if( empty( $username ) ) {
		$error = 'Username field is required.';
	} else if( empty( $password ) ) {
		$error = 'Password field is required.';
	} else {
		$user_data = array();
		$user_data['user_login'] = $username;
		$user_data['user_password'] = $password;
		$user_data['remember'] = $remember;  
		$user = wp_signon( $user_data, false );
		
		if ( is_wp_error($user) ) {
			$error = $user->get_error_message();
		} else {
			wp_set_current_user( $user->ID, $username );
			do_action('set_current_user');
			
			$success = 1;
		}
	}
	
	if( ! empty( $error ) )
		echo '<p class="error">'. $error .'</p>';
	
	if( ! empty( $success ) )
		echo $success;
		
	// return proper result
	die();
}