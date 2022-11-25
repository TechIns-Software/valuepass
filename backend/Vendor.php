<?php


namespace ValuePass;


class Vendor
{
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
    private int $forHowManyPersonsIs;
    private string $googleMapsImage;
    private int $childAcceptance;
    private int $infantTolerance;
    private int $minAgeAdult;
    private int $minAgeKid;

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
    private int $maxVouchersToday;
    private int $availableVouchersToday;
    private array $availableDates = [];
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
     * @param string $pathToImage
     * @param string $name
     * @param int $forHowManyPersonsIs
     * @param string $googleMapsImage
     * @param int $childAcceptance
     * @param int $infantTolerance
     * @param int $minAgeAdult
     * @param int $minAgeKid
     */
    public function __construct(
        int    $id, int $categoryId, string $categoryName,
        int    $idDestination, float $priceAdult, float $originalPrice, float $discount,
        float  $priceKid, string $pathToImage,
        string $name, int $forHowManyPersonsIs, string $googleMapsImage,
        int    $childAcceptance, int $infantTolerance, int $minAgeAdult, int $minAgeKid
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
        $this->pathToImage = $pathToImage;
        $this->name = $name;
        $this->forHowManyPersonsIs = $forHowManyPersonsIs;
        $this->googleMapsImage = $googleMapsImage;
        $this->childAcceptance = $childAcceptance;
        $this->infantTolerance = $infantTolerance;
        $this->minAgeAdult = $minAgeAdult;
        $this->minAgeKid = $minAgeKid;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function addLabelBoxName($labelName): void
    {
        array_push($this->labelsBoxNames, $labelName);
    }

    public function addRatedCategory(RatedCategory $ratedCategory): void
    {
        array_push($this->ratedArray, $ratedCategory);
    }

    public function addSimpleField(
        $descriptionFull, $descriptionBig,
        $paymentActivityHead, $paymentActivityDesc
    ): void
    {
        $this->descriptionFull = str_replace(PHP_EOL, '<br><br>', $descriptionFull);
        $this->descriptionBig = str_replace(PHP_EOL, '<br><br>', $descriptionBig);
        $this->paymentInfoActivityHead = $paymentActivityHead;
        $this->paymentInfoActivityDescription = $paymentActivityDesc;
    }

    public function addImage(string $image): void
    {
        array_push($this->images, $image);
    }

    public function addHighlight(string $highlight): void
    {
        array_push($this->highlights, $highlight);
    }

    public function addIncludedService(IncludedService $includedService): void
    {
        array_push($this->includedServicesArray, $includedService);
    }

    public function addActivity(AboutActivity $aboutActivity)
    {
        array_push($this->aboutActivityArray, $aboutActivity);
    }

    public function addImportantInformation(ImportantInformation $importantInformation): void
    {
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

    /**
     * @return int
     */
    public function getForHowManyPersonsIs(): int
    {
        return $this->forHowManyPersonsIs;
    }

    /**
     * @return string
     */
    public function getGoogleMapsImage(): string
    {
        return $this->googleMapsImage;
    }

    /**
     * @return string
     */
    public function getForHowManyPersonsIsString($perPerson = '', $forParticicants = '', $forParticicants2 = '', $perGroup = ''): string
    {
        if ($this->getForHowManyPersonsIs() != 99) {
            if ($this->getForHowManyPersonsIs() == 1) {

                return $perPerson;
            } else {
                return $forParticicants . ' ' . $this->getForHowManyPersonsIs() . ' ' . $forParticicants2;
            }
        } else {
            return $perGroup;
        }
    }

    /**
     * @param int $maxVouchersToday
     */
    public function setMaxVouchersToday(int $maxVouchersToday): void
    {
        $this->maxVouchersToday = $maxVouchersToday;
    }


    /**
     * @param int $availableVouchersToday
     */
    public function setAvailableVouchersToday(int $availableVouchersToday): void
    {
        $this->availableVouchersToday = $availableVouchersToday;
    }

    /**
     * @return string
     */
    public function getAvailabilityTodayVoucher(): string
    {
        return $this->availableVouchersToday . '/' . $this->maxVouchersToday;
    }

    /**
     * @return bool
     */
    public function isChildAcceptance(): bool
    {
        return $this->childAcceptance != 0;
    }

    /**
     * @return bool
     */
    public function isInfantTolerance(): bool
    {
        return $this->infantTolerance != 0;
    }

    /**
     * @return int
     */
    public function getMinAgeAdult(): int
    {
        return $this->minAgeAdult;
    }

    /**
     * @return int
     */
    public function getMinAgeKid(): int
    {
        return $this->minAgeKid;
    }

    /**
     * @return int
     */
    public function getMaxAgeKid(): int
    {
        return $this->minAgeAdult - 1;
    }

    /**
     * @return int
     */
    public function getMaxAgeInfant(): int
    {
        return $this->minAgeKid - 1;
    }

    /**
     * @return string
     */
    public function getLabelChild(): string
    {
        return "(" .$this->getMinAgeKid() .'-' .$this->getMaxAgeKid() .')';
    }

    /**
     * @return string
     */
    public function getLabelInfant(): string
    {
        return "(0-" .$this->getMaxAgeInfant() .')';
    }

    /**
     * @return string
     */
    public function getLabelAdults($onePersonText, $smallGroup1text, $smallGroup2text, $isBasicLabelForShowing = false, $groupWord = 'Group '): string
    {
        $labelReturn = '';
        if ($this->getForHowManyPersonsIs() == 1) {
            $labelReturn .= $onePersonText;
        } else {
            $labelReturn .= $groupWord;
            if ($this->getForHowManyPersonsIs() != 99) {
                $labelReturn .= $smallGroup1text .' '
                    .$this->getForHowManyPersonsIs() .' ' .$smallGroup2text;
            }
        }
        if (!$isBasicLabelForShowing) {
            $labelReturn .= ' <small>('.$this->getMinAgeAdult() .'-99)</small>';
        }
        return $labelReturn;
    }

    /**
     * @return array
     */
    public function getAvailableDates(): array
    {
        return $this->availableDates;
    }

    /**
     * @param array $availableDates
     */
    public function setAvailableDates(array $availableDates): void
    {
        $this->availableDates = $availableDates;
    }


}
