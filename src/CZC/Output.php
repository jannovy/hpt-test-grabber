<?php

declare(strict_types=1);

namespace HPT\CZC;

class Output implements \HPT\Output
{
	/** @var $array */
	private $items;

	public function add(string $code, ?array $values): void
	{
		$this->items[$code] = $values;
	}

    public function getJson(): string
	{
		return json_encode($this->items, JSON_FORCE_OBJECT);
	}
}
