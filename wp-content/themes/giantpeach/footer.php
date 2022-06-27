                <?php

                $sidenav = get_sidenav_links(); ?>
                <?php if (!empty($sidenav)) : ?>
                    <nav class="sidenav">
                        <ul>
                            <?php if (!empty($sidenav['prev'])) : ?>
                                <li class="sidenav__item sidenav__item--prev">
                                    <a class="transition-link transition-link--prev ajax" href="<?php echo $sidenav['prev']->url; ?>"><?php echo $sidenav['prev']->title; ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($sidenav['next'])) : ?>
                                <li class="sidenav__item sidenav__item--next">
                                    <a class="transition-link transition-link--next ajax" href="<?php echo $sidenav['next']->url; ?>"><?php echo $sidenav['next']->title; ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            </div><!--.wrapper-->

            <?php wp_footer(); ?>

            <footer class="footer">

                <div class="c">
                    <div class="r">
                        <div class="c-md-12">

                            <div class="footer__inner">

                                <div class="footer__copyright">
                                    <p><?php echo date('Y'); ?> &copy; <?php the_field('footer_copyright_text', 'website-settings'); ?></p>
                                </div>

                                <div class="footer__social">

                                    <ul class="social">

                                        <?php if (function_exists('get_field')) : ?>
                                            <?php if (get_field('facebook_url', 'contact-details')) : ?>
                                                <li class="social__icon">
                                                    <a target="_blank" href="<?php the_field('facebook_url', 'contact-details') ?>" title="Facebook">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (get_field('instagram_url', 'contact-details')) : ?>
                                                <li class="social__icon">
                                                    <a target="_blank" href="<?php the_field('instagram_url', 'contact-details') ?>" title="Instagram">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (get_field('twitter_url', 'contact-details')) : ?>
                                                <li class="social__icon">
                                                    <a target="_blank" href="<?php the_field('twitter_url', 'contact-details') ?>" title="Twitter">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (get_field('youtube_url', 'contact-details')) : ?>
                                                <li class="social__icon">
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

            </footer>

        </div>

        <?php get_template_part('partials/flood/flood'); ?>

    </body>
</html>
