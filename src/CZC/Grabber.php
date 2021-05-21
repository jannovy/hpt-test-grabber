<?php

declare(strict_types=1);

namespace HPT\CZC;

class Grabber implements \HPT\Grabber
{

	public function getPrice(string $productId): float
	{
		return (new ProductPage($productId))->getPrice();
	}
}
