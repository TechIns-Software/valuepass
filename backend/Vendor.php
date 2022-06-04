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

    public function addRatedCategory(RatedCategory $ratedCategory) : void {
        array_push($this->ratedArray, $ratedCategory);
    }

    public function addSimpleField(
        $descriptionFull, $descriptionBig,
        $paymentActivityHead, $paymentActivityDesc
    ) : void {
        $this->descriptionFull = $descriptionFull;
        $this->descriptionBig = $descriptionBig;
        $this->paymentInfoActivityHead = $paymentActivityHead;
        $this->paymentInfoActivityDescription = $paymentActivityDesc;
    }

    public function addImage(string $image) : void {
        array_push($this->images, $image);
    }

    public function addHighlight(string $highlight) : void {
        array_push($this->highlights, $highlight);
    }

    public function addIncludedService(IncludedService $includedService) : void {
        array_push($this->includedServicesArray, $includedService);
    }

    public function addActivity(AboutActivity $aboutActivity) {
        array_push($this->aboutActivityArray, $aboutActivity);
    }

    public function addImportantInformation(ImportantInformation $importantInformation) : void {
        array_push($this->importantInformationArray, $importantInformation);
    }
}
