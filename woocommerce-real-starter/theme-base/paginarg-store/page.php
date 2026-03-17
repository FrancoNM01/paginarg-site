<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="section">
    <div class="container panel-shell<?php echo is_page(array('contacto', 'contact')) ? ' contact-shell' : ''; ?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if (is_page(array('contacto', 'contact'))) : ?>
                <span class="section-tag">Contacto</span>
                <h1 class="paginarg-store-archive-title"><?php the_title(); ?></h1>
                <p class="lead contact-intro">Un punto de contacto claro para resolver consultas comerciales, coordinar lanzamientos y acompañar la gestión de la tienda.</p>
                <div class="contact-grid">
                    <article class="contact-card">
                        <span class="mini-label">Canal directo</span>
                        <h3>WhatsApp comercial</h3>
                        <p>Atención rápida para resolver consultas, lanzamientos de productos, promociones y soporte operativo.</p>
                        <a class="button" href="https://wa.me/5491100000000" target="_blank" rel="noreferrer">Abrir WhatsApp</a>
                    </article>
                    <article class="contact-card">
                        <span class="mini-label">Email</span>
                        <h3>Equipo de tienda</h3>
                        <p>Ideal para pedidos, cambios de catálogo, coordinación de campañas y seguimiento de integraciones.</p>
                        <a class="button-secondary" href="mailto:hola@paginarg.com">hola@paginarg.com</a>
                    </article>
                    <article class="contact-card">
                        <span class="mini-label">Horario</span>
                        <h3>Respuesta organizada</h3>
                        <p>Lunes a viernes de 9 a 18 hs. También podés dejar una consulta y responderemos a la brevedad.</p>
                        <div class="contact-meta">Soporte comercial y técnico para la demo WooCommerce.</div>
                    </article>
                </div>
                <div class="contact-strip">
                    <div>
                        <strong>¿Qué podés consultar?</strong>
                        <p>Medios de pago, carga de productos, campañas, stock, cupones, envíos y mejoras visuales de la tienda.</p>
                    </div>
                    <div class="hero-actions">
                        <a class="button" href="<?php echo esc_url(paginarg_store_shop_url()); ?>">Ver catálogo</a>
                        <a class="button-secondary" href="<?php echo esc_url(paginarg_store_account_url()); ?>">Ir a gestión</a>
                    </div>
                </div>
            <?php else : ?>
                <span class="section-tag"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></span>
                <h1 class="paginarg-store-archive-title"><?php the_title(); ?></h1>
                <?php if (function_exists('is_cart') && is_cart() && function_exists('WC') && WC()->cart && WC()->cart->get_cart_contents_count() > 0) : ?>
                    <div class="cart-tools">
                        <p>Gestioná tu compra desde acá y limpiá el carrito si querés volver a empezar.</p>
                        <a class="button-secondary cart-empty-button" href="<?php echo esc_url(paginarg_store_get_empty_cart_url()); ?>">Vaciar carrito</a>
                    </div>
                <?php endif; ?>
                <?php the_content(); ?>
            <?php endif; ?>
        <?php endwhile; endif; ?>
    </div>
</section>
<?php get_footer(); ?>
