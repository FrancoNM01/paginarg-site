<?php
if (!defined('ABSPATH')) {
    exit;
}

define('PAGINARG_STORE_VERSION', '1.0.0');

add_action('after_setup_theme', 'paginarg_store_setup');
function paginarg_store_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('custom-logo');
    add_theme_support('woocommerce');

    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'paginarg-store'),
        )
    );
}

add_action('wp_enqueue_scripts', 'paginarg_store_enqueue_assets');
function paginarg_store_enqueue_assets() {
    wp_enqueue_style('paginarg-store-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap', array(), null);
    wp_enqueue_style('paginarg-store-style', get_stylesheet_uri(), array('paginarg-store-fonts'), filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('paginarg-store-theme', get_stylesheet_directory_uri() . '/theme.js', array(), filemtime(get_stylesheet_directory() . '/theme.js'), true);
}

function paginarg_store_shop_url() {
    return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
}

function paginarg_store_cart_url() {
    return function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');
}

function paginarg_store_checkout_url() {
    return function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/');
}

function paginarg_store_account_url() {
    return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url();
}

function paginarg_store_page_url_by_slug($slugs, $fallback = '') {
    foreach ((array) $slugs as $slug) {
        $page = get_page_by_path($slug);
        if ($page instanceof WP_Post) {
            return get_permalink($page);
        }
    }

    return $fallback ? $fallback : home_url('/');
}

function paginarg_store_get_product_category_link($slug) {
    $shop_url = paginarg_store_shop_url();

    if (!taxonomy_exists('product_cat')) {
        return $shop_url;
    }

    $term = get_term_by('slug', $slug, 'product_cat');
    if (!$term || is_wp_error($term)) {
        return $shop_url;
    }

    return add_query_arg('product_cat', $slug, $shop_url);
}

function paginarg_store_is_current_category($slug) {
    if (is_tax('product_cat', $slug)) {
        return true;
    }

    $current = get_query_var('product_cat');
    return is_string($current) && $current === $slug;
}


function paginarg_store_get_empty_cart_url() {
    return wp_nonce_url(add_query_arg('empty-cart', '1', paginarg_store_cart_url()), 'paginarg_empty_cart');
}

add_action('template_redirect', 'paginarg_store_handle_empty_cart');
function paginarg_store_handle_empty_cart() {
    if (is_admin() || !isset($_GET['empty-cart']) || '1' !== $_GET['empty-cart']) {
        return;
    }

    if (!function_exists('WC') || !WC()->cart) {
        return;
    }

    if (!isset($_GET['_wpnonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_GET['_wpnonce'])), 'paginarg_empty_cart')) {
        return;
    }

    WC()->cart->empty_cart();
    wp_safe_redirect(paginarg_store_cart_url());
    exit;
}

function paginarg_store_get_cart_count() {
    if (function_exists('WC') && WC()->cart) {
        return (int) WC()->cart->get_cart_contents_count();
    }

    return 0;
}

add_action('init', 'paginarg_store_woocommerce_hooks');
function paginarg_store_woocommerce_hooks() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    add_action('woocommerce_before_main_content', 'paginarg_store_open_woocommerce_shell', 5);
    add_action('woocommerce_after_main_content', 'paginarg_store_close_woocommerce_shell', 50);
}

function paginarg_store_open_woocommerce_shell() {
    if (is_shop() || is_product_taxonomy()) {
        $title = woocommerce_page_title(false);
        if (!$title) {
            $title = __('Shop the collection.', 'paginarg-store');
        }

        echo '<section class="shop-hero">';
        echo '<div class="container shop-hero-shell">';
        echo '<div><p class="eyebrow">Catalog overview</p><h1>' . esc_html($title) . '</h1><p class="lead">Grilla limpia, foco en imagen y una estructura pensada para que el cliente cargue productos y promociones desde WooCommerce.</p></div>';
        echo '<div class="shop-side-card"><span class="section-tag">Store control</span><strong>Productos, stock, categorías y descuentos.</strong><p>Todo el contenido comercial se actualiza desde el panel de WooCommerce.</p></div>';
        echo '</div>';
        echo '</section>';
        echo '<section class="section shop-shell"><div class="container">';
        paginarg_store_render_category_pills();
        return;
    }

    echo '<section class="section commerce-shell"><div class="container">';
}

function paginarg_store_close_woocommerce_shell() {
    echo '</div></section>';
}

add_filter('loop_shop_columns', 'paginarg_store_loop_shop_columns');
function paginarg_store_loop_shop_columns() {
    return 4;
}

add_filter('loop_shop_per_page', 'paginarg_store_loop_shop_per_page', 20);
function paginarg_store_loop_shop_per_page() {
    if (is_tax('product_cat')) {
        return 10;
    }

    return 12;
}

function paginarg_store_render_category_pills() {
    $items = array(
        'women' => 'Women',
        'men' => 'Men',
        'accessories' => 'Accessories',
        'new-arrivals' => 'New arrivals',
    );

    if (!taxonomy_exists('product_cat')) {
        return;
    }

    echo '<div class="filter-pills">';
    foreach ($items as $slug => $label) {
        $link = paginarg_store_get_product_category_link($slug);
        $classes = '';
        if (is_tax('product_cat', $slug)) {
            $classes = ' class="is-current"';
        }
        echo '<a href="' . esc_url($link) . '"' . $classes . '>' . esc_html($label) . '</a>';
    }
    echo '</div>';
}

function paginarg_store_product_visuals() {
    return array(
        'fallback' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1200&q=80',
        'categories' => array(
            'women' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=1200&q=80',
            'men' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80',
            'accessories' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=1200&q=80',
            'new-arrivals' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1200&q=80',
        ),
        'products' => array(
            'striped-knit' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1200&q=80',
            'soft-jacket' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80',
            'classic-watch' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=1200&q=80',
            'summer-set' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=1200&q=80',
            'linen-dress' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1200&q=80',
            'studio-blazer' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1200&q=80',
            'leather-tote' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=1200&q=80',
            'gold-hoops' => 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?auto=format&fit=crop&w=1200&q=80',
            'weekend-shirt' => 'https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=1200&q=80',
            'city-sneakers' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80',
            'drop-bomber' => 'https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=1200&q=80',
            'resort-knit' => 'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?auto=format&fit=crop&w=1200&q=80',
            'atelier-trench' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1200&q=80',
            'silk-outline' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1200&q=80',
            'gallery-heels' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80',
            'city-pleats' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=1200&q=80',
            'soft-cardigan' => 'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?auto=format&fit=crop&w=1200&q=80',
            'editor-shirt' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=1200&q=80',
            'evening-coat' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=1200&q=80',
            'tailored-coat' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80',
            'metro-knit' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1200&q=80',
            'essential-denim' => 'https://images.unsplash.com/photo-1516826957135-700dedea698c?auto=format&fit=crop&w=1200&q=80',
            'business-polo' => 'https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=1200&q=80',
            'night-loafer' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80',
            'urban-parka' => 'https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=1200&q=80',
            'daily-overshirt' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=1200&q=80',
            'sculpt-ring' => 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?auto=format&fit=crop&w=1200&q=80',
            'weekend-duffle' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=1200&q=80',
            'signature-belt' => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=1200&q=80',
            'prism-sunglasses' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=1200&q=80',
            'studio-wallet' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&w=1200&q=80',
            'pearl-chain' => 'https://images.unsplash.com/photo-1611652022419-a9419f74343d?auto=format&fit=crop&w=1200&q=80',
            'leather-case' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=1200&q=80',
            'mono-set' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1200&q=80',
            'aero-runner' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80',
            'crop-knit' => 'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?auto=format&fit=crop&w=1200&q=80',
            'quilted-vest' => 'https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=1200&q=80',
            'slate-hoodie' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=1200&q=80',
            'city-tote' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=1200&q=80',
            'flare-shirt' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=1200&q=80',
        ),
    );
}

function paginarg_store_get_product_primary_category($product = null) {
    $product = wc_get_product($product);
    if (!$product) {
        return null;
    }

    $terms = wc_get_product_terms($product->get_id(), 'product_cat', array('orderby' => 'parent', 'order' => 'ASC'));
    if (empty($terms) || is_wp_error($terms)) {
        return null;
    }

    foreach ($terms as $term) {
        if ('sin-categorizar' !== $term->slug) {
            return $term;
        }
    }

    return $terms[0];
}

function paginarg_store_get_product_image_url($product = null) {
    $product = wc_get_product($product);
    $visuals = paginarg_store_product_visuals();

    if (!$product) {
        return $visuals['fallback'];
    }

    if ($product->get_image_id()) {
        $src = wp_get_attachment_image_url($product->get_image_id(), 'woocommerce_single');
        if ($src) {
            return $src;
        }
    }

    $slug = $product->get_slug();
    if (!empty($visuals['products'][$slug])) {
        return $visuals['products'][$slug];
    }

    $term = paginarg_store_get_product_primary_category($product);
    if ($term && !empty($visuals['categories'][$term->slug])) {
        return $visuals['categories'][$term->slug];
    }

    return $visuals['fallback'];
}

function paginarg_store_get_product_kicker($product = null) {
    $term = paginarg_store_get_product_primary_category($product);
    return $term ? $term->name : __('Store', 'paginarg-store');
}

add_filter('woocommerce_placeholder_img_src', 'paginarg_store_placeholder_img_src');
function paginarg_store_placeholder_img_src($src) {
    return paginarg_store_product_visuals()['fallback'];
}

function paginarg_store_get_archive_visual_url() {
    $visuals = paginarg_store_product_visuals();
    if (is_tax('product_cat')) {
        $term = get_queried_object();
        if ($term && !empty($visuals['categories'][$term->slug])) {
            return $visuals['categories'][$term->slug];
        }
    }
    return $visuals['fallback'];
}
