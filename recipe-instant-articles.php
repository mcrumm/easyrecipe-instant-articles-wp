<?php
/**
 * Plugin Name: Recipe Instant Articles
 * Description: Enable Instant Articles for Facebook when using EasyRecipe Plus on your WordPress site.
 * Author: mcrumm
 * Author URI: http://crumm.net
 * Version: 1.0
 */

if ( version_compare( PHP_VERSION, '5.4', '<' ) ) {
    add_action(
        'admin_notices',
        function () {
            echo '<div class="error"><p>' .
                esc_html__( 'EasyRecipe Instant Articles requires PHP 5.4 to function properly. Please upgrade PHP or deactivate EasyRecipe Instant Articles.', 'erp-instant-articles' ) . '</p></div>';
        }
    );
    return;
} else {
    function recipe_instant_articles_autoload($class) {
        if (strpos($class, 'RecipeInstantArticles') === 0) {
            require __DIR__ . "/lib/$class.php";
        }
    }
    spl_autoload_register('recipe_instant_articles_autoload');

    $ria = new RecipeInstantArticles();
    $ria->init();
}
