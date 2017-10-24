		</div> <!-- /container -->
	</div> <!-- #main -->
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="credit">
					<?php if (mytheme_option('footer_credit_link')) : ?>
<!-- 						<p>&copy;2014 <a href="<?php site_url(); ?>">M.J. KITCHEN</a> Powered by <a href="#">KWdev</a></p> -->
						<p>&copy;2013 - <?php echo date("Y"); ?><a href="<?php site_url(); ?>">M.J. KITCHEN</a> (Thailand), All Right Reserved</p>
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

  <!-- Modal -->
  <div class="modal fade" id="mjIntroModal" tabindex="-1" role="dialog" aria-labelledby="mjkitchenIntro">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body no-padding">
          <div style="position: absolute; top: 0px; right: 5px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <img src="<?php echo mytheme_option('intro_image'); ?>" width="100%" />
        </div>
      </div>
    </div>
  </div>

    <?php wp_footer(); ?>

  <script>
		// Use full jQuery function name to reference jQuery.
		jQuery(document).ready(function() {
    		jQuery('#s-toggle').click(function() {
				jQuery('.s-form').animate({
					width: "toggle",
					opacity: "toggle"
				}, 100);
			});
      jQuery('#mjIntroModal').modal('show');

			jQuery(window).scroll(function() {
              if (jQuery(this).scrollTop()) {
                    jQuery('.toTop:hidden').stop(true, true).fadeIn();
              } else {
                    jQuery('.toTop').stop(true, true).fadeOut();
               }
          });
		});
	</script>
  </body>
</html>
