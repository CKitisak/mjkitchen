		</div> <!-- /container -->
	</div> <!-- #main -->
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="credit">
					<?php if (mytheme_option('footer_credit_link')) : ?>
<!-- 						<p>&copy;2014 <a href="<?php site_url(); ?>">M.J. KITCHEN</a> Powered by <a href="#">KWdev</a></p> -->
						<p>&copy;2013 <a href="<?php site_url(); ?>">M.J. KITCHEN</a> (Thailand), All Right Reserved</p>
					<?php endif; ?>
					</div>
				</div> <!-- /.col-md-6 -->
				<div clss="col-md-6">
					<div class="footer-menu-wrapper pull-right">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'fallback_cb' => '' ) ); ?>
					</div>
				</div> <!-- /.col-md-6 -->
			</div> <!-- /.row -->
		</div> <!-- /container -->
	</footer>
	
    <?php wp_footer(); ?>
  </body>
</html>