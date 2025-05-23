<?php
    $enable_html = get_theme_mod('crt_manage_enable_html_section');
    $html_fullwidth = get_theme_mod('crt_manage_html_fullwidth');
    $content_html = get_theme_mod('crt_manage_html_content');
    if(!$enable_html) {
        return;
    }
?>
<section id="html-custom" class="html-custom position-relative">
    <?php crt_manage_section_link( 'HTML Custom' ); ?>
    <?php if(!$html_fullwidth): ?><div class="container">
        <div class="border-left-right p-lg-4 p-md-3 p-0 border-md-none border-sm-none">
        <div class="row"><div class="col-12 py-2"><?php endif; ?>
        <?php echo wp_kses_post($content_html); ?>
    <?php if(!$html_fullwidth): ?></div></div></div></div><?php endif; ?>
</section>
