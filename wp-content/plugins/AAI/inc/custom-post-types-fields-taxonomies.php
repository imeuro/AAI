<?php
/**
 * Registrazione dei tipi di post personalizzati, campi e tassonomie
 */

// Rimuovo la funzione register_billboards_post_type poiché il tipo di post sarà gestito tramite CPT UI
// function register_billboards_post_type() {
//     $labels = array(
//         'name'               => _x('Billboards', 'post type general name', 'aai'),
//         'singular_name'      => _x('Billboard', 'post type singular name', 'aai'),
//         'menu_name'          => _x('Billboards', 'admin menu', 'aai'),
//         'name_admin_bar'     => _x('Billboard', 'add new on admin bar', 'aai'),
//         'add_new'            => _x('Aggiungi nuovo', 'billboard', 'aai'),
//         'add_new_item'       => __('Aggiungi nuovo Billboard', 'aai'),
//         'new_item'           => __('Nuovo Billboard', 'aai'),
//         'edit_item'          => __('Modifica Billboard', 'aai'),
//         'view_item'          => __('Visualizza Billboard', 'aai'),
//         'all_items'          => __('Tutti i Billboard', 'aai'),
//         'search_items'       => __('Cerca Billboard', 'aai'),
//         'parent_item_colon'  => __('Billboard padre:', 'aai'),
//         'not_found'          => __('Nessun billboard trovato.', 'aai'),
//         'not_found_in_trash' => __('Nessun billboard trovato nel cestino.', 'aai')
//     );
// 
//     $args = array(
//         'labels'             => $labels,
//         'description'        => __('Billboard per la homepage', 'aai'),
//         'public'             => true,
//         'publicly_queryable' => true,
//         'show_ui'            => true,
//         'show_in_menu'       => true,
//         'query_var'          => true,
//         'rewrite'            => array('slug' => 'billboard'),
//         'capability_type'    => 'post',
//         'has_archive'        => true,
//         'hierarchical'       => false,
//         'menu_position'      => 5,
//         'menu_icon'          => 'dashicons-images-alt2',
//         'supports'           => array('title', 'thumbnail')
//     );
// 
//     register_post_type('billboards', $args);
// }
// add_action('init', 'register_billboards_post_type');