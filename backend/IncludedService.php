<?php


namespace ValuePass;


class IncludedService {
    private int $id;
    private string $name;
    /**
     * IncludedService constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        array_push(IncludedService::$allIncludedServices, $this);
    }

}