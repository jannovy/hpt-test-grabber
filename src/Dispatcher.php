<?php

declare(strict_types=1);

namespace HPT;

class Dispatcher
{
    /** @var Grabber */
    private $grabber;

    /** @var Output */
    private $output;

    public function __construct(Grabber $grabber, Output $output)
    {
        $this->grabber = $grabber;
        $this->output = $output;
    }

    public function run(string $input): void
    {
    	// Get all product ids from input file as array
		$productIds = explode("\r\n", trim(file_get_contents($input)));

		// Find price for every single productId
		foreach ($productIds as $productId) {

			// Get price (or 0)
			$price = $this->grabber->getPrice($productId);

			// Add productId and price collection to Output
			$this->output->add($productId, $price ? ['price' => $price] : null);
		}

		// Return Output as JSON to STDOUT
		fwrite(STDOUT, $this->output->getJson());
    }
}
