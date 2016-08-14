<?php

/**
 * Data object for rendering EasyRecipe HTML.
 */
class RecipeInstantArticlesData extends ArrayObject {
    /**
     * RecipeInstantArticlesData constructor.
     *
     * @param bool $usingPermalinks
     */
    public function __construct($usingPermalinks = true) {
        $siteURL = home_url();
        $props = [
            'blogname'     => get_option( 'blogname' ),
            'siteURL'      => $siteURL,
            'isLoggedIn'   => is_user_logged_in(),
            'sitePrintURL' => $usingPermalinks ? $siteURL . '?' : $siteURL,
        ];

        parent::__construct($props, self::ARRAY_AS_PROPS);
    }

    /**
     * @param EasyRecipePlusSettings $settings
     *
     * @return RecipeInstantArticlesData
     */
    public function with_settings($settings) {
        $data = clone $this;

        $data->convertFractions = $settings->convertFractions;
        $data->displayPrint = $settings->displayPrint;
        $data->hasLinkback = $settings->allowLink;
        $data->style = $settings->style;

        $settings->getLabels($data);

        return $data;
    }

    /**
     * @param WP_Post $post
     *
     * @return RecipeInstantArticlesData
     */
    public function with_post($post) {
        $data = clone $this;

        if ( ! empty ( $post ) ) {
            $data->postID = $post->ID;
            $data->title = $post->post_title;
            $data->recipeurl = get_permalink($post->ID);
        }

        return $data;
    }
}
