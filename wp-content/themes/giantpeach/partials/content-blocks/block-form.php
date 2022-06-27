<?php
$heading = get_sub_field('heading');
$form = get_sub_field('form_id');
?>
<section class="content-block content-block--form" id="<?php echo $form; ?>">
    <div class="c">
        <?php
        switch ($form) {
            case 'newsletter-signup':
                echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');
                break;
            case 'contact':
                echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]');
                break;
            case 'product-enquiry':
                echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]');
                break;
            case 'club-signup':
                echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]');
                break;
        }
        ?>
    </div>
</section>
