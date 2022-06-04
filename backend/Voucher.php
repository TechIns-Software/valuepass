<?php


namespace ValuePass;



class Voucher
{
    private int $id;
    private Vendor $vendor;
    private int $status;
    private int $priceAdult;
    private int $priceKid;
    private int $selected;
    private bool $dateRestriction;
    private \DateTime $date;
    private string $nameGiven;

    /**
     * Voucher constructor.
     * @param int $id
     * @param Vendor $vendor
     * @param int $status
     * @param int $priceAdult
     * @param int $priceKid
     * @param bool $dateRestriction
     * @param \DateTime $date
     */
    public function __construct(
        int $id, Vendor $vendor, int $status, int $priceAdult, int $priceKid,
        bool $dateRestriction, \DateTime|null $date=NULL)
    {
//        DATE_FORMAT(date, '%Y-%m-%d %H:%i:%s')
        //createFromFormat('Y-m-d H:i:s', $mysql_source_date)
        $this->id = $id;
        $this->vendor = $vendor;
        $this->status = $status;
        $this->priceAdult = $priceAdult;
        $this->priceKid = $priceKid;
        $this->dateRestriction = $dateRestriction;
        $this->date = $date;
        array_push(self::$allVouchers, $this);
    }


    public static function delete(){}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}