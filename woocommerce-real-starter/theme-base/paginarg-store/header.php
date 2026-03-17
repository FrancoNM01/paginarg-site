<?php
if (!defined('ABSPATH')) {
    exit;
}

$contact_url = paginarg_store_page_url_by_slug(array('contacto', 'contact'), home_url('/contacto/'));
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header store-header">
    <div class="container utility-bar-store">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-lockup">
            <span class="brand-mark"><?php echo esc_html(substr(wp_strip_all_tags(get_bloginfo('name')), 0, 1)); ?></span>
            <span class="brand-text"><strong><?php bloginfo('name'); ?></strong><small>shopping</small></span>
        </a>

        <form role="search" method="get" class="utility-search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <span class="search-chip">Search</span>
            <label class="screen-reader-text" for="paginarg-search"><?php esc_html_e('Search', 'paginarg-store'); ?></label>
            <input id="paginarg-search" class="search-field" type="search" value="<?php echo esc_attr(get_search_query()); ?>" name="s" placeholder="Buscar productos, colecciones o marcas">
        </form>

        <div class="utility-icons">
            <a href="<?php echo esc_url(paginarg_store_shop_url()); ?>">Shop</a>
            <a href="<?php echo esc_url(paginarg_store_account_url()); ?>">Account</a>
            <a href="<?php echo esc_url($contact_url); ?>">Contact</a>
        </div>

        <div class="utility-currency">ARS</div>

        <div class="cart-panel">
            <a href="<?php echo esc_url(paginarg_store_cart_url()); ?>"><?php echo esc_html(sprintf('Shopping cart (%d)', paginarg_store_get_cart_count())); ?></a>
            <a href="<?php echo esc_url(paginarg_store_checkout_url()); ?>">Checkout</a>
        </div>
    </div>
    <div class="store-nav">
        <div class="container store-nav-inner-store">
            <a href="<?php echo esc_url(paginarg_store_shop_url()); ?>" class="category-trigger">Select category</a>
            <nav class="menu-links-store" aria-label="Principal">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <a href="<?php echo esc_url(paginarg_store_get_product_category_link('women')); ?>" class="<?php echo paginarg_store_is_current_category('women') ? 'is-active' : ''; ?>">Women</a>
                <a href="<?php echo esc_url(paginarg_store_get_product_category_link('men')); ?>" class="<?php echo paginarg_store_is_current_category('men') ? 'is-active' : ''; ?>">Men</a>
                <a href="<?php echo esc_url(paginarg_store_get_product_category_link('accessories')); ?>" class="<?php echo paginarg_store_is_current_category('accessories') ? 'is-active' : ''; ?>">Accessories</a>
                <a href="<?php echo esc_url($contact_url); ?>">Contact</a>
            </nav>
            <div class="account-links">
                <a href="<?php echo esc_url(paginarg_store_account_url()); ?>">Login</a>
                <span>-or-</span>
                <a href="<?php echo esc_url(paginarg_store_account_url()); ?>">Register</a>
            </div>
        </div>
    </div>
    <div class="announcement-bar">
        <div class="container announcement-inner">
            <strong>50%</strong>
            <span>off selected products</span>
            <em>New season</em>
        </div>
    </div>
</header>
<main class="site-main">
