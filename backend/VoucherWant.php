<?php


namespace ValuePass;


class VoucherWant
{
    private int $idVendorVoucher;
    private int $idVendor;
    private bool $isAdult;
    private int $numberOfInfant;
    private float $price;

    /**
     * VoucherWant constructor.
     * @param int $idVendorVoucher
     * @param int $idVendor
     * @param bool $isAdult
     * @param int $numberOfInfant
     */
    public function __construct(int $idVendorVoucher, int $idVendor, bool $isAdult, int $numberOfInfant = 0)
    {
        $this->idVendorVoucher = $idVendorVoucher;
        $this->idVendor = $idVendor;
        $this->isAdult = $isAdult;
        $this->numberOfInfant = $numberOfInfant;
    }


    /**
     * @return int
     */
    public function getIdVendorVoucher(): int
    {
        return $this->idVendorVoucher;
    }

    /**
     * @return bool
     */
    public function isAdult(): bool
    {
        return $this->isAdult;
    }

    /**
     * @return int
     */
    public function getNumberOfInfant(): int
    {
        return $this->numberOfInfant;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getIdVendor(): int
    {
        return $this->idVendor;
    }


}