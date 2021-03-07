<?php


namespace Domain\Base;


class BaseString
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function rawValue(): string
    {
        return $this->value;
    }
}
