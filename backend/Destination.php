<?php


namespace ValuePass;


class Destination {
    private int $id;
    private string $name;
    private string $description;
    private string $image1;
    private string $image2;
    private int $numberOfVendors;

    /**
     * Destination constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $image1
     * @param string $image2
     * @param int $numberOfVendors
     */
    public function __construct(
        int $id, string $name, string $description,
        string $image1 = '', string $image2 = '', int $numberOfVendors = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->numberOfVendors = $numberOfVendors;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImage1(): string
    {
        return $this->image1;
    }

    /**
     * @return string
     */
    public function getImage2(): string
    {
        return $this->image2;
    }

    /**
     * @return int
     */
    public function getNumberOfVendors(): int
    {
        return $this->numberOfVendors;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }





}