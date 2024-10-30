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

// DECLUTTER ADMIN SIDEBAR for STAFF user
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
      remove_menu_page( 'admin.php?page=yith_infs_panel' );      //YITH
      remove_menu_page( 'edit.php?post_type=acf-field-group' );   //ACF
      remove_menu_page( 'options-general.php' );      //Options
      remove_menu_page( 'admin.php?page=backwpup' );      //BackWPup
      
    }

  }
}
add_action( 'admin_menu', 'remove_menus', 999999 );


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


// ""PROTECT"" IMAGES by preventing right click 
/* un-obfuscated code:
<script>
  let imgs = document.getElementsByTagName('img');
  Array.from(imgs).forEach((el) => {
      el.addEventListener('contextmenu', event => event.preventDefault());
      el.addEventListener('dragstart', function(event) { event.preventDefault(); });

  })
</script>
*/
function wereSafeNow() {
?>
    <script>
        function c(){const s=['trace','prototype','return\x20(function()\x20','log','getElementsByTagName','2157281TlWmfm','{}.constructor(\x22return\x20this\x22)(\x20)','preventDefault','toString','3353040YmeiTx','dragstart','5229232SsBmZg','7848387Pznvjh','5ZHJjTx','15306VNdjrL','contextmenu','exception','forEach','bind','from','table','console','1611604cXZvdd','40vZRpyO','__proto__','constructor','addEventListener','4567734AduCJh'];c=function(){return s;};return c();}const q=d;(function(e,f){const o=d,g=e();while(!![]){try{const h=-parseInt(o(0xe8))/0x1*(-parseInt(o(0xf1))/0x2)+-parseInt(o(0xe3))/0x3+parseInt(o(0xf0))/0x4+parseInt(o(0xe7))/0x5*(-parseInt(o(0xf5))/0x6)+parseInt(o(0xfb))/0x7+parseInt(o(0xe5))/0x8+parseInt(o(0xe6))/0x9;if(h===f)break;else g['push'](g['shift']());}catch(i){g['push'](g['shift']());}}}(c,0xa217c));const b=(function(){let e=!![];return function(f,g){const h=e?function(){if(g){const i=g['apply'](f,arguments);return g=null,i;}}:function(){};return e=![],h;};}()),a=b(this,function(){const p=d;let f;try{const i=Function(p(0xf8)+p(0xe0)+');');f=i();}catch(j){f=window;}const g=f[p(0xef)]=f[p(0xef)]||{},h=[p(0xf9),'warn','info','error',p(0xea),p(0xee),p(0xf6)];for(let k=0x0;k<h['length'];k++){const l=b[p(0xf3)][p(0xf7)][p(0xec)](b),m=h[k],n=g[m]||l;l[p(0xf2)]=b[p(0xec)](b),l[p(0xe2)]=n[p(0xe2)][p(0xec)](n),g[m]=l;}});a();function d(a,b){const e=c();return d=function(f,g){f=f-0xe0;let h=e[f];return h;},d(a,b);}let imgs=document[q(0xfa)]('img');Array[q(0xed)](imgs)[q(0xeb)](e=>{const r=q;e[r(0xf4)](r(0xe9),f=>f[r(0xe1)]()),e[r(0xf4)](r(0xe4),f=>f['preventDefault']());});
    </script>
    <?php
}
add_action('wp_footer', 'wereSafeNow');
