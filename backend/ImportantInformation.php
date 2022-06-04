<?php


namespace ValuePass;


class ImportantInformation
{
    private string $head;
    private array $descriptions = [];

    /**
     * ImportantInformation constructor.
     * @param string $head
     */
    public function __construct(string $head, array $descriptions)
    {
        $this->head = $head;
    }

    public function addDescription(string $description) {
        array_push($this->descriptions, $description);
    }

}