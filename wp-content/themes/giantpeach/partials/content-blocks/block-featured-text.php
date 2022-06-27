<?php
$text = get_sub_field('text');
$source = get_sub_field('source');
$align = get_sub_field('align');

switch ($align) {
    case 'left':
        $col_class = 'fromLeft l-c-md-o-1 c-md-7';
        break;
    case 'right':
        $col_class = 'fromRight c-md-7 l-c-md-o-3';
        break;
    case 'center':
    default:
        $col_class = 'fromBottom c-md-8 l-c-md-o-2';
        break;
}

?>

<section class="content-block content-block--featured-text text--<?php echo $align ?> scroll-trigger">
    <div class="c">
        <div class="r">
            <div class="<?php echo $col_class; ?>">
                <blockquote>
                    <p><?php echo $text; ?></p>
                    <?php if ($source) : ?>
                        <footer>
                        — <cite><?php echo $source ?></cite>
                        </footer>
                    <?php endif; ?>
                </blockquote>
            </div>
        </div>
    </div>
</section>
