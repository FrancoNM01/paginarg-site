<?php
if (!defined('ABSPATH')) {
    exit;
}

global $product;

if (empty($product) || !$product->is_visible()) {
    return;
}

$image_url = paginarg_store_get_product_image_url($product);
$kicker = paginarg_store_get_product_kicker($product);
$excerpt = $product->get_short_description();
if (!$excerpt) {
    $excerpt = $product->get_description();
}
$excerpt = wp_trim_words(wp_strip_all_tags($excerpt), 18);
?>
<li <?php wc_product_class('paginarg-loop-item', $product); ?>>
    <a class="paginarg-product-link" href="<?php the_permalink(); ?>">
        <div class="paginarg-product-media" style="background-image: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(0,0,0,0.08)), url('<?php echo esc_url($image_url); ?>');">
            <?php if ($product->is_on_sale()) : ?>
                <span class="paginarg-badge"><?php esc_html_e('Oferta', 'paginarg-store'); ?></span>
            <?php endif; ?>
        </div>
        <div class="paginarg-product-copy">
            <span class="mini-label"><?php echo esc_html($kicker); ?></span>
            <h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
            <?php if ($excerpt) : ?>
                <p class="paginarg-product-excerpt"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>
            <div class="paginarg-product-footer">
                <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                <span class="paginarg-product-view"><?php esc_html_e('Ver producto', 'paginarg-store'); ?></span>
            </div>
        </div>
    </a>
    <div class="paginarg-loop-actions">
        <?php woocommerce_template_loop_add_to_cart(); ?>
    </div>
</li>
