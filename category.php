<?php get_header(); ?>

			<div class="row">
				<?php if(in_category(array('cabinet','jigsaw','sink-and-drawer','smart-set'))) : ?>
					<h1 class="page-title bdr-bot"><?php echo get_the_title(10); ?></h1>
				<?php elseif(in_category('services')) : ?>
					<h1 class="page-title bdr-bot"><?php echo get_the_title(22); ?></h1>
				<?php elseif(in_category('galleries')) : ?>
					<h1 class="page-title bdr-bot"><?php echo get_the_title(7); ?></h1>
				<?php endif; ?>
			</div>
			
			<div class="row">
				<div class="col-md-4">
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
				<div class="col-md-8 bdr-left">
					<div class="row">
						<div class="page-content">
							<h3 class="page-title"><?php single_cat_title(); ?></h3>
							<?php query_posts($query_string."&orderby=date&order=ASC"); ?>
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<div class="col-md-6">
									<div class="post-item">
										<div class="cat-image-wrapper">
											<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full'); ?></a>
										</div>
										<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											<?php the_meta(); ?>
									</div>
								</div><!-- /.col-md-6 -->
							<?php endwhile; else: ?>
								<p><?php _e('Sorry, there are no posts.'); ?></p>
							<?php endif; ?>
							<div class="clearfix"></div>
							<?php if(is_category(array('cabinet','jigsaw','sink-and-drawer','smart-set'))) : ?>
								<p class="text-center">
									<a class="btn btn-mj-download btn-mj" href="http://www.mjkitchengroup.com/download/catalogue.pdf" target="_blank" role="button">view more</a>
								</p>
							<?php endif; ?>							
						</div><!-- /.page-content -->
					</div><!-- /.row -->
				</div><!-- /.col-md-8 -->
			</div><!-- /.row -->

<?php get_footer(); ?>