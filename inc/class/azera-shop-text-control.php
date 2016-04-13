<?php
class Azera_Shop_Message extends WP_Customize_Control{
    private $message = '';
    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        if(!empty($args['azera_shop_message'])){
            $this->message = $args['azera_shop_message'];
        }
    }
    
    public function render_content(){
        echo '<span class="customize-control-title">'.$this->label.'</span>';
        echo $this->message;
    }
} 
?>