<?php

/**
 * Package Cours
 * Version 1.0.0
 */
/*
Plugin name: Pays
Plugin uri: https://github.com/eddytuto
Version: 1.0.0
Description: Permet d'afficher les destinations qui répondent à certains critères
*/
function ej_enqueue()
{
    $version_css = filemtime(plugin_dir_path(__FILE__) . "style.css");
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/pays.js");
    wp_enqueue_style(
        'ej_plugin_pays_css',
        plugin_dir_url(__FILE__) . "style.css",
        array(),
        $version_css
    );

    wp_enqueue_script(
        'ej_plugin_pays_js',
        plugin_dir_url(__FILE__) . "js/pays.js",
        array(),
        $version_js,
        true
    );
}
add_action('wp_enqueue_scripts', 'ej_enqueue');
/* Création de la liste des destinations en HTML */
function creation_destinations()
{
    $search_keywords = array("France", "Belgique", "Canada", "États-Unis", "Suisse", "Mexique", "Chine", "Argentine", "Chili", "Maroc", "Japon", "Italie", "Grèce");
    $categories = get_categories();
    $contenu = '';
    foreach ($search_keywords as $keyword) {
        $contenu .= '<button class="bouton_categorie" data-keyword="' . $keyword . '">' . $keyword . '</button>';
    }

    $contenu .= '<div class="contenu__restapi"></div>';
    return $contenu;
}
// faire en sorte que avec un shortcode? on puisse afficher 3 catégories de destinations

add_shortcode('ej_destination', 'creation_destinations');
