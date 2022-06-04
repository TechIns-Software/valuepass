<?php


namespace ValuePass;


class RatedCategory
{
    private string $name;
    private int $stars;

    /**
     * RatedCategory constructor.
     * @param string $name
     * @param int $stars
     */
    public function __construct(string $name, int $stars)
    {
        $this->name = $name;
        $this->stars = $stars;
    }

}