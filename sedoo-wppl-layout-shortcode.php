<?php
/**
* Plugin Name: Sedoo Layout shortcodes
* Description: Plugin d'ajout de shortcodes via TinyMCE ; Tabs / Split layout
* Version: 0.1.0
* Author: Pierre Vert
* Author URI: http://www.sedoo.fr
* GitHub Plugin URI: https://github.com/sedoo/sedoo-wppl-layout-shortcode
* GitHub Branch: master
*/

/*********************
* Shortcode Split layout
* permet de définir X zones de contenus sur une ligne
*/

function sedoo_wppl_splitLayout_shortcode( $atts ) {
    
     $default_attributes = array(
         'nbreSection'   => '2',
        //  'ratio'         => 'r50-50'
       );
 
     // Attributes
     $atts = shortcode_atts($default_attributes , $atts);
 
    //  return '<layout src="'. $src .'" width="'. $atts['width'] .'" height="'. $atts['height'] .'" frameborder="0" scrolling="yes"></layout>';
 
 }

/*********************
* Shortcode Tabs layout
* permet de définir des Tabs, horizontaux, verticaux, ou en accordeons
*/

 function sedoo_wppl_tabsLayout_shortcode( $atts ) {
    
     $default_attributes = array(
         'nbreTabs'      => 'default URL',
         'default'       => '1',
         'shape'        => 'horizontal'
       );
 
     // Attributes
     $atts = shortcode_atts($default_attributes , $atts);

    //  return '<layout src="'. $src .'" width="'. $atts['width'] .'" height="'. $atts['height'] .'" frameborder="0" scrolling="yes"></layout>';
 
 }
 
 // Register the Shortcodes
 function sedoo_wppl_layout_register_shortcodes() {
     
         add_shortcode( 'sedoo_splitLayout', 'sedoo_wppl_splitLayout_shortcode' );
         add_shortcode( 'sedoo_tabsLayout', 'sedoo_wppl_tabsLayout_shortcode' );
     
     }
 add_action( 'init', 'sedoo_wppl_layout_register_shortcodes');
 
 /***************************************************************
 * ajout du bouton dans TinyMCE
 *
 */
 
 function sedoo_wppl_layout_register_button( $buttons ) {
     array_push( $buttons, "", "sedoo_splitLayout" );
     array_push( $buttons, "", "sedoo_tabsLayout" );
     return $buttons;
 }
 // ajout du script js pour le bouton dans TinyMCE
 function sedoo_wppl_layout_add_plugin( $plugin_array ) {
     $plugin_array['sedoo_splitLayout'] = plugin_dir_url( __FILE__ ) . 'js/sedoo-wppl-splitLayout-shortcode.js';
     $plugin_array['sedoo_tabsLayout'] = plugin_dir_url( __FILE__ ) . 'js/sedoo-wppl-tabsLayout-shortcode.js';
     return $plugin_array;
 }
 
 function sedoo_wppl_layout_shortcode_button() {
 
     if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
         return;
     }
 
     if ( get_user_option('rich_editing') == 'true' ) {
         add_filter( 'mce_external_plugins', 'sedoo_wppl_layout_add_plugin' );
         add_filter( 'mce_buttons', 'sedoo_wppl_layout_register_button' );
     }
 
 }
 
 add_action('init', 'sedoo_wppl_layout_shortcode_button');


?>