<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class azera_shop_General_Repeater extends WP_Customize_Control {

        private $options = array();

        public function __construct( $manager, $id, $args = array() ) {
            parent::__construct( $manager, $id, $args );
            $this->options = $args;
        }

        public function render_content() {


            $this_default = json_decode($this->setting->default);


            $values = $this->value();
            $json = json_decode($values);
            if(!is_array($json)) $json = array($values);
            $it = 0;
            $it2 = 0;

            $options = $this->options;
            if(!empty($options['azera_shop_image_control'])){
                $azera_shop_image_control = $options['azera_shop_image_control'];
            } else {
                $azera_shop_image_control = false;
            }
            if(!empty($options['azera_shop_icon_control'])){
                $azera_shop_icon_control = $options['azera_shop_icon_control'];
                $icons_array = array( 'No Icon','fa-envelope','fa-map-marker','fa-500px','fa-amazon','fa-android','fa-behance','fa-behance-square','fa-bitbucket','fa-bitbucket-square','fa-cc-amex','fa-cc-diners-club','fa-cc-discover','fa-cc-jcb','fa-cc-mastercard','fa-paypal','fa-cc-stripe','fa-cc-visa','fa-codepen','fa-css3','fa-delicious','fa-deviantart','fa-digg','fa-dribbble','fa-dropbox','fa-drupal','fa-facebook','fa-facebook-official','fa-facebook-square','fa-flickr','fa-foursquare','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-google','fa-google-plus','fa-google-plus-square','fa-html5','fa-instagram','fa-joomla','fa-jsfiddle','fa-linkedin','fa-linkedin-square','fa-opencart','fa-openid','fa-pinterest','fa-pinterest-p','fa-pinterest-square','fa-rebel','fa-reddit','fa-reddit-square','fa-share-alt','fa-share-alt-square','fa-skype','fa-slack','fa-soundcloud','fa-spotify','fa-stack-overflow','fa-steam','fa-steam-square','fa-tripadvisor','fa-tumblr','fa-tumblr-square','fa-twitch','fa-twitter','fa-twitter-square','fa-vimeo','fa-vimeo-square','fa-vine','fa-whatsapp','fa-wordpress','fa-yahoo','fa-youtube','fa-youtube-play','fa-youtube-square');
            } else {
                 $azera_shop_icon_control = false;
            }
            if(!empty($options['azera_shop_title_control'])){
                $azera_shop_title_control = $options['azera_shop_title_control'];
            } else {
                $azera_shop_title_control = false;
            }
            if(!empty($options['azera_shop_subtitle_control'])){
                $azera_shop_subtitle_control = $options['azera_shop_subtitle_control'];
            } else {
                $azera_shop_subtitle_control = false;
            }                        
            if(!empty($options['azera_shop_text_control'])){
                $azera_shop_text_control = $options['azera_shop_text_control'];
            } else {
                $azera_shop_text_control = false;
            }
            if(!empty($options['azera_shop_link_control'])){
                $azera_shop_link_control = $options['azera_shop_link_control'];
            } else {
                $azera_shop_link_control = false;
            }
            if(!empty($options['azera_shop_shortcode_control'])){
                $azera_shop_shortcode_control = $options['azera_shop_shortcode_control'];
            } else {
                $azera_shop_shortcode_control = false;
            }
            

 ?>

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="azera_shop_general_control_repeater azera_shop_general_control_droppable">
                <?php
                    if(empty($json)) {
                        
                ?>
                        <div class="azera_shop_general_control_repeater_container">
                            <div class="azera-shop-customize-control-title"><?php esc_html_e('Azera Shop','azera-shop')?></div>
                            <div class="azera-shop-box-content-hidden">
                                <?php
                                    if($azera_shop_image_control == true && $azera_shop_icon_control == true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Image type','azera-shop');?></span>
                                        <select class="azera_shop_image_choice">
                                            <option value="azera_shop_icon" selected><?php esc_html_e('Icon','azera-shop'); ?></option>
                                            <option value="azera_shop_image"><?php esc_html_e('Image','azera-shop'); ?></option>
                                            <option value="azera_shop_none"><?php esc_html_e('None','azera-shop'); ?></option>
                                        </select>

                                        <p class="azera_shop_image_control" style="display:none">
                                            <span class="customize-control-title"><?php esc_html_e('Image','azera-shop')?></span>
                                            <input type="text" class="widefat custom_media_url">
                                            <input type="button" class="button button-primary custom_media_button_azera_shop" value="<?php esc_html_e('Upload Image','azera-shop'); ?>" />
                                        </p>

                                        <div class="azera_shop_general_control_icon">
                                            <span class="customize-control-title"><?php esc_html_e('Icon','azera-shop');?></span>
                                            <select class="azera_shop_icon_control">
                                            <?php
                                                foreach($icons_array as $contact_icon) {
                                                    echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                <?php
                                    } else {
                                        if($azera_shop_image_control ==true){	?>
                                            <span class="customize-control-title"><?php esc_html_e('Image','azera-shop')?></span>
                                            <p class="azera_shop_image_control">
                                                <input type="text" class="widefat custom_media_url">
                                                <input type="button" class="button button-primary custom_media_button_azera_shop" value="<?php esc_html_e('Upload Image','azera-shop'); ?>" />
                                            </p>
                                <?php
                                        }

                                       if($azera_shop_icon_control ==true){
                                ?>
                                            <span class="customize-control-title"><?php esc_html_e('Icon','azera-shop')?></span>
                                            <select name="<?php echo esc_attr($this->id); ?>" class="azera_shop_icon_control">
                                                <?php
                                                    foreach($icons_array as $contact_icon) {
                                                        echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                    }
                                                ?>
                                            </select>
                                <?php   }
                                    }
                        
                                    if($azera_shop_title_control==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Title','azera-shop')?></span>
                                        <input type="text" class="azera_shop_title_control" placeholder="<?php esc_html_e('Title','azera-shop'); ?>"/>
                                <?php
                                    }
                        
                                    if($azera_shop_subtitle_control==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Subtitle','azera-shop')?></span>
                                        <input type="text" class="azera_shop_subtitle_control" placeholder="<?php esc_html_e('Subtitle','azera-shop'); ?>"/>
                                <?php
                                    }
 

                                    if($azera_shop_text_control==true){?>
                                        <span class="customize-control-title"><?php esc_html_e('Text','azera-shop')?></span>
                                        <textarea class="azera_shop_text_control" placeholder="<?php esc_html_e('Text','azera-shop'); ?>"></textarea>
                                <?php }

                                    if($azera_shop_link_control==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Link','azera-shop')?></span>
                                        <input type="text" class="azera_shop_link_control" placeholder="<?php esc_html_e('Link','azera-shop'); ?>"/>
                                <?php } 
                                    if($azera_shop_shortcode_control==true){
                                    ?>
                                        <span class="customize-control-title"><?php esc_html_e('Shortcode','azera-shop')?></span>
                                        <input type="text" class="azera_shop_shortcode_control" placeholder="<?php esc_html_e('Shortcode','azera-shop'); ?>"/>
                                 <?php   
                                    }
                                ?>
                                <input type="hidden" class="azera_shop_box_id">
                            <button type="button" class="azera_shop_general_control_remove_field button" style="display:none;"><?php esc_html_e('Delete field','azera-shop'); ?></button>
                            </div>
                        </div>
                <?php
                    } else {
                        if ( !empty($this_default) && empty($json)) {
                            foreach($this_default as $icon){
                             
                ?>
                                <div class="azera_shop_general_control_repeater_container azera_shop_draggable">
                                    <div class="azera-shop-customize-control-title"><?php esc_html_e('Azera Shop','azera-shop')?></div>
                                    <div class="azera-shop-box-content-hidden">
                                         <?php
                                            if($azera_shop_image_control == true && $azera_shop_icon_control == true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Image type','azera-shop');?></span>
                                                <select class="azera_shop_image_choice">
                                                    <option value="azera_shop_icon" <?php selected($icon->choice,'azera_shop_icon');?>><?php esc_html_e('Icon','azera-shop');?></option>
                                                    <option value="azera_shop_image" <?php selected($icon->choice,'azera_shop_image');?>><?php esc_html_e('Image','azera-shop');?></option>
                                                    <option value="azera_shop_none" <?php selected($icon->choice,'azera_shop_none');?>><?php esc_html_e('None','azera-shop');?></option>
                                                </select>

                                                <p class="azera_shop_image_control"  <?php if(!empty($icon->choice) && $icon->choice != 'azera_shop_image'){ echo 'style="display:none"';}?>>
                                                    <span class="customize-control-title"><?php esc_html_e('Image','azera-shop');?></span>
                                                    <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                    <input type="button" class="button button-primary custom_media_button_azera_shop" value="<?php esc_html_e('Upload Image','azera-shop'); ?>" />
                                                </p>

                                                <div class="azera_shop_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='azera_shop_icon'){ echo 'style="display:none"';}?>>
                                                    <span class="customize-control-title"><?php esc_html_e('Icon','azera-shop');?></span>
                                                    <select name="<?php echo esc_attr($this->id); ?>" class="azera_shop_icon_control">
                                                        <?php
                                                            foreach($icons_array as $contact_icon) {
                                                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                        <?php
                                            } else {
                                        ?>
                                        <?php	if($azera_shop_image_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Image','azera-shop')?></span>
                                                    <p class="azera_shop_image_control">
                                                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                        <input type="button" class="button button-primary custom_media_button_azera_shop" value="<?php esc_html_e('Upload Image','azera-shop'); ?>" />
                                                    </p>
                                        <?php	}

                                                if($azera_shop_icon_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Icon','azera-shop')?></span>
                                                    <select name="<?php echo esc_attr($this->id); ?>" class="azera_shop_icon_control">
                                                        <?php
                                                            foreach($icons_array as $contact_icon) {
                                                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                        <?php
                                                }
                                            }
                                                if($azera_shop_title_control==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Title','azera-shop')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="azera_shop_title_control" placeholder="<?php esc_html_e('Title','azera-shop'); ?>"/>
                                        <?php
                                                }

                                                if($azera_shop_subtitle_control==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Subtitle','azera-shop')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="azera_shop_subtitle_control" placeholder="<?php esc_html_e('Subtitle','azera-shop'); ?>"/>
                                        <?php
                                                }
 
                                                if($azera_shop_text_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Text','azera-shop')?></span>
                                                    <textarea placeholder="<?php esc_html_e('Text','azera-shop'); ?>" class="azera_shop_text_control"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                                        <?php	}
                                                if($azera_shop_link_control){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Link','azera-shop')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="azera_shop_link_control" placeholder="<?php esc_html_e('Link','azera-shop'); ?>"/>
                                        <?php	}
                                                if($azera_shop_shortcode_control==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Shortcode','azera-shop')?></span>
                                        <input type="text" value='<?php if(!empty($icon->shortcode)) echo $icon->shortcode; ?>' class="azera_shop_shortcode_control" placeholder="<?php esc_html_e('Shortcode','azera-shop'); ?>"/>
                                  <?php  }
                                        ?>
                                        <input type="hidden" class="azera_shop_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                    <button type="button" class="azera_shop_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','azera-shop'); ?></button>
                                    </div>

                                </div>

                <?php
                                $it++;
                            }
                        } else {
                            foreach($json as $icon){
                    ?>
                                <div class="azera_shop_general_control_repeater_container azera_shop_draggable">
                                    <div class="azera-shop-customize-control-title"><?php esc_html_e('Azera Shop','azera-shop')?></div>
                                    <div class="azera-shop-box-content-hidden">
                                    <?php
                                    if($azera_shop_image_control == true && $azera_shop_icon_control == true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Image type','azera-shop');?></span>
                                        <select class="azera_shop_image_choice">
                                            <option value="azera_shop_icon" <?php selected($icon->choice,'azera_shop_icon');?>><?php esc_html_e('Icon','azera-shop');?></option>
                                            <option value="azera_shop_image" <?php selected($icon->choice,'azera_shop_image');?>><?php esc_html_e('Image','azera-shop');?></option>
                                            <option value="azera_shop_none" <?php selected($icon->choice,'azera_shop_none');?>><?php esc_html_e('None','azera-shop');?></option>
                                        </select>


                                        <p class="azera_shop_image_control" <?php if(!empty($icon->choice) && $icon->choice!='azera_shop_image'){ echo 'style="display:none"';}?>>
                                            <span class="customize-control-title"><?php esc_html_e('Image','azera-shop');?></span>
                                            <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                            <input type="button" class="button button-primary custom_media_button_azera_shop" value="<?php esc_html_e('Upload Image','azera-shop'); ?>" />
                                        </p>

                                        <div class="azera_shop_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='azera_shop_icon'){ echo 'style="display:none"';}?>>
                                            <span class="customize-control-title"><?php esc_html_e('Icon','azera-shop');?></span>
                                            <select name="<?php echo esc_attr($this->id); ?>" class="azera_shop_icon_control">
                                            <?php
                                                foreach($icons_array as $contact_icon) {
                                                    echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    <?php

                                    } else {
                                    ?>
                                        <?php
                                            if($azera_shop_image_control == true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Image','azera-shop')?></span>
                                                <p class="azera_shop_image_control">
                                                    <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                    <input type="button" class="button button-primary custom_media_button_azera_shop" value="<?php esc_html_e('Upload Image','azera-shop'); ?>" />
                                                </p>
                                        <?php }

                                            if($azera_shop_icon_control==true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Icon','azera-shop')?></span>
                                                <select name="<?php echo esc_attr($this->id); ?>" class="azera_shop_icon_control">
                                                <?php
                                                    foreach($icons_array as $contact_icon) {
                                                        echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                    }
                                                ?>
                                                </select>
                                        <?php
                                            }
                                        }
                                        if($azera_shop_title_control==true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Title','azera-shop')?></span>
                                            <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="azera_shop_title_control" placeholder="<?php esc_html_e('Title','azera-shop'); ?>"/>
                                        <?php
                                                }

                                        if($azera_shop_subtitle_control==true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Subtitle','azera-shop')?></span>
                                            <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="azera_shop_subtitle_control" placeholder="<?php esc_html_e('Subtitle','azera-shop'); ?>"/>
                                        <?php
                                        }
                                        if($azera_shop_text_control==true ){?>
                                            <span class="customize-control-title"><?php esc_html_e('Text','azera-shop')?></span>
                                            <textarea class="azera_shop_text_control" placeholder="<?php esc_html_e('Text','azera-shop'); ?>"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                                        <?php }

                                        if($azera_shop_link_control){ ?>
                                            <span class="customize-control-title"><?php esc_html_e('Link','azera-shop')?></span>
                                            <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="azera_shop_link_control" placeholder="<?php esc_html_e('Link','azera-shop'); ?>"/>
                                        <?php }
                                        
                                
                                        if($azera_shop_shortcode_control==true){ ?>
                                            <span class="customize-control-title"><?php esc_html_e('Shortcode','azera-shop')?></span>
                                            <input type="text" value='<?php if(!empty($icon->shortcode)) echo $icon->shortcode; ?>' class="azera_shop_shortcode_control" placeholder="<?php esc_html_e('Shortcode','azera-shop'); ?>"/>
                                  <?php  }
                                        ?>
                                        <input type="hidden" class="azera_shop_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                        <button type="button" class="azera_shop_general_control_remove_field button" <?php
                                            if ($it == 0)
                                            echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','azera-shop'); ?></button>
                                    </div>

                                </div>
                    <?php
                                $it++;
                                
                            }
                        }
                    }

                if ( !empty($this_default) && empty($json)) {
                     
                ?>
                    <input type="hidden" id="azera_shop_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="azera_shop_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
            <?php } else {	?>
                    <input type="hidden" id="azera_shop_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="azera_shop_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
            <?php } ?>
            </div>

            <button type="button"   class="button add_field azera_shop_general_control_new_field"

            ><?php esc_html_e('Add new field','azera-shop'); ?></button>

            <?php

    }

}