<?php 
/**
 * @desc	If you have something to add in add_action function add it here.
 * @author	Ryan Sutana
 * @uri		http://www.sutanaryan.com/
 */
 
add_action('wp_head','custom_placeholder_callback');
function custom_placeholder_callback() { ?>
	<script>
	jQuery(document).ready(function($){
		$("#whats-new-textarea textarea").attr('placeholder','What are you in the mood to do...');
	});
	</script>
	<?php
}

add_action( 'login_head', 'rs_custom_admin_logo' );
/*
 * @desc Change WP Login Logo
 */
function rs_custom_admin_logo() 
{
	global $data;
	
	$logo_path = $data['rsclean_logo'];
	?>
	<style type="text/css">
		.login h1 a{
			background: url('<?php echo $logo_path; ?>') top center no-repeat;
			width: 326px;
			height: 88px;
		}
	</style>
	<?php 
}

/**
 * Check if BuddyPress is active
 **/
if ( in_array( 'buddypress/bp-loader.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	// Delte profile banner
	add_action( 'wp_ajax_bppg_delete_bg', 'ajax_delete_current_bg' );
	
	function xprofile_setup_background_func() {
		global $bp;
		
		$profile_link = bp_loggedin_user_domain() . $bp->profile->slug . '/';
			bp_core_new_subnav_item (
			array(
				'name' 				=> __( 'Change Profile Banner', 'bppg' ),
				'slug' 				=> 'change-banner',
				'parent_url' 		=> $profile_link,
				'parent_slug' 		=> $bp->profile->slug, 
				'screen_function' 	=> 'screen_change_bg',
				'user_has_access'   => ( bp_is_my_profile() || is_super_admin() ),
				'position' 			=> 40 
			) );
	   
	}
	add_action( 'bp_xprofile_setup_nav', 'xprofile_setup_background_func' );

	
	function screen_change_bg(){
		global $bp;
		
		//if the form was submitted, update here
		if( !empty( $_POST['bpprofbg_save_submit'] ) ){
			if( !wp_verify_nonce( $_POST['_wpnonce'], 'bp_upload_profile_bg' ) )
				die(__('Security check failed','bppbg'));
			
			if( handle_upload())
				bp_core_add_message(__('Profile banner successfully uploaded.', 'bppg'));	  
		}

		//hook the content
		add_action( 'bp_template_title', 'page_title' );
		add_action( 'bp_template_content', 'page_content' );
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}
	
	// Page Title
	function page_title() {
		?>
			<h3>Profile Banner</h3>
		<?php
	}
	
	// Page content
	function page_content() {
		?>
		<form name="bpprofbpg_change" id="bpprofbpg_change" method="post" class="standard-form" enctype="multipart/form-data">
			<?php
				$image_url=  bppg_get_image();
				if(!empty($image_url)) :
					?>
					
						<div id="bg-delete-wrapper">
							<div class="current-bg">
								<img src="<?php echo $image_url;?>" alt="current background" />
							</div>
							<a href='#' id='bppg-del-image'><?php _e('Delete','bppg');?></a>
						</div>
				
					<?php
				endif;
			?> 
			
			<p><?php _e( 'If you want to change your profile banner, please upload a new image.', 'bppg' );?></p>
			<label for="bprpgbp_upload">
				<input type="file" name="file" id="bprpgbp_upload"  class="settings-input" />
			</label>
			
			<?php wp_nonce_field("bp_upload_profile_bg");?>
			<input type="hidden" name="action" id="action" value="bp_upload_profile_bg" />
			
			<p class="submit">
				<input type="submit" id="bpprofbg_save_submit" name="bpprofbg_save_submit" class="button" value="<?php _e('Save','bppg') ?>" />
			</p>
		</form>
		<?php
	}
	
	function handle_upload() {
		global $bp;

		//include core files
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		$max_upload_size = get_max_upload_size();
		$max_upload_size = $max_upload_size * 1024;//convert kb to bytes
		
		$file = $_FILES;
			
		//I am not changing the domain of erro messages as these are same as bp, so you should have a translation for this
		$uploadErrors = array(
			0 => __('There is no error, the file uploaded with success', 'buddypress'),
			1 => __('Your image was bigger than the maximum allowed file size of: ', 'buddypress') . size_format( $max_upload_size ),
			2 => __('Your image was bigger than the maximum allowed file size of: ', 'buddypress') . size_format( $max_upload_size ),
			3 => __('The uploaded file was only partially uploaded', 'buddypress'),
			4 => __('No file was uploaded', 'buddypress'),
			6 => __('Missing a temporary folder', 'buddypress')
		);

		if ( isset($file['error']) && $file['error']) {
			bp_core_add_message( sprintf( __( 'Your upload failed, please try again. Error was: %s', 'buddypress' ), $uploadErrors[$file['file']['error']] ), 'error' );
			return false;
		}

		if ( ! ($file['file']['size'] < $max_upload_size) ) {
			bp_core_add_message( sprintf( __( 'The file you uploaded is too big. Please upload a file under %s', 'buddypress'), size_format($max_upload_size) ), 'error' );
			
			return false;
		}
			
		if ( ( !empty( $file['file']['type'] ) && !preg_match('/(jpe?g|gif|png)$/i', $file['file']['type'] ) ) || !preg_match( '/(jpe?g|gif|png)$/i', $file['file']['name'] ) ) {
			bp_core_add_message( __( 'Please upload only JPG, GIF or PNG photos.', 'buddypress' ), 'error' );
			
			return false;
		}

		$uploaded_file = wp_handle_upload( $file['file'], array( 'action'=> 'bp_upload_profile_bg' ) );

		//if file was not uploaded correctly
		if ( !empty($uploaded_file['error'] ) ) {
				bp_core_add_message( sprintf( __( 'Upload Failed! Error was: %s', 'buddypress' ), $uploaded_file['error'] ), 'error' );
			
			return false;
		}

		//assume that the file uploaded succesfully
		//delete any previous uploaded image
		delete_bg_for_user();
		
		//save in usermeta
		bp_update_user_meta(bp_loggedin_user_id(),'profile_bg', $uploaded_file['url']);
		bp_update_user_meta(bp_loggedin_user_id(),'profile_bg_file_path', $uploaded_file['file']);
		

		do_action( 'bppg_background_uploaded', $uploaded_file['url'] );//allow to do some other actions when a new background is uploaded
		
		return true;
	}
	
	function get_max_upload_size() {
		$max_file_sizein_kb = get_site_option( 'fileupload_maxk' );//it wil be empty for standard wordpress

		if( empty( $max_file_sizein_kb ) ){//check for the server limit since we are on single wp
		
			$max_upload_size 	= (int)(ini_get('upload_max_filesize'));
			$max_post_size 		= (int)(ini_get('post_max_size'));
			$memory_limit 		= (int)(ini_get('memory_limit'));
			$max_file_sizein_mb = min( $max_upload_size, $max_post_size, $memory_limit );
			$max_file_sizein_kb = $max_file_sizein_mb * 1024;//convert mb to kb
		}
	
		return apply_filters( 'bppg_max_upload_size', $max_file_sizein_kb );
	}
	
	function ajax_delete_current_bg() {
    
		// validate nonce
		if( ! wp_verify_nonce($_POST['_wpnonce'], "bp_upload_profile_bg") )
			die('what!');
		
		// call delete function
		delete_bg_for_user();
		
		//feedback but we don't do anything with it yet, should we do something
		$message = '<p>'.__('Profile banner image successfully deleted.', 'bppg').'</p>'; 
		
		echo $message;
		exit(0);
	}

	//reuse it
	function delete_bg_for_user() {
		//delete the associated image and send a message
		$old_file_path = get_user_meta( bp_loggedin_user_id(), 'profile_bg_file_path', true );
		
		if( $old_file_path )
			@unlink ( $old_file_path );//remove old files with each new upload
		
		bp_delete_user_meta( bp_loggedin_user_id(), 'profile_bg_file_path' );
		bp_delete_user_meta( bp_loggedin_user_id(), 'profile_bg' );  
	}
	
	function bppg_get_image( $user_id = false ) {
		global $bp;
		
		if(!$user_id)
			$user_id = bp_displayed_user_id();

		if( empty( $user_id ) )
			return false;
		
		$image_url = bp_get_user_meta( $user_id, 'profile_bg', true );
		
		return apply_filters( 'bppg_get_image', $image_url, $user_id );
	}

}