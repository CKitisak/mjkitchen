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
			<?php if(in_category(array('cabinet','jigsaw','sink-and-drawer','smart-set'))) : ?>
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
			<?php endif; ?>
			
			<?php if(in_category('services')) : ?>
				<div class="col-md-4 bdr-right">
					<div class="service-menu">
						<?php
							$args = array ( 'category' => 13, 'posts_per_page' => 4);
							$myposts = get_posts( $args );
							foreach( $myposts as $post ) :	setup_postdata($post);
						?>
							<a class="image-wrapper" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail(); ?>
								<h3><?php the_title(); ?></h3>
							</a>
						<?php endforeach; ?>
						<?php wp_reset_query(); ?>
					</div>
				</div><!-- /.col-md-4 -->
			<?php endif; ?>
			
			<div class="col-md-8 <?php if(in_category(array('news','galleries'))) echo "col-md-offset-2"; ?>">
				<div class="page-content">
					<?php query_posts($query_string."&orderby=date&order=ASC"); ?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
						<?php if(!in_category('galleries')) : ?>
							<h3><?php the_title(); ?></h3>
						<?php endif; ?>
						<?php edit_post_link('Edit', '<div class="edit">', '</div>'); ?>
						
						<?php if(in_category(array('cabinet','jigsaw','sink-and-drawer','smart-set','galleries'))) : ?>
							<a data-toggle="modal" data-target=".mjkitchen-image" style="cursor: pointer;">
								<div class="image-wrapper">
									<?php the_post_thumbnail(); ?>
								</div>
							</a>
							
							<div class="modal fade mjkitchen-image" tabindex="-1" role="dialog" aria-labelledby="mjkitchen-image" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="image-wrapper">
											<?php the_post_thumbnail(); ?>
										</div><!-- /.image-wrapper -->
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						<?php endif; ?>
						
						<?php the_meta(); ?>
						
						<?php the_content(); ?>
						
						<p><span class="text-muted"><?php the_tags(); ?></span></p>
							
					<?php endwhile; else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
				</div><!-- /.page-content -->
				
				<hr />
				<div class="navigation">
					<div class="pull-right"><?php next_post_link('%link', ' Next page &raquo;', TRUE); ?></div>
					<div class="pull-left"><?php previous_post_link('%link', '&laquo; Previous page', TRUE); ?></div>
				</div>
				
			</div><!-- /.col-md-8 -->
			
			<?php if(!in_category(array('cabinet','jigsaw','sink-and-drawer','smart-set'))) : ?>
				<div class="col-md-4">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
		</div><!-- /.row -->

<?php get_footer(); ?>