<?php


namespace ValuePass;


class VoucherWant
{
    private int $idVendorVoucher;
    private bool $isAdult;
    private int $numberOfInfant;

    /**
     * VoucherWant constructor.
     * @param int $idVendorVoucher
     * @param bool $isAdult
     * @param int $numberOfInfant
     */
    public function __construct(
        int $idVendorVoucher,
        bool $isAdult,
        int $numberOfInfant = 0)
    {
        $this->idVendorVoucher = $idVendorVoucher;
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

}