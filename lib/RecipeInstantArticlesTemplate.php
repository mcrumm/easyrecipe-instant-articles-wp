<?php

class RecipeInstantArticlesTemplate {
    /** @var EasyRecipePlusSettings */
    private $settings;

    /** @var bool */
    private $usingPermalinks;

    /**
     * RecipeInstantArticlesTemplate constructor.
     *
     * @param bool                        $usingPermalinks
     * @param null|EasyRecipePlusSettings $settings
     */
    public function __construct( $usingPermalinks = true, $settings = null ) {
        $this->usingPermalinks = $usingPermalinks;
        $this->settings = $settings ?: EasyRecipePlusSettings::getInstance();
        $this->template = $this->new_template();
        $this->data = $this->new_data();
    }

    /**
     * @return RecipeInstantArticlesData
     */
    public function new_data() {
        $data = new RecipeInstantArticlesData( $this->usingPermalinks );

        return $data->with_settings( $this->settings );
    }

    /**
     * @param string $content
     *
     * @return null|EasyRecipePlusDocument
     */
    public function new_document( $content ) {
        $doc = new EasyRecipePlusDocument( $content );
        if ( ! $doc->isEasyRecipe ) { return null; }

        if ( $doc->recipeVersion < '3' ) {
            $doc->fixTimes( 'preptime' );
            $doc->fixTimes( 'cooktime' );
            $doc->fixTimes( 'duration' );
            $label = $this->settings->lblCholesterol;
            $doc->setParentValueByClassName( 'cholestrol', $label, 'Cholestrol' );
        }

        $doc->setSettings( $this->settings );

        return $doc;
    }

    /**
     * @param WP_Post $post
     *
     * @return Closure
     */
    public function new_content_filter( $post ) {
        $filter = $this->new_filter( $post );

        return function ( $content ) use ( $filter ) {
            $document = $this->new_document( $content );

            // Only filter EasyRecipe documents.
            if ( null === $document || $document->isFormatted ) {
                return $content;
            }

            return $filter( $document );
        };
    }

    /**
     * @param WP_Post $post
     *
     * @return Closure
     */
    public function new_filter( $post ) {
        return new RecipeInstantArticlesFilter( $this->template, $this->data->with_post( $post ) );
    }

    /**
     * @return EasyRecipePlusTemplate
     */
    public function new_template() {
        $templateDir = EasyRecipePlus::$EasyRecipePlusDir;
        $styleName = $this->settings->style;

        if ( $styleName == '_' ) {
            $styleName = substr( $this->settings->style, 1 );
            $templateDir = $this->settings->customTemplates;
        }

        $templateFile = $templateDir . "/styles/$styleName/style.html";

        return new EasyRecipePlusTemplate( $templateFile );
    }
}
