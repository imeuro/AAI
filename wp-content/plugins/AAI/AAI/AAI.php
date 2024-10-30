<?php
/*
Plugin Name: AAI customizations
Plugin URI: http://meuro.dev/
Description: Custom functions & features on Gazzetta dell'Associazione Antiquari d'Italia
Version: 0.2
Author: Mauro Fioravanzi
Author URI: http://imeuro.dev/
*/

if( ! defined( 'ABSPATH') ) { exit; }

include('inc/custom-post-types-fields-taxonomies.php');

// DECLUTTER admin sidebar for STAFF user
function remove_menus(){
  global $current_user;
  $user_id = get_current_user_id();

  if(is_admin()){

    remove_menu_page( 'link-manager.php' );           //Links 
    remove_menu_page( 'edit-comments.php' );          //Comments

    if($user_id == '2'){
      remove_menu_page( 'themes.php' );           //Appearance
      remove_menu_page( 'plugins.php' );            //Plugins
      remove_menu_page( 'users.php' );            //Users
      remove_menu_page( 'tools.php' );            //Tools
      remove_menu_page( 'themes.php' );           //Themes
      remove_menu_page( 'yith_infs_panel' );      //YITH
      remove_menu_page( 'edit.php?post_type=acf-field-group' );   //ACF
      // remove_menu_page( 'cookie-notice' );   //Cookies
      remove_menu_page( 'admin.php?page=backwpup' );      //BackWPup
    }

  }
}
add_action( 'admin_menu', 'remove_menus', 9999 );


add_filter( 'manage_posts_columns', 'custom_post_columns', 10, 2 );
function custom_post_columns( $columns, $post_type ) {
  switch ( $post_type ) {    
    case 'post':
    unset(
      $columns['author'],
      $columns['tags'],
      $columns['comments']
    );
    break;
    // case 'gallery':
    // unset(
    //   $columns['post_type'],
    //   $columns['author']
    // );
    // break;
  }
     
  return $columns;
}

