<?php

class RecipeInstantArticlesFilter {
    /** @var EasyRecipePlusTemplate */
    private $template;

    /** @var RecipeInstantArticlesData */
    private $data;

    /**
     * RecipeInstantArticlesFilter constructor.
     *
     * @param EasyRecipePlusTemplate $template
     * @param RecipeInstantArticlesData          $data
     */
    public function __construct( $template, $data ) {
        $this->template = $template;
        $this->data = $data;
    }

    /**
     * @param EasyRecipePlusDocument $document
     *
     * @return string
     */
    function __invoke( $document ) {
        $content = $document->applyStyle( $this->template, $this->data );
        return $this->strip_autop_quotes( $content );
    }

    /**
     * @param string $content
     *
     * @return string
     */
    protected function strip_autop_quotes( $content ) {
        $entities = [ '”', '&#x201C;', '&#x201D;' ];
        return str_replace( $entities, '', html_entity_decode( $content ) );
    }
}
