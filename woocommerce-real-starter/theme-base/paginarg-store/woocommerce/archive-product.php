<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header('shop');

$title = woocommerce_page_title(false);
$description = '';
if (is_tax('product_cat')) {
    $term = get_queried_object();
    if ($term && !empty($term->description)) {
        $description = $term->description;
    }
} else {
    $description = 'Explora una selección visual cuidada, con productos reales, categorías claras y una estética comercial más elegante.';
}
$visual = paginarg_store_get_archive_visual_url();
?>
<section class="shop-hero shop-hero-premium">
    <div class="container shop-hero-shell shop-hero-shell-premium">
        <div class="shop-hero-copy">
            <p class="eyebrow"><?php echo is_tax('product_cat') ? 'Category spotlight' : 'Catalog overview'; ?></p>
            <h1><?php echo esc_html($title); ?></h1>
            <p class="lead"><?php echo esc_html($description); ?></p>
        </div>
        <div class="shop-side-card shop-side-card-visual" style="background-image: linear-gradient(180deg, rgba(12,12,12,0.10), rgba(12,12,12,0.42)), url('<?php echo esc_url($visual); ?>');">
            <div class="shop-side-card-copy">
                <span class="section-tag">Store edit</span>
                <strong>Productos, stock y categorías con una presencia más editorial.</strong>
                <p>El catálogo se actualiza desde WooCommerce, pero mantiene una estética mucho más cuidada.</p>
            </div>
        </div>
    </div>
</section>

<section class="section shop-shell shop-shell-premium">
    <div class="container">
        <?php paginarg_store_render_category_pills(); ?>

        <?php if (woocommerce_product_loop()) : ?>
            <div class="paginarg-shop-toolbar">
                <div class="paginarg-shop-toolbar-copy">
                    <?php woocommerce_result_count(); ?>
                </div>
                <div class="paginarg-shop-toolbar-sort">
                    <?php woocommerce_catalog_ordering(); ?>
                </div>
            </div>

            <?php woocommerce_product_loop_start(); ?>

            <?php while (have_posts()) : the_post(); ?>
                <?php wc_get_template_part('content', 'product'); ?>
            <?php endwhile; ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php do_action('woocommerce_after_shop_loop'); ?>
        <?php else : ?>
            <?php do_action('woocommerce_no_products_found'); ?>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer('shop');
