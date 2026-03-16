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
    wp_enqueue_style('paginarg-store-style', get_stylesheet_uri(), array('paginarg-store-fonts'), PAGINARG_STORE_VERSION);
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
    if (!taxonomy_exists('product_cat')) {
        return paginarg_store_shop_url();
    }

    $term = get_term_by('slug', $slug, 'product_cat');

    if ($term && !is_wp_error($term)) {
        $link = get_term_link($term, 'product_cat');
        if (!is_wp_error($link)) {
            return $link;
        }
    }

    return paginarg_store_shop_url();
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
        echo '<div class="shop-side-card"><span class="section-tag">Store control</span><strong>Productos, stock, categorias y descuentos.</strong><p>Todo el contenido comercial se actualiza desde el panel de WooCommerce.</p></div>';
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
