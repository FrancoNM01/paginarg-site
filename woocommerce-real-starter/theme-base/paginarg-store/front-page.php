<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$contact_url = paginarg_store_page_url_by_slug(array('contacto', 'contact'), paginarg_store_account_url());
?>
<section class="hero-campaign">
    <div class="container hero-campaign-grid">
        <div class="campaign-copy">
            <p class="eyebrow">Summer collection</p>
            <h1>Summer collections built to sell better online.</h1>
            <div class="hero-tagline">Coolest collection of the season is here</div>
            <p class="lead">Una home ecommerce con visual de campana, foco en colecciones, banners promocionales y una estructura lista para WooCommerce, stock, cupones y pagos.</p>
            <div class="hero-actions">
                <a href="<?php echo esc_url(paginarg_store_get_product_category_link('women')); ?>" class="button">Go to collection</a>
                <a href="<?php echo esc_url($contact_url); ?>" class="button-secondary">Gestion WooCommerce</a>
            </div>
        </div>
        <div class="campaign-visual">
            <div class="hero-model"></div>
        </div>
    </div>
</section>

<section class="promo-strip-section">
    <div class="container promo-strip">
        <article class="promo-tile promo-tile-one"><span>Summer</span><strong>Collection offer</strong><a href="<?php echo esc_url(paginarg_store_get_product_category_link('women')); ?>">Go to collection</a></article>
        <article class="promo-tile promo-tile-two"><span>Watch edit</span><strong>Accessories</strong><a href="<?php echo esc_url(paginarg_store_get_product_category_link('accessories')); ?>">View edit</a></article>
        <article class="promo-tile promo-tile-three"><span>Fashion</span><strong>Minimal release</strong><a href="<?php echo esc_url(paginarg_store_get_product_category_link('new-arrivals')); ?>">Shop now</a></article>
    </div>
</section>

<section class="section">
    <div class="container section-heading"><span class="section-tag">Shop by category</span><h2>Una tienda pensada para vender con una estructura visual clara.</h2><p>La marca puede destacar colecciones, empujar promociones y ordenar productos desde WooCommerce sin perder coherencia visual.</p></div>
    <div class="container category-grid">
        <article class="category-card category-card-one"><a href="<?php echo esc_url(paginarg_store_get_product_category_link('women')); ?>" class="category-link"><div class="category-copy"><span>Women</span><h3>Editorial looks</h3></div></a></article>
        <article class="category-card category-card-two"><a href="<?php echo esc_url(paginarg_store_get_product_category_link('men')); ?>" class="category-link"><div class="category-copy"><span>Men</span><h3>Daily essentials</h3></div></a></article>
        <article class="category-card category-card-three"><a href="<?php echo esc_url(paginarg_store_get_product_category_link('accessories')); ?>" class="category-link"><div class="category-copy"><span>Accessories</span><h3>Small upgrades</h3></div></a></article>
        <article class="category-card category-card-four"><a href="<?php echo esc_url(paginarg_store_get_product_category_link('new-arrivals')); ?>" class="category-link"><div class="category-copy"><span>New arrivals</span><h3>Fresh campaign</h3></div></a></article>
    </div>
</section>

<section class="section section-ink">
    <div class="container feature-band">
        <article class="feature-band-card"><strong>WooCommerce</strong><span>Productos, stock, talles y precios administrables.</span></article>
        <article class="feature-band-card"><strong>Promos</strong><span>Banners, cupones y ofertas visibles dentro del recorrido.</span></article>
        <article class="feature-band-card"><strong>Conversion</strong><span>Hero de campana, categorias, destacados y CTA comerciales.</span></article>
    </div>
</section>

<section class="section">
    <div class="container cta-panel"><span class="section-tag">Siguiente paso</span><h2>Explora el catalogo real y revisa como se muestra la parte operativa para el cliente.</h2><div class="hero-actions"><a href="<?php echo esc_url(paginarg_store_shop_url()); ?>" class="button">Ver catalogo</a><a href="<?php echo esc_url(paginarg_store_account_url()); ?>" class="button-secondary">Ver gestion</a></div></div>
</section>
<?php get_footer(); ?>
