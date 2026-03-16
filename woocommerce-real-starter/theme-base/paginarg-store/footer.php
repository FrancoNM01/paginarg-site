<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
</main>
<footer class="site-footer">
    <div class="container footer-copy">
        <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. Base WooCommerce inspirada en la demo de PAGINARG.
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
