<?php


namespace ValuePass;


class IncludedService {
    private string $name;
    private int $icon;

    /**
     * IncludedService constructor.
     * @param string $name
     * @param int $icon
     */
    public function __construct(string $name, int $icon)
    {
        $this->name = $name;
        $this->icon = $icon;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getIcon(): int
    {
        return $this->icon;
    }
}