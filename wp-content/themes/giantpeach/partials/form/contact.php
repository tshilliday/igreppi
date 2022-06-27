<?php
$heading = get_sub_field('heading');
?>
<form class="form--contact gp_form" name="contact" method="POST">
    <div class="r">
        <div class="c-md-12">
            <?php if ($heading) : ?>
                <h2 class="h4"><?php echo $heading; ?></h2>
            <?php endif; ?>
            <?php the_sub_field('text'); ?>
            <div class="form__alert-zone"></div>
        </div>
    </div>
    <div class="r">
        <div class="c-md-6">
            <div class="input input--required">
                <label class="label sr-only">First Name</label>
                <input type="text" name="first_name" value="" placeholder="First Name *" >
                <div class="input-message"></div>
            </div>
        </div>
        <div class="c-md-6">
            <div class="input input--required">
                <label class="label sr-only">Last Name</label>
                <input type="text" name="last_name" value="" placeholder="Last Name *" >
                <div class="input-message"></div>
            </div>
        </div>
    </div>
    <div class="r">
        <div class="c-md-6">
            <div class="input input--required">
                <input type="email" name="email" placeholder="Email *" id="contact_email" />
                <div class="input-message"></div>
            </div>
        </div>
        <div class="c-md-6">
            <div class="input">
                <input type="text" name="phone" placeholder="Phone" id="contact_phone" />
                <div class="input-message"></div>
            </div>
        </div>
        <div class="c-md-12">
            <div class="input input--required">
                <label class="label--textarea" for="contact_message">Message</label>
                <textarea name="message" id="contact_message"></textarea>
                <div class="input-message"></div>
            </div>
        </div>
    </div>
    <div class="r">
        <div class="c-md-12">
            <div class="input checkbox">
                <input type="checkbox" id="contact_newsletter" name="newsletter" /><label for="contact_newsletter">I would also like to sign up to the <?php echo get_bloginfo('name'); ?> newsletter.<br><small>You can unsubscribe at any time by clicking the 'unsubscribe' link in any newsletter you receive from us, or by contacting us.</small></label>
                <div class="input-message"></div>
            </div>
            <div class="input input--required checkbox">
                <input type="checkbox" id="contact_consent" name="consent" /><label for="contact_consent">I consent to <?php echo get_bloginfo('name'); ?> processing the data submitted on this form in accordance with their <a target="_blank" href="<?php the_permalink(get_option('wp_page_for_privacy_policy')); ?>">privacy policy</a>.</label>
                <div class="input-message"></div>
            </div>
        </div>
    </div>

    <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>" />

    <button class="button button--alt" type="submit">Submit</button>

</form>
