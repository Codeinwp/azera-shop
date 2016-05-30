<?php
$azera_shop_shortcodes_section = get_theme_mod('azera_shop_shortcodes_settings');
$azera_shop_shortcodes_section_decoded = json_decode($azera_shop_shortcodes_section);
if(!empty($azera_shop_shortcodes_section) && (!empty($azera_shop_shortcodes_section_decoded[0]->title) || !empty($azera_shop_shortcodes_section_decoded[0]->subtitle) || !empty($azera_shop_shortcodes_section_decoded[0]->shortcode))){

    foreach($azera_shop_shortcodes_section_decoded as $section){
        $pos = strlen(strstr($section->shortcode,"pirate_forms"));
        $id = '';
        $title = '';
        $subtitle = '';
        $shortcode = '';

        if( !empty($section->id) ){
            $id = $section->id;
        }
        if( !empty( $section->title ) ){
            if( function_exists( 'pll__') ){
                $title = pll__( $section->title );
            } else {
                $title = apply_filters( 'wpml_translate_single_string', $section->title, 'Azera Shop -> Shortcodes section', 'Shortcode title '.$id );
            }
        }
        if( !empty( $section->subtitle ) ){
            if( function_exists( 'pll__') ){
                $subtitle = pll__( $section->subtitle );
            } else {
                $subtitle = apply_filters( 'wpml_translate_single_string', $section->subtitle, 'Azera Shop -> Shortcodes section', 'Shortcode subtitle '.$id );
            }
        }
        if( !empty( $section->shortcode ) ){
            if( function_exists( 'pll__') ){
                $shortcode = pll__( $section->shortcode );
            } else {
                $shortcode = apply_filters( 'wpml_translate_single_string', $section->shortcode, 'Azera Shop -> Shortcodes section', 'Shortcode '.$id );
            }
        } ?>
        <section id="<?php if($pos > 0 ) { echo 'contact';} else {if(!empty($section->title)) {echo preg_replace('/[^a-zA-Z0-9]/','', strtolower($section->title));}}?>" class="shortcodes" role="region" aria-label="<?php esc_html_e('Shortcodes','azera-shop'); ?>">
            <div class="section-overlay-layer">
                <div class="container">

                    <div class="section-header">
                        <?php
                        if( !empty($title) ){
                            echo '<h2 class="dark-text">'.esc_attr($title).'</h2><div class="colored-line"></div>';
                        }
                        
                        if( !empty($subtitle) ){
                            echo '<div class="sub-heading">'.esc_attr($subtitle).'</div>';
                        }
                        ?>
                    </div>

                    <?php
                    if(!empty($shortcode)){
                        $scd = html_entity_decode($shortcode);
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