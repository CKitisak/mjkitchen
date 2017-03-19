<form action="/" method="get">
    <fieldset>
        <label for="search">Search in <?php echo home_url( '/' ); ?></label>
        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
        <input type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
        <input type="hidden" value="post" name="post_type" id="post_type" />
    </fieldset>
</form>