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
    // filemtime // retourne en milliseconde le temps de la dernière modification
    // plugin_dir_path // retourne le chemin du répertoire du plugin
    // __FILE__ // le fichier en train de s'exécuter
    // wp_enqueue_style() // Intègre le link:css dans la page
    // wp_enqueue_script() // intègre le script dans la page
    // wp_enqueue_scripts // le hook

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
    // pour extraire le num de catégorie
    // get_cat_ID( string $catName):int
    $categories = get_categories();
    $contenu = '';
    foreach ($categories as $elm_categorie) {
        $id_categorie = $elm_categorie->term_id;
        $nom_categorie = $elm_categorie->name;
        $contenu .= '<button class="bouton_categorie" id="cat_'
            . $id_categorie
            . '">'
            . $nom_categorie
            . '</button>';
    }
    $contenu .= '<div class="contenu__restapi"></div>';
    return $contenu;

    // $contenu = '
    // <button class="bouton_categorie" id="cat_2" >Aventure</button>
    // <button class="bouton_categorie" id="cat_3" >Culturel</button>
    // <button class="bouton_categorie" id="cat_4" >Repos</button>
    // <button class="bouton_categorie" id="cat_5" >Zen</button>
    // <button class="bouton_categorie" id="cat_6" >Sport</button>
    // <button class="bouton_categorie" id="cat_7" >Économique</button>
    // <button class="bouton_categorie" id="cat_8" >Croisière</button>
    // <button class="bouton_categorie" id="cat_9" >Pleine Nature</button>
    // <button class="bouton_categorie" id="cat_12" >Populaire</button>
    // <div class="contenu__restapi"></div>';
    // return $contenu;
}
// faire en sorte que avec un shortcode? on puisse afficher 3 catégories de destinations

add_shortcode('ej_destination', 'creation_destinations');
