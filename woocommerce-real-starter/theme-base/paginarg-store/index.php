<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="section">
    <div class="container panel-shell">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <span class="section-tag">Journal</span>
            <h1 class="paginarg-store-archive-title"><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; else : ?>
            <h1 class="paginarg-store-archive-title">No posts yet.</h1>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
