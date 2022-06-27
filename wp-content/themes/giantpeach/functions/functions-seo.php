<?php
add_filter('the_seo_framework_sitemap_exclude_ids', 'my_sitemap_exclude_ids');
function my_sitemap_exclude_ids($ids)
{
    $_404 = get_page_id_by_template('404.php');
    if ($_404) {
        $ids[] = $_404;
    }
    return $ids;
}

add_filter( 'the_seo_framework_robots_meta_array', function( $meta ) {
	if ( is_page_template('404.php') ) {
		$meta['noindex'] = 'noindex';
		$meta['nofollow'] = 'nofollow';
		$meta['noarchive'] = 'noarchive';
	}
	return $meta;
} );

add_action('wp_head', 'ga_tracking_code_gp', 10, 1);

function ga_tracking_code_gp() {
    $tracking_id = get_field('ga_tracking_id','website-settings');
    if ($tracking_id) :
    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_id; ?>"></script>
    <script>
    window.ga_tracking_id = '<?php echo $tracking_id; ?>';
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo $tracking_id; ?>');
    </script>
    <?php
    endif;
}
