<?php


namespace ValuePass;


class IncludedService {
    private string $name;
    private string $icon;

    /**
     * IncludedService constructor.
     * @param string $name
     * @param string $icon
     */
    public function __construct(string $name, string $icon)
    {
        $this->name = $name;
        $this->icon = $icon;
    }


}