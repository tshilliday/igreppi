<?php
$heading = get_sub_field('heading');
?>
<form class="form form--product-enquiry gp_form" name="product-enquiry">
    <div class="r">
        <div class="c-md-12">
            <?php if ($heading) : ?>
                <h2 class="h4"><?php echo $heading; ?></h2>
            <?php endif; ?>
            <?php the_sub_field('text'); ?>
            <div class="form__alert-zone"></div>
        </div>
    </div>
    <div class="box">
        <div class="r">

            <div class="c-md-12">
                <input type="hidden" name="source" value="<?php echo get_the_title(); ?>" />
            </div>

            <div class="c-md-6">
                <div class="input input--required">
                    <label class="label sr-only">First Name</label>
                    <input type="text" name="first_name" value="" placeholder="First Name *" >
                    <div class="input-message"></div>
                </div>
            </div>

            <div class="c-md-6">
                <div class="input input--required">
                    <label class="label sr-only">Last Name *</label>
                    <input type="text" name="last_name" value="" placeholder="Last Name *" >
                    <div class="input-message"></div>
                </div>
            </div>

            <div class="c-md-12">
                <div class="input input--required">
                    <label class="label sr-only">Email *</label>
                    <input type="email" name="email" value="" placeholder="Email *" >
                    <div class="input-message"></div>
                </div>
            </div>

            <div class="c-md-6">
                <div class="input input--required">
                    <label class="label sr-only">Contact Number *</label>
                    <input type="phone" name="phone" value="" placeholder="Contact Number *" >
                    <div class="input-message"></div>
                </div>
            </div>

            <div class="c-md-6">
                <div class="input">
                    <label class="label sr-only">Post Code</label>
                    <input type="text" name="post_code" value="" placeholder="Post Code" >
                    <div class="input-message"></div>
                </div>
            </div>

            <div class="c-md-12">
                <div class="input input--required">
                    <label class="label sr-only">Message</label>
                    <textarea name="message" rows="8" cols="80" placeholder="Message *"></textarea>
                    <div class="input-message"></div>
                </div>
            </div>

            <div class="c-md-12">
                <div class="input checkbox">
                    <input type="checkbox" id="product_enquiry_newsletter" name="newsletter" />
                    <label for="product_enquiry_newsletter">I would also like to sign up to the <?php echo get_bloginfo('name'); ?> newsletter.<br><small>You can unsubscribe at any time by clicking the 'unsubscribe' link in any newsletter you receive from us, or by contacting us.</small></label>
                    <div class="input-message"></div>
                </div>
                <div class="input input--required checkbox">
                    <input type="checkbox" id="product_enquiry_consent" name="consent" />
                    <label class="label" for="product_enquiry_consent">I have read and understood your <a target="_blank" href="<?php echo get_permalink(get_option('wp_page_for_privacy_policy')) ?>">Privacy Policy</a> and I consent to my details being stored by <?php echo get_bloginfo('name'); ?> for the purpose of this enquiry. *</label>
                    <div class="input-message"></div>
                </div>
            </div>

            <div class="c-md-12">
                <button class="button button--alt" type="submit">Submit</button>
            </div>

        </div>
    </div>
</form>
