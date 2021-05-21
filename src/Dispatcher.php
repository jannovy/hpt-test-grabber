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

			// Is ProductPage loaded ?
			if($this->grabber->setProductId($productId)) {

				// Get Price
				$price = $this->grabber->getPrice($productId);

				// Add collection to Output
				$this->output->add($productId, [
					'price' => $price ? $price : null,
					'name' =>  $this->grabber->getName(),
					'score' => $this->grabber->getScore(),
				]);
			} else {
				$this->output->add($productId, null);
			}
		}

		// Return Output as JSON to STDOUT
		fwrite(STDOUT, $this->output->getJson());
    }
}
