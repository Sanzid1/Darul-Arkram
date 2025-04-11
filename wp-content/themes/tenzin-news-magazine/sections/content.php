<?php
    $enable_shortcode = get_theme_mod('crt_manage_enable_content_section');
    if(!$enable_shortcode) {
        return;
    }
?>
<section id="content" class="position-relative">
    <?php crt_manage_section_link( 'Content' ); ?>
    <div class="container ">
        <div class="border-left-right p-lg-4 p-md-3 p-0 pb-lg-5 border-md-none border-sm-none">
            <div class="row">
                <div class="col-12 py-4">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
