<?php get_header(); ?>

<div class="row">
	<h1 class="page-title bdr-bot"><?php the_title(); ?></h1>
	<div class="col-md-5">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria. try again'); ?></p>
		<?php endif; ?>
	</div><!-- /.col-md-5 -->
	
	<div class="col-md-5 bdr-left">
		<div class="container-fluid">
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

		<h4 class="heading-title">
			<?php if(qtrans_getLanguage() == "en") : ?>
				<?php echo mytheme_option('mj_partner_title'); ?>
			<?php elseif(qtrans_getLanguage() == "th") : ?>
				<?php echo mytheme_option('mj_partner_title_th'); ?>
			<?php endif; ?>
		</h4>
		<div id="accordion">
		    <h4 class="heading-content">
				<a class="acd-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseNorth">
					<?php if(qtrans_getLanguage() == "en") : ?>
						<?php echo mytheme_option('mj_partner_north_title'); ?>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<?php echo mytheme_option('mj_partner_north_title_th'); ?>
					<?php endif; ?>
				</a>
			</h4>
			<div id="collapseNorth" class="collapse">
				<ul>
					<?php echo mytheme_option('mj_partner_north'); ?>
				</ul>
			</div>
			
			<h4 class="heading-content">
				<a class="acd-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseNorthEast">
					<?php if(qtrans_getLanguage() == "en") : ?>
						<?php echo mytheme_option('mj_partner_northeast_title'); ?>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<?php echo mytheme_option('mj_partner_northeast_title_th'); ?>
					<?php endif; ?>
				</a>
			</h4>
			<div id="collapseNorthEast" class="collapse">
				<ul>
					<?php echo mytheme_option('mj_partner_northeast'); ?>
				</ul>
			</div>
			
		    <h4 class="heading-content">
				<a class="acd-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseMiddle">
					<?php if(qtrans_getLanguage() == "en") : ?>
						<?php echo mytheme_option('mj_partner_central_title'); ?>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<?php echo mytheme_option('mj_partner_central_title_th'); ?>
					<?php endif; ?>
				</a>
			</h4>
		    <div id="collapseMiddle" class="collapse">
				<ul>
					<?php echo mytheme_option('mj_partner_central'); ?>
				</ul>
		    </div>
		    
		    <h4 class="heading-content">
				<a class="acd-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseEast">
					<?php if(qtrans_getLanguage() == "en") : ?>
						<?php echo mytheme_option('mj_partner_east_title'); ?>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<?php echo mytheme_option('mj_partner_east_title_th'); ?>
					<?php endif; ?>
				</a>
			</h4>
		    <div id="collapseEast" class="collapse">
		        <ul>
		        	<?php echo mytheme_option('mj_partner_east'); ?>
			  	</ul>
		    </div>
			
			<h4 class="heading-content">
				<a class="acd-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseWest">
					<?php if(qtrans_getLanguage() == "en") : ?>
						<?php echo mytheme_option('mj_partner_west_title'); ?>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<?php echo mytheme_option('mj_partner_west_title_th'); ?>
					<?php endif; ?>
				</a>
			</h4>
		    <div id="collapseWest" class="collapse">
		        <ul>
		        	<?php echo mytheme_option('mj_partner_west'); ?>
			  	</ul>
		    </div>
			
			<h4 class="heading-content">
				<a class="acd-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSouth">
					<?php if(qtrans_getLanguage() == "en") : ?>
						<?php echo mytheme_option('mj_partner_south_title'); ?>
					<?php elseif(qtrans_getLanguage() == "th") : ?>
						<?php echo mytheme_option('mj_partner_south_title_th'); ?>
					<?php endif; ?>
				</a>
			</h4>
		    <div id="collapseSouth" class="collapse">
		        <ul>
			        <?php echo mytheme_option('mj_partner_south'); ?>
			  	</ul>
		    </div>
		</div><!-- /#accordion -->
		</div>
	</div><!-- /.col-md-5 -->
	<div class="col-md-2">
		<div class="container-fluid">
			<div class="image-wrapper mj-map">
				<a data-toggle="modal" data-target=".mj-kitchen-map" style="cursor: pointer;">
					<img src="<?php echo mytheme_option('mj_map'); ?>" alt="mj-map" />
				</a>
			</div>
			<!-- modal -->
			<button class="btn btn-xs center-block view-map" data-toggle="modal" data-target=".mj-kitchen-map">Viewmap <span class="glyphicon glyphicon-zoom-in"></span></button>
			
			<div class="modal fade mj-kitchen-map" tabindex="-1" role="dialog" aria-labelledby="mj-kitchen-map" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="image-wrapper">
							<img src="<?php echo mytheme_option('mj_map'); ?>" alt="mj-map" width="800" height="800" />
						</div><!-- /.image-wrapper -->
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
	</div><!-- /.col-md-2 -->
</div> <!-- /.row -->

<?php get_footer(); ?>