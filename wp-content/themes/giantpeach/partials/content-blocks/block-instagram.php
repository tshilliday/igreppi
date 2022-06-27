<?php
// $options = get_option('sb_instagram_settings');
// if (isset($options[ 'sb_instagram_user' ])) {
//     echo $options[ 'sb_instagram_user' ];
// }?>

<section class="content-block content-block--instagram scroll-trigger">
    <div class="c">
        <?php echo do_shortcode('[instagram-feed showfollow=false]'); ?>
    </div>
</section>
