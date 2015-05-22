<?php

/*
 * This file is part of the WebParser package.
 *
 * (c) Henrique Dias <hacdias@gmail.com>
 * (c) Luís Soares <lsoares@gmail.com>
 *
 * Licensed under the MIT license.
 */

namespace SmartScrapper;

use Goutte\Client as Client;
use stdClass;

/**
 * Parser
 *
 * @author Henrique Dias <hacdias@gmail.com>
 * @author Luís Soares <lsoares@gmail.com>
 */
class Parser {

	public $url;
	// TODO: safe variables
	private $crawler,
	$listName,
	$listExpression,
	$childSelectors;

	public function __construct( $url )
	{
		$client			 = new Client();
		$this->url		 = $url;
		$this->crawler	 = $client->request( 'GET', $url );
	}

	public function text( $name, $expression, $attribute = null )
	{
		// keep
		$this->{$name} = $this->smartSelect( $this->crawler, new Selector( $name, $expression, $attribute ) );
	}

	private function smartSelect( $context, Selector $selector )
	{
		try {
			$el	 = $context->filter( $selector->getExpression() );
			$res = $selector->getAttribute() ? $el->attr( $selector->getAttribute() ) : $el->text();
			return $res;
		} catch ( InvalidArgumentException $ex ) {
			return null;
		}
	}

	public function html( $name, $expression )
	{
		try {
			$el				 = $this->crawler->filter( $expression );
			$this->{$name}	 = $el->html(); // keep
		} catch ( InvalidArgumentException $e ) {
			$this->{$name} = null;
		}
	}

	public function selectList( $name, $expression )
	{
		$this->listName			 = $name;
		$this->listExpression	 = $expression;
		$this->childSelectors	 = array();

		return $this;
	}

	public function with( $name, $expression, $attribute = null )
	{
		array_push( $this->childSelectors, new Selector( $name, $expression, $attribute ) );

		return $this;
	}

	public function save()
	{
		$subSelections	 = array();
		$childSelectors	 = $this->childSelectors;
		try {
			$listSelection = $this->crawler->filter( $this->listExpression );
			$listSelection->each( function ( $node ) use ( &$subSelections, $childSelectors) {
				$item = new stdClass();
				foreach ( $childSelectors as $childSelector ) {
					$item->{$childSelector->getName()} = $this->smartSelect( $node, $childSelector );
				}
				array_push( $subSelections, $item );
			} );
		} catch ( InvalidArgumentException $e ) {
			// it will be an empty list
		}
		$this->{$this->listName} = $subSelections; // keep
	}

}
