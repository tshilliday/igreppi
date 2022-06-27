<?php

$heading = get_sub_field('heading');

$telephone = get_field('telephone', 'contact-details');
$email = get_field('email', 'contact-details');
$address = get_field('address', 'contact-details');

?>

<div class="content-block content-block--talk-to-us">

    <div class="c">
        <div class="r">
            <div class="c-md-8">
                <h3 class="content-block__heading"><?php echo $heading; ?></h3>
            </div>
        </div>
        <div class="r">
            <?php if ($email || $telephone) : ?>
                <div class="c-md-3 c-equal-height">
                    <ul class="talk-to-us__links">
                        <?php if ($email) : ?>
                            <li class="email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                        <?php endif; ?>
                        <?php if (!empty($telephone)) : ?>
                            <?php foreach ($telephone as $row) : ?>
                                <li class="telephone"><a href="tel:<?php echo $row['number']; ?>"><?php echo $row['number']; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($address) : ?>
                <div class="c-md-3 c-equal-height c-vertical-center moveit" data-moveit-speed="5" data-moveit-mode="before-scroll">
                    <address>
                        <?php the_field('address', 'contact-details'); ?>
                    </address>
                </div>
            <?php endif; ?>
            <div class="c-md-5 l-c-md-o-1 c-equal-height c-vertical-center moveit" data-moveit-speed="2.5" data-moveit-mode="before-scroll" style="position: relative">
                <div class="talk-to-us__social">
                    <span class="small-caps">Join our World</span>
                    <ul class="share social--talk-to-us">
                        <?php if (function_exists('get_field')) : ?>
                            <?php if (get_field('facebook_url', 'contact-details')) : ?>
                                <li class="share__icon">
                                    <a target="_blank" href="<?php the_field('facebook_url', 'contact-details') ?>" title="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (get_field('instagram_url', 'contact-details')) : ?>
                                <li class="share__icon">
                                    <a target="_blank" href="<?php the_field('instagram_url', 'contact-details') ?>" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (get_field('twitter_url', 'contact-details')) : ?>
                                <li class="share__icon">
                                    <a target="_blank" href="<?php the_field('twitter_url', 'contact-details') ?>" title="Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (get_field('youtube_url', 'contact-details')) : ?>
                                <li class="share__icon">
                                    <a target="_blank" href="<?php the_field('youtube_url', 'contact-details') ?>" title="YouTube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>