<?php

class RecipeInstantArticles {
    /** @var RecipeInstantArticlesTemplate */
    protected $template;

    /**
     * Initializes WordPress hooks
     */
    public function init() {
        add_action( 'plugins_loaded', [ $this, 'plugins_loaded' ] );
    }

    /**
     * Performs requirements checks and initializes filters once all plugins
     * have been loaded.
     */
    public function plugins_loaded() {
        if (false === $this->check_requirements()) {
            add_action(
                'admin_notices',
                function () {
                    echo '<div class="error"><p>' .
                        esc_html__('EasyRecipe Instant Articles requires EasyRecipe Plus to be installed.', 'erp-instant-articles') . '</p></div>';
                }
            );
            return;
        }

        // Add the filter for Facebook Instant Articles content
        if ( defined( 'IA_PLUGIN_VERSION' ) ) {
            add_filter( 'instant_articles_content', [ $this, 'the_content' ], 0, 1 );
        }
    }

    /**
     * @return RecipeInstantArticlesTemplate
     */
    public function get_the_template() {
        if (null === $this->template) {
            /* @var $wp_rewrite WP_Rewrite */
            global $wp_rewrite;
            $this->template = new RecipeInstantArticlesTemplate($wp_rewrite->using_permalinks());
        }

        return $this->template;
    }

    /**
     * Applies EasyRecipe formatting to the post content.
     *
     * @param string $content
     *
     * @return string
     */
    public function the_content( $content ) {
        global $post;

        // Return early if the post is not available.
        // TODO: Add a notice?
        if ( empty ( $post ) ) { return $content; }

        $filter = $this->get_the_template()->new_content_filter( $post );

        return $filter( $content );
    }

    /**
     * @return bool
     */
    private function check_requirements() {
        return class_exists( 'EasyRecipePlus', false );
    }
}
