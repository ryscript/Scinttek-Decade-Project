<?php
global $data;

if( $data['rsclean_enable_slider'] ) { ?>

	<div class="row">
		<div class="col-md-12">
			<?php
			if( $data['rsclean_enable_slider'] ) { ?>
			
				<ul class="rslides">
					<?php
						$sliders = $data['rsclean_homepage_sliders'];
						
						foreach( $sliders as $slider ) 
						{
							?>
							<li>
								<div class="slider-content">
									<div class="row">
										<div class="col-md-4">
											<img src="<?php echo $slider['url']; ?>" alt="<?php echo esc_attr( $slider['title'] ); ?>" class="slider-image" />
										</div>
										<div class="col-md-8">
											<h2 class="slider-title"><?php echo $slider['title']; ?></h2>
											<?php echo wpautop( $slider['description'] ); ?>
											
											<?php if( $slider['link'] ) { ?>
												<a href="<?php echo $slider['link']; ?>" class="btn">Read More</a>
											<?php } ?>
										</div>
									</div>
								</div>
							</li>
							<?php	
						}
					?>
				</ul>
			
			<?php } ?>
		</div>
	</div>

<?php } ?>