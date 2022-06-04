<?php


namespace ValuePass;


class Vendor {
    private int $id;
    private int $categoryId;
    private string $categoryName;
    private int $idDestination;
    private int $priceAdult;
    private int $originalPrice;
    private int $discount;
    private int $priceKid;
    private string $pathToImage;
    private string $name;
    private string $descriptionSmall;

    private array $labelsBoxNames = [];
    private array $ratedArray = [];

    private string $paymentInfoActivityHead;
    private string $paymentInfoActivityDescription;
    private string $descriptionFull;
    private string $descriptionBig;
    private array $images = [];
    private array $highlights = [];
    private array $includedServicesArray = [];
    private array $aboutActivityArray = [];
    private array $importantInformationArray = [];

    private array $vouchers = array();

    /**
     * Vendor constructor.
     * @param int $id
     * @param int $categoryId
     * @param string $categoryName
     * @param int $idDestination
     * @param int $priceAdult
     * @param int $originalPrice
     * @param int $discount
     * @param int $priceKid
     * @param string $descriptionSmall
     * @param string $pathToImage
     * @param string $name
     */
    public function __construct(
        int $id, int $categoryId, string $categoryName,
        int $idDestination, int $priceAdult, int $originalPrice, int $discount,
        int $priceKid, string $descriptionSmall, string $pathToImage,
        string $name
    )
    {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
        $this->idDestination = $idDestination;
        $this->priceAdult = $priceAdult;
        $this->originalPrice = $originalPrice;
        $this->discount = $discount;
        $this->priceKid = $priceKid;
        $this->descriptionSmall = $descriptionSmall;
        $this->pathToImage = $pathToImage;
        $this->name = $name;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function addLabelBoxName($labelName) : void {
        array_push($this->labelsBoxNames, $labelName);
    }

    public function addRatedCategory($nameRated, $stars) : void {
        array_push($this->ratedArray, [$nameRated, $stars]);
    }

    public function addImage($image) : void {
        array_push($this->images, $image);
    }


}
