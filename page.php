<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="row">
			<?php if(is_page('about-us')) : ?>
				<?php the_post_thumbnail(); ?>
				<h1 class="page-title bdr-top bdr-bot"><?php the_title(); ?></h1>
			<?php elseif(is_page('gallery')) : ?>
				<h1 class="page-title bdr-bot"><?php the_title(); ?></h1>
			<?php else : ?>
				<h1 class="page-title bdr-bot"><?php the_title(); ?></h1>
			<?php endif ?>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="page-content">
					<?php if(is_page('gallery')) : ?>
						<?php echo do_shortcode("[metaslider id=5]"); ?>
						<hr />
						
						<?php the_content(); ?>
						
						<?php $args = array ( 'category' => 4, 'posts_per_page' => 12); ?>
						<?php $myposts = get_posts( $args ); ?>
						<div class="row">
						<h3 class="heading-title"></h3>
						<?php foreach( $myposts as $post ) :	setup_postdata($post); ?>
							<div class="col-md-4">
								<a data-toggle="modal" data-target=".post-<?php echo $post->ID; ?>" style="cursor: pointer;">
									<div class="image-wrapper gallery-image">
										<?php the_post_thumbnail(); ?>
									</div>
								</a>
								<p class="gallery-title"><?php the_title(); ?></p>
							</div>
							
							<div class="modal fade post-<?php echo $post->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="post-<?php echo $post->ID; ?>" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="image-wrapper">
											<?php the_post_thumbnail(); ?>
										</div><!-- /.image-wrapper -->
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						<?php endforeach; ?>
						</div>
					<?php else : ?>
						<?php the_content(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>	
	<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria. try again'); ?></p>
	<?php endif; ?>
	
	<?php if(is_page('about-us')) : ?>
		<div class="row">
			<?php $custom_fields = get_post_custom(36);
			 	$my_custom_field = $custom_fields['about-footer-image'];
			 	foreach ( $my_custom_field as $key => $value ) :
				 	echo '<img class="" src="'.$value.'" width="100%" />';
				endforeach;
			?>
		</div>
	<?php endif; ?>
	
	<?php if(is_page('services')) : ?>
		<div class="row">
			<?php echo do_shortcode("[metaslider id=170]"); ?>
		</div>
		<div class="clearfix"></div>
	<?php endif; ?>

<?php get_footer(); ?>