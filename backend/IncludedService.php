<?php


namespace ValuePass;


class IncludedService {
    private string $name;

    /**
     * IncludedService constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}