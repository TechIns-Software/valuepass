<?php


namespace ValuePass;


class Vendor {
    private int $id;
    private int $categoryId;
    private string $categoryName;
    private int $idDestination;
    private float $priceAdult;
    private float $originalPrice;
    private float $discount;
    private float $priceKid;
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

    public static int $MAX_STARS = 5;

    /**
     * Vendor constructor.
     * @param int $id
     * @param int $categoryId
     * @param string $categoryName
     * @param int $idDestination
     * @param float $priceAdult
     * @param float $originalPrice
     * @param float $discount
     * @param float $priceKid
     * @param string $descriptionSmall
     * @param string $pathToImage
     * @param string $name
     */
    public function __construct(
        int $id, int $categoryId, string $categoryName,
        int $idDestination, float $priceAdult, float $originalPrice, float $discount,
        float $priceKid, string $descriptionSmall, string $pathToImage,
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

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getLabelsBoxNames(): array
    {
        return $this->labelsBoxNames;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @return int
     */
    public function getPriceAdult(): float
    {
        return $this->priceAdult;
    }

    /**
     * @return int
     */
    public function getOriginalPrice(): float
    {
        return $this->originalPrice;
    }

    /**
     * @return array
     */
    public function getAboutActivityArray(): array
    {
        return $this->aboutActivityArray;
    }

    /**
     * @return string
     */
    public function getPaymentInfoActivityHead(): string
    {
        return $this->paymentInfoActivityHead;
    }

    /**
     * @return string
     */
    public function getPaymentInfoActivityDescription(): string
    {
        return $this->paymentInfoActivityDescription;
    }

    /**
     * @return string
     */
    public function getDescriptionBig(): string
    {
        return $this->descriptionBig;
    }

    /**
     * @return array
     */
    public function getHighlights(): array
    {
        return $this->highlights;
    }

    /**
     * @return string
     */
    public function getDescriptionFull(): string
    {
        return $this->descriptionFull;
    }

    /**
     * @return array
     */
    public function getIncludedServicesArray(): array
    {
        return $this->includedServicesArray;
    }

    /**
     * @return array
     */
    public function getImportantInformationArray(): array
    {
        return $this->importantInformationArray;
    }

    /**
     * @return array
     */
    public function getRatedArray(): array
    {
        return $this->ratedArray;
    }

    /**
     * @return string
     */
    public function getDescriptionSmall(): string
    {
        return $this->descriptionSmall;
    }

    /**
     * Find average rated
     * @return int
     */
    public function getAverageRated(): int
    {
        $sum = 0;
        foreach ($this->ratedArray as $rated) {
            $sum = $sum + $rated->getStars();
        }
        if (count($this->ratedArray) == 0) {
            return 0;
        } else {
            return round($sum / count($this->ratedArray));
        }
    }

    /**
     * @return string
     */
    public function getPathToImage(): string
    {
        return $this->pathToImage;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return int
     */
    public function getIdDestination(): int
    {
        return $this->idDestination;
    }
}
