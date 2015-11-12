<?php
$azera_shop_shortcodes_section = get_theme_mod('azera_shop_shortcodes_settings');
$azera_shop_shortcodes_section_decoded = json_decode($azera_shop_shortcodes_section);
if(!empty($azera_shop_shortcodes_section) && (!empty($azera_shop_shortcodes_section_decoded[0]->title) || !empty($azera_shop_shortcodes_section_decoded[0]->subtitle) || !empty($azera_shop_shortcodes_section_decoded[0]->shortcode))){

    foreach($azera_shop_shortcodes_section_decoded as $section){
        ?>
        <section class="shortcodes" role="region" aria-label="<?php esc_html_e('Shortcodes','azera-shop'); ?>">
            <div class="section-overlay-layer">
                <div class="container">

                    <div class="section-header">
                        <?php
                        if( !empty($section->title) ){
                            echo '<h2 class="dark-text">'.esc_attr($section->title).'</h2><div class="colored-line"></div>';
                        }
                        ?>

                        <?php
                        if( !empty($section->subtitle) ){
                            echo '<div class="sub-heading">'.esc_attr($section->subtitle).'</div>';
                        }
                        ?>
                    </div>

                    <?php
                    if(!empty($section->shortcode)){
                        $scd = html_entity_decode($section->shortcode);
                        echo do_shortcode ( $scd );
                    }
                    ?>

                </div>
            </div>
        </section>
        <?php
    }
}
?>