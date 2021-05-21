<?php

declare(strict_types=1);

namespace HPT\CZC;

use simplehtmldom\HtmlDocument;

class ProductPage
{

	/** @var string */
	private $productId;

	/** @var string */
	private $productPageUrl;

	/** @var HtmlDocument */
	private $productPage;

	/** @var string */
	public static $websiteUrl = 'https://www.czc.cz/';

	/** @var string */
	public static $productLinkSelector = '.new-tile h5 a';

	/** @var string */
	public static $productIdSelector = 'span[itemprop=mpn]';

	/** @var string */
	public static $productPriceSelector = 'span[itemprop=price]';

	public function __construct(string $productId)
	{
		$this->productId = $productId;

		// Find product page URL
		$this->find();

		// Load product page
		$this->load();
	}

	private function find(): void
	{
		// Get search results from CZC using $productId as query string
		$searchResults = \file_get_html(self::$websiteUrl . $this->productId . '/hledat');

		// Get first result
		$firstResult = $searchResults->find(self::$productLinkSelector);

		// It doesn't have to exist
		if(!count($firstResult)) return;

		// Save product page URL
		$this->productPageUrl = $firstResult[0]->getAttribute('href');
	}

	private function load(): void
	{
		// Load product page as simplehtmldom/HtmlDocument
		$productPage =\file_get_html( self::$websiteUrl . $this->productPageUrl);

		// Find productId in product page
		$productId = $productPage->find(self::$productIdSelector)[0]->innertext;

		// Check we have a right product page or search engine find just a most similar product
		if($this->productId === $productId) {
			$this->productPage = $productPage;
		}
	}

	public function isLoaded(): bool
	{
		// Is product page loaded ?
		return (bool) $this->productPage;
	}

	public function getPrice(): float
	{
		// If product page is loaded
		if($this->isLoaded()) {
			// Get the product price
			return (float) $this->productPage->find(self::$productPriceSelector)[0]->content;
		}

		// Or return 0;
		return 0;
	}
}
