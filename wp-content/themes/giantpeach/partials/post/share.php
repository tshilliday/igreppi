<div class="c">
    <div class="r">
        <div class="c-md-10 l-c-md-o-1">
            <div class="share__container">
                <?php
                $encodedUrl = urlencode(get_the_permalink());
                $encodedTitle = urlencode(get_the_title() . ' on ' . get_bloginfo('name') );
                ?>

                <h4 class="small-caps share__heading">Share</h4>

                <ul class="share">

                    <li><a target="_blank" rel="noopener" data-pin-do="buttonPin" data-pin-tall="true" data-pin-round="true" href="https://www.pinterest.com/pin/create/button/?url=<?php echo $encodedUrl; ?>">
                        <i class="fab fa-pinterest"></i>
                    </a></li>

                    <li><a class="share__icon facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $encodedUrl; ?>" rel="noopener" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a></li>

                    <li><a class="share__icon twitter" href="https://twitter.com/intent/tweet?url=<?php echo $encodedUrl; ?>&text=<?php echo $encodedTitle; ?>&hashtags=" rel="noopener" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a></li>

                    <li><a class="share__icon email" href="mailto:?subject=<?php echo $encodedTitle; ?>&body=<?php echo $encodedUrl; ?>" rel="noopener" target="_blank">
                        <i class="fas fa-envelope"></i>
                    </a></li>
                </ul>

            </div>
        </div>
    </div>
</div>