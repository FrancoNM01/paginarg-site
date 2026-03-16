<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="section">
    <div class="container panel-shell">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <span class="section-tag"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></span>
            <h1 class="paginarg-store-archive-title"><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div>
</section>
<?php get_footer(); ?>
