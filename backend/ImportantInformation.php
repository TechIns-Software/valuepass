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
    public function __construct(string $head)
    {
        $this->head = $head;
    }

    public function addDescription(string $description) {
        array_push($this->descriptions, $description);
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return array
     */
    public function getDescriptions(): array
    {
        return $this->descriptions;
    }
}