<?php


namespace Domain\Base;


class BaseId
{
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function rawValue(): int
    {
        return $this->value;
    }
}
