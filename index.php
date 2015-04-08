<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package DocPress
 */

get_header(); ?>



<div class="container-fluid main-container">
    <div class="row">

        <div class="col-lg-3 col-md-3 col-sm-4 sidebar-wrapper">
            <div class="sidebar-inner-wrapper">

                <div class="title-area">
                    <a href="/"><h1 class="site-title"><?php bloginfo('name'); ?></h1></a>
                    <p class="site-description"><?php bloginfo('description'); ?></p>
                </div>

                <?php get_sidebar(); ?>


            </div><!-- inner wrapper -->
        </div><!-- sidebar wrapper -->


        <div class="col-lg-9 col-md-8 col-sm-7">

            <main class="page-content"  role="main">

            <?php

                /**
                 *
                 * Loop for articles
                 *
                 * Order ASC is required coz it helps keep the first slide at the beginning.
                 *
                 * @since 1.0.0
                 */

                $dp_loop_articles = new WP_Query('order=ASC&posts_per_page=-1');

                while ( $dp_loop_articles->have_posts() ) : $dp_loop_articles->the_post();
             ?>


                <article class="hentry" id="dp_<?php the_id(); ?>">
                    <div class="entry-content">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <p><?php the_content(); ?> </p>

                    </div>
                </article>

            <?php endwhile; ?>

            </main>
        </div>

    </div>
</div><!-- site container end -->


<?php get_footer(); ?>