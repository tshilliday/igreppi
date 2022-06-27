<?php get_header(); ?>

    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
            <?php get_template_part('partials/content', 'banner'); ?>

            <div class="c">

                    <div class="r">
                        <div class="c-md-12">

                            <?php the_content(); ?>
                        </div>
                    </div>

            </div>

            <?php get_template_part('partials/content-blocks/render'); ?>

            <div class="c">
                <div class="r">
                    <div class="c-md-12">

                            <!--Headings-->
                            <h1>Heading 1</h1>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <h2>Heading 2</h2>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <h3>Heading 3</h3>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <h4>Heading 4</h4>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <h5>Heading 5</h5>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <p>ed ut perspiciatis <a href="#">unde omnis</a> iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <p><a href="">ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas</a> sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <blockquote>
                            <p>As my fellow HTML5 Doctor, Oli Studholme has showed, people seldom quote exactly
                            – so sacrosanctity of the quoted text isn’t a useful ideal – and in print etc,
                            citations almost always appear as part of the quotation – it’s highly conventional.</p>
                            <footer>
                            — <cite><a href="http://www.brucelawson.co.uk/2013/on-citing-quotations-again/">Bruce Lawson</a></cite>
                            </footer>
                            </blockquote>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <ul>
                                <li>List item</li>
                                <li>List item
                                <ul>
                                    <li>List item</li>
                                    <li>List item</li>
                                    <li>List item</li>
                                </ul>
                                </li>
                                <li>List item</li>
                            </ul>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <ol>
                                <li>List item</li>
                                <li>List item</li>
                                <li>List item</li>
                            </ol>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <!--Form-->
                            <form>
                                <input type="text" />
                                <select>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                                <div class="r">
                                    <div class="c-md-12">
                                        <div class="input input--required checkbox">
                                            <input name="radio" id="radio" type="radio" class="checkbox--alt" />
                                            <label class="label" for="radio">I have read and understood your <a target="_blank" href="<?php echo get_permalink(get_option('wp_page_for_privacy_policy')) ?>">Privacy Policy</a> and I consent to my details being stored by <?php echo get_bloginfo('name'); ?> for the purpose of this enquiry. *</label>
                                            <div class="input-message"></div>
                                        </div>
                                    </div>

                                    <div class="c-md-12">
                                        <div class="input checkbox">
                                            <input name="newsletter" id="newsletter" type="checkbox" class="checkbox--alt" />
                                            <label class="label" for="newsletter">I would also like to sign up to the <?php echo get_bloginfo('name'); ?> newsletter.</label>
                                            <div class="input-message"></div>
                                        </div>
                                    </div>
                                </div>
                                <button>Button</button>
                                <a href="" class="button button--alt">Button Alt</a>
                                <a href="" class="button waiting">Button Waiting</a>
                                <a href="" class="button button--alt waiting">Button Alt Waiting</a>
                            </form>
                            <p>ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <!--Tables-->
                            <table>
                                <thead>
                                    <tr>
                                        <th>Header</th>
                                        <th>Header</th>
                                        <th>Header</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Cell</td>
                                        <td>Cell</td>
                                        <td>Cell</td>
                                    </tr>
                                    <tr>
                                        <td>Cell</td>
                                        <td>Cell</td>
                                        <td>Cell</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Footer</td>
                                        <td>Footer</td>
                                        <td>Footer</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <a href="#" class="button overlay__button" data-target="#sample-overlay">Open Overlay</a>
                    </div>
                </div>
            </div>

            <div class="overlay" id="sample-overlay">
                <div class="overlay__inner">
                    <div class="overlay__close"></div>
                    <div class="overlay__content">
                        <h3>Overlay title</h3>
                        <p>Overlay content</a>
                    </div>
                </div>
            </div

            <?php
        }
    }
    ?>
<?php get_footer(); ?>
