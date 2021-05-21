<?php

declare(strict_types=1);

namespace HPT\CZC;

class Grabber implements \HPT\Grabber
{

	/** @var ProductPage */
	private $productPage;

	public function setProductId(string $productId): bool
	{
		$this->productPage = new ProductPage($productId);

		return $this->productPage->isLoaded();
	}

	public function getPrice(string $productId): float
	{
		return $this->productPage->getPrice();
	}

	public function getName(): ?string
	{
		return $this->productPage->getName();
	}

	public function getScore(): ?int
	{
		return $this->productPage->getScore();
	}
}
