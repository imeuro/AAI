<?php
/**
 * Plugin Name: AAI
 * Plugin URI: https://www.aai.it
 * Description: Plugin per la gestione dei contenuti di AAI
 * Version: 1.1.0
 * Author: Meuro
 * Author URI: https://www.meuro.it
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: aai
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('AAI_VERSION', '1.0.0');
define('AAI_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AAI_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include required files
include('inc/custom-post-types-fields-taxonomies.php');

// Register activation hook
register_activation_hook(__FILE__, 'aai_activate');

// Register deactivation hook
register_deactivation_hook(__FILE__, 'aai_deactivate');

// Activation function
function aai_activate() {
    // Activation code here
    flush_rewrite_rules();
}

// Deactivation function
function aai_deactivate() {
    // Deactivation code here
    flush_rewrite_rules();
}

// Enqueue scripts and styles
function aai_enqueue_scripts() {
    // Il file CSS aai-home.css è stato spostato nel tema
}
add_action('wp_enqueue_scripts', 'aai_enqueue_scripts');

// Add admin menu
function aai_admin_menu() {
    add_menu_page(
        'AAI Settings',
        'AAI',
        'manage_options',
        'aai-settings',
        'aai_settings_page',
        'dashicons-admin-generic',
        30
    );
}
add_action('admin_menu', 'aai_admin_menu');

// Settings page callback
function aai_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p>Benvenuto nelle impostazioni di AAI.</p>
    </div>
    <?php
}

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


// Modifica le colonne dei post standard, escludendo i billboard
add_filter( 'manage_posts_columns', 'custom_post_columns', 10, 2 );
function custom_post_columns( $columns, $post_type ) {
  // Applica solo ai post standard, non ai billboard
  if ($post_type === 'post') {
    unset(
      $columns['author'],
      $columns['tags'],
      $columns['comments']
    );
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

// Aggiungi colonna personalizzata per la posizione dei billboard
function aai_add_billboard_position_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns[$key] = $value;
            $new_columns['billboard_position'] = 'Posizione';
        } else {
            $new_columns[$key] = $value;
        }
    }
    return $new_columns;
}
add_filter('manage_billboards_posts_columns', 'aai_add_billboard_position_column');

// Popola la colonna della posizione con il valore del campo ACF
function aai_populate_billboard_position_column($column, $post_id) {
    if ($column === 'billboard_position') {
        $position = get_field('billboard_position', $post_id);
        if ($position) {
            echo 'Dopo il post ' . esc_html($position);
        } else {
            echo '—';
        }
    }
}
add_action('manage_billboards_posts_custom_column', 'aai_populate_billboard_position_column', 10, 2);

// Rendi la colonna della posizione ordinabile
function aai_billboard_position_sortable_column($columns) {
    $columns['billboard_position'] = 'billboard_position';
    return $columns;
}
add_filter('manage_edit-billboards_sortable_columns', 'aai_billboard_position_sortable_column');

// Gestisci l'ordinamento per la colonna della posizione
function aai_billboard_position_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ('billboard_position' === $orderby) {
        $query->set('meta_key', 'billboard_position');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'aai_billboard_position_orderby');
