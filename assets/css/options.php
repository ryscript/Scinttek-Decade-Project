/**
 *  Theme Options
 */

<?php
global $data;


if( $data['rsclean_background_image'] ) {
	?>

		body {	 
			background: <?php echo $data['rsclean_background_color']; ?> url("<?php echo $data['rsclean_background_image']; ?>") no-repeat center top;
		}
		
	<?php 
}
?>