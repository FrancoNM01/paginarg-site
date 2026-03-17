<?php
if (!defined('ABSPATH')) {
    exit;
}

global $product;

$image_url = paginarg_store_get_product_image_url($product);
$wrapper_classes = array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--with-images',
    'images',
    'paginarg-single-gallery',
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>">
    <div class="woocommerce-product-gallery__wrapper paginarg-single-gallery__wrapper">
        <div class="woocommerce-product-gallery__image paginarg-single-gallery__image">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($product ? $product->get_name() : 'Producto'); ?>">
        </div>
    </div>
</div>
