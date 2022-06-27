<?php
    $current_cat = 'All';

    $terms = get_terms('category', array(
        'hide_empty' => true
    ));

    if (is_category()) {
        $current_cat = get_queried_object()->name;
    }
?>

<?php if ($terms) : ?>
    <div class="r">
        <div class="c-md-12">
            <div class="post__cats--list">
                <ul>
                    <li>
                        <a class="post__cat-link <?php if ($current_cat == 'All') :?>active<?php endif;?>" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">All</a>
                    </li>
                    <?php foreach ($terms as $term) : ?>
                        <li>
                            <a class="post__cat-link <?php if ($current_cat == $term->name) :?>active<?php endif;?>" href="<?php echo get_category_link($term); ?>"><?php echo $term->name;?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
<?php endif;?>