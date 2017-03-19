<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="row">
			<?php if(has_post_thumbnail()) : ?>
				<div class="image-wrapper">
					<?php the_post_thumbnail(); ?>
				</div>
				<h1 class="page-title bdr-top bdr-bot"><?php the_title(); ?></h1>	
			<?php else : ?>
				<h1 class="page-title bdr-bot"><?php the_title(); ?></h1>
			<?php endif ?>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4 bdr-right">
						<div class="product-menu">
							<?php $custom_fields = get_post_custom(10);
							 	$menu_img = $custom_fields['products-left-menu'];
							 	foreach ( $menu_img as $key => $value ) :
								 	echo '<a class="image-wrapper" href="';
								 	
								 	if ($key == 0) :
									 	echo get_category_link(5);
									elseif ($key == 1) :
									 	echo get_category_link(7);
									elseif ($key == 2) :
									 	echo get_category_link(6);
									elseif ($key == 3) :
									 	echo get_category_link(8);
									endif;
								 	
								 	echo '"><img class="product-menu-image" src="'.$value.'" width="100%" />';
								 	
								 	if ($key == 0) :
									 	echo '<h3 class="product-menu-title">'.get_cat_name(5).'</h3></a>';
									elseif ($key == 1) :
									 	echo '<h3 class="product-menu-title">'.get_cat_name(7).'</h3></a>';
									elseif ($key == 2) :
									 	echo '<h3 class="product-menu-title">'.get_cat_name(6).'</h3></a>';
									elseif ($key == 3) :
									 	echo '<h3 class="product-menu-title">'.get_cat_name(8).'</h3></a>';
									endif;
									
								endforeach;
							?>
						</div>
					</div><!-- /.col-md-4 -->
					<div class="col-md-8">
						<div class="page-content">
							<?php the_content(); ?>
						</div>
					</div><!-- /.col-md-8 -->
				</div><!-- /.row -->
			</div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria. try again'); ?></p>
	<?php endif; ?>

<?php get_footer(); ?>