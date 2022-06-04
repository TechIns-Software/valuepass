<?php


namespace ValuePass;


class AboutActivity
{
    private string $head;
    private string $description;

    /**
     * AboutActivity constructor.
     * @param string $head
     * @param string $description
     */
    public function __construct(string $head, string $description)
    {
        $this->head = $head;
        $this->description = $description;
    }

}