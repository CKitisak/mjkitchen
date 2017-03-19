<?php get_header(); ?>
	
	<div class="row">
		<div class="col-md-12">
			<?php if(mytheme_option('home_slider_amount')==0 || mytheme_option('home_slider_amount')=="") : else : ?>
				
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<?php if(mytheme_option('home_slider_amount')==1) : else : ?>
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php for($i=0;$i<mytheme_option('home_slider_amount');$i++) : ?>
						<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if ($i==0) echo 'class="active"'; ?>></li> 
					<?php endfor; ?>
				</ol>
				<?php endif; ?>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<?php for($i=0;$i<mytheme_option('home_slider_amount');$i++) : ?>
						<div class="item <?php if ($i==0) echo "active"; ?>">
							<?php $image_url = "home_slider_url_".$i; ?>
							<?php $image_title = "home_slider_title_".$i; ?>
							<?php $image_desc = "home_slider_desc_".$i; ?>
							<img src="<?php echo mytheme_option($image_url); ?>" alt="<?php echo mytheme_option($image_title); ?>">
							<div class="carousel-caption">
								<h3><?php echo mytheme_option($image_title); ?></h3>
								<p><?php echo mytheme_option($image_desc); ?></p>
							</div>
						</div>
					<?php endfor; ?>
				</div>
				
				<?php if(mytheme_option('home_slider_amount')==1) : else : ?>
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div> <!-- /.col-md-12 -->
	</div> <!-- /.row -->
	
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="home-product-wrapper">
					<h2 class="page-title"><a href="<?php echo get_page_link(10); ?>"><?php echo get_the_title(10); ?></a></h2>					

						<?php $custom_fields = get_post_custom(10);
						 	$menu_img = $custom_fields['products-left-menu'];
						 	foreach ( $menu_img as $key => $value ) :
							 	echo '<div class="col-md-3"><a class="image-wrapper" href="';
							 	
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
								 	echo '<h4 class="product-menu-title">'.get_cat_name(5).'</h3></a></div>';
								elseif ($key == 1) :
								 	echo '<h4 class="product-menu-title">'.get_cat_name(7).'</h3></a></div>';
								elseif ($key == 2) :
								 	echo '<h4 class="product-menu-title">'.get_cat_name(6).'</h3></a></div>';
								elseif ($key == 3) :
								 	echo '<h4 class="product-menu-title">'.get_cat_name(8).'</h3></a></div>';
								endif;
							endforeach;
						?>
					
				</div><!-- /#home-product-wrapper -->
			</div><!-- /.row -->
		</div><!-- /.col-md-12 -->
	</div> <!-- /.row -->
	
	<div class="row">
		<div class="home-gallery-wrapper">
			<div class="col-md-12">
				<h2 class="page-title"><a href="<?php echo get_page_link(7); ?>"><?php echo get_the_title(7); ?></a></h2>
				<div class="row">
			        <?php $args = array ( 'category' => 4, 'posts_per_page' => 4); ?>
					<?php $myposts = get_posts( $args ); ?>
					<? if(!empty($myposts)) : ?>
						<?php foreach( $myposts as $post ) : setup_postdata($post); ?>
							<div class="col-md-3">
								<div class="image-wrapper">
									<a href="<?php echo get_page_link(7); ?>"><?php the_post_thumbnail(); ?></a>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<a href="<?php echo get_page_link(7); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/home-gallery.jpg" width="100%" /></a>
					<?php endif; ?>
				</div> <!-- /.row -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.post-gallery-wrapper -->
	</div> <!-- /.row -->
	
	<div class="row">
		<div class="home-icon-wraper">
			<div class="col-md-2">
				<div class="home-icon">
					<img src="<?php bloginfo('template_directory'); ?>/img/icon-nature.png" width="80" height="80" />
					<?php if(qtrans_getLanguage() == "en") : ?>
						<p>Made From Rubber Wood</p>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<p>ผลิตจากไม้ยางพารา</p>
					<?php endif; ?>
				</div>
			</div> <!-- /.col-md-2 -->
			<div class="col-md-2">
				<div class="home-icon">
					<img src="<?php bloginfo('template_directory'); ?>/img/icon-pu.png" width="80" height="80" />
					<?php if(qtrans_getLanguage() == "en") : ?>
						<p>PU Non-Toxic Colour</p>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<p>สี PU ปลอดสารพิษ</p>
					<?php endif; ?>
				</div>
			</div> <!-- /.col-md-2 -->
			<div class="col-md-2">
				<div class="home-icon">
					<img src="<?php bloginfo('template_directory'); ?>/img/icon-diy.png" width="80" height="80" />
					<?php if(qtrans_getLanguage() == "en") : ?>
						<p>You can install it by yourself</p>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<p>สามารถติดตั้งได้ด้วยตัวเอง</p>
					<?php endif; ?>
				</div>
			</div> <!-- /.col-md-2 -->
			<div class="col-md-2">
				<div class="home-icon">
					<img src="<?php bloginfo('template_directory'); ?>/img/icon-waterproof.png" width="80" height="80" />
					<?php if(qtrans_getLanguage() == "en") : ?>
						<p>Waterproof and Moisture Prevention</p>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<p>กันน้ำ กันชื้น</p>
					<?php endif; ?>
				</div>
			</div> <!-- /.col-md-2 -->
			<div class="col-md-2">
				<div class="home-icon">
					<img src="<?php bloginfo('template_directory'); ?>/img/icon-e1(2).jpg" width="80" height="80" />
					<?php if(qtrans_getLanguage() == "en") : ?>
						<p>E1 Standard Wood</p>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<p>มาตรฐาน E1</p>
					<?php endif; ?>
				</div>
			</div> <!-- /.col-md-2 -->
			<div class="col-md-2">
				<div class="home-icon">
					<img src="<?php bloginfo('template_directory'); ?>/img/icon-stronger.png" width="80" height="80" />
					<?php if(qtrans_getLanguage() == "en") : ?>
						<p>Stronger, Cheaper and Durable</p>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<p>แข็งแรงทนทาาน</p>
					<?php endif; ?>
				</div>
			</div> <!-- /.col-md-2 -->
		</div> <!-- /.home-icon-wraper -->
	</div> <!-- /.row -->
	
	<div class="row">
		<div class="home-address-wraper">
			<div class="col-md-6">
				<div class="home-address">
					<h4 class="heading-title">
						<?php if(qtrans_getLanguage() == "en") : ?>
							<?php echo mytheme_option('mj_title'); ?>
						<?php elseif(qtrans_getLanguage() == "th") : ?>
							<?php echo mytheme_option('mj_title_th'); ?>
						<?php endif; ?>
					</h4>
					<address>
						<?php if(qtrans_getLanguage() == "en") : ?>
							<p><?php echo mytheme_option('mj_address'); ?></p>
							<p>Tel: <?php echo mytheme_option('mj_phone'); ?></p>
							<p>Fax: <?php echo mytheme_option('mj_fax'); ?></p>
							<p>Email: <?php echo mytheme_option('mj_email'); ?></p>
						<?php elseif(qtrans_getLanguage() == "th") : ?>
							<p><?php echo mytheme_option('mj_address_th'); ?></p>
							<p>โทร: <?php echo mytheme_option('mj_phone'); ?></p>
							<p>แฟ็กซ์: <?php echo mytheme_option('mj_fax'); ?></p>
							<p>อีเมล์: <?php echo mytheme_option('mj_email'); ?></p>
						<?php endif; ?>
					</address>
				</div>
			</div> <!-- /.col-md-6 -->
			<div class="col-md-6">
				<div class="home-news">
					<h3 class="heading-title"><a href="<?php echo get_category_link(10); ?>"><?php echo get_cat_name(10); ?></a></h3>
					<ul>
						<?php
							$args = array ( 'category' => 10, 'posts_per_page' => 5);
							$myposts = get_posts( $args );
							foreach( $myposts as $post ) :	setup_postdata($post);
						?>
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
						<?php endforeach; ?>
					</ul>
					
				</div>
			</div> <!-- /.col-md-6 -->
		</div>
	</div> <!-- /.row -->
	
<?php get_footer(); ?>