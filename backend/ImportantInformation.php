<?php


namespace ValuePass;


class ImportantInformation
{
    private string $head;
    private array $descriptions;

    /**
     * ImportantInformation constructor.
     * @param string $head
     * @param array $descriptions
     */
    public function __construct(string $head, array $descriptions)
    {
        $this->head = $head;
        $this->descriptions = $descriptions;
    }

}