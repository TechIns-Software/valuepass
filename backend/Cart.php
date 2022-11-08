<?php

namespace ValuePass;


class Cart
{
    public static int $MAX_VOUCHERS = 25;
    private array $arrayGroupVouchersWant = [];
    //We will keep vendorAvailability id
    //TODO: always reload session obj when return from functions call
    //TODO: think about voucher not is only about unique id but also save preference of voucher
    /**
     * Cart constructor.
     * @param array $arrayGroupVouchersWant
     */

    //ok
    public function __construct(array $arrayGroupVouchersWant = [])
    {
        $this->arrayGroupVouchersWant = $arrayGroupVouchersWant;
    }

    /**
     * @return array
     */
    public function getArrayGroupVouchersWant(): array
    {
        return $this->arrayGroupVouchersWant;
    }



    private function checkBottomLimit($newItems = 0) : bool {
        foreach ($this->arrayGroupVouchersWant as $groupVoucherWant) {
            $newItems = $newItems + count($groupVoucherWant);
        }
        return $newItems >= 2;
    }

    //ok
    private function checkUpperLimit($newItems = 0) : bool {
        foreach ($this->arrayGroupVouchersWant as $groupVoucherWant) {
            $newItems = $newItems + count($groupVoucherWant);
        }
        return $newItems <= self::$MAX_VOUCHERS;
    }

    //ok
    public function addItemsToCart(array $groupVoucherWant, $conn) : array {
        $message = [
            'status'=> 0,
            'message'=> ''
        ];
        //see if can add
        if ($this->checkUpperLimit(count($groupVoucherWant))) {
            //see if can buy from one vendor all these vouchers
            $vendorVoucherIdWant = $groupVoucherWant[0];
            $ids = $this->getConcentratedVendorVoucherIds();
            $idAdded = $vendorVoucherIdWant->getIdVendorVoucher();
            $newTotalNumber = 0;
            $flagExistAlreadyVendorVoucher = false;
            if (isset($ids[$idAdded])) {
                $newTotalNumber = $ids[$idAdded];
                $flagExistAlreadyVendorVoucher = true;
            }
            $newTotalNumber = $newTotalNumber + count($groupVoucherWant);
            //we get the max voucher can have, if does not exist we get 0
            $maxVoucherFromVendorThatCanHave = getMaxVendorVoucher($conn, $idAdded);

            if ($newTotalNumber <= $maxVoucherFromVendorThatCanHave) {
                //is not checked if infants and children are ok with vendorVoucher
                //we check in interval server
                if ($flagExistAlreadyVendorVoucher) {
                    $this->addItemInAlreadyVendorVoucher($groupVoucherWant);
                } else {
                    array_push($this->arrayGroupVouchersWant, $groupVoucherWant);
                }
                $message = [
                    'status'=> 1,
                    'message'=> 'OK'
                ];
            } else {
                $msg = "Can Not Have More Than $maxVoucherFromVendorThatCanHave vouchers in that specific time";
                $message = [
                    'status'=> 0,
                    'message'=> $msg
                ];
            }

        } else {
            $msg = "You can have up to " .self::$MAX_VOUCHERS ." vouchers totally selected";
            $message = [
                'status'=> 0,
                'message'=> $msg
            ];
        }
        return $message;
    }


    //ok
    public function removeItemFromCart($idItem) : string {
        if ($idItem <= count($this->arrayGroupVouchersWant)) {
            array_splice($this->arrayGroupVouchersWant, $idItem, 1);
            $message = 'OK';
        } else {
            $message = 'Wrong Input Given';
        }
        return $message;
    }


    public function progressForPayment() : bool|string {
        $isBottomOk = $this->checkBottomLimit();
        $isUpperOk = $this->checkUpperLimit();
        if ($isUpperOk && $isBottomOk) {
            return true;
        } elseif (!$isBottomOk) {
            return 'lessProducts';
        } else {
            return 'muchProducts';
        }
    }
    //ok
    public function getConcentratedVendorVoucherIds() : array {
        $ids = array();
        foreach ($this->arrayGroupVouchersWant as $groupVoucherWant) {
            if (isset($ids[$groupVoucherWant[0]->getIdVendorVoucher()])) {
                $ids[$groupVoucherWant[0]->getIdVendorVoucher()]
                    = $ids[$groupVoucherWant[0]->getIdVendorVoucher()] + count($groupVoucherWant);
            } else {
                $ids[$groupVoucherWant[0]->getIdVendorVoucher()] = count($groupVoucherWant);
            }
        }
        return $ids;
    }

    public function removeIdsFromGroupOfVouchers($arrayIds) : void {
        $flagFound = false;
        foreach ($arrayIds as $idsRemove) {
            for ($counter = 0; $counter < count($this->arrayGroupVouchersWant); $counter++) {
                $idItemOfVouchers = $this->arrayGroupVouchersWant[$counter][0]->getIdVendor();
                if ($idItemOfVouchers == $idsRemove) {
                    //TODO: check it for no ending loop
                    $this->removeItemFromCart($counter);
                    $flagFound = true;
                    break;
                }
            }

        }
        if ($flagFound) {
            $this->removeIdsFromGroupOfVouchers($arrayIds);
        }
    }

    public function getNumberOfVoucher() : int {
        $sum = 0;
        foreach ($this->arrayGroupVouchersWant as $groupVoucherWant) {
            $sum = $sum + count($groupVoucherWant);
        }
        return $sum;
    }

    public function readyForSendingVendorVoucherData() : array {
        $products = [];
        foreach ($this->arrayGroupVouchersWant as $arrayGroupVoucherWant) {
            //
            foreach ($arrayGroupVoucherWant as $voucherWant) {
                $product = array(
                    'idVendorVoucher'=> $voucherWant->getIdVendorVoucher(),
                    'isAdult'=> $voucherWant->isAdult(),
                    'numberInfants'=> $voucherWant->getNumberOfInfant(),
                );
                array_push($products, $product);
            }
        }
        return $products;
    }

    public function checkIfVendorVouchersInCartStillExists($conn): void {
        $vendorVoucher = $this->getConcentratedVendorVoucherIds();
        $stillAvailableVendorVoucher = getAvailableVendorVoucher($conn, $vendorVoucher);
        $indexesToBeRemoved = [];
        foreach ($this->arrayGroupVouchersWant as $keyIndex=> $groupOfVouchers) {
            $idVendorVoucher = $groupOfVouchers[0]->getIdVendorVoucher();
            if (!in_array($idVendorVoucher, $stillAvailableVendorVoucher)) {
                array_push($indexesToBeRemoved, $keyIndex);
            }
        }
        foreach ($indexesToBeRemoved as $indexToRemoved) {
            unset($this->arrayGroupVouchersWant[$indexToRemoved]);
        }
    }
    private function addItemInAlreadyVendorVoucher($groupVoucherWant) {
        $idVendorVoucherAdded = $groupVoucherWant[0]->getIdVendorVoucher();
        $foundIndex = -1;
        for ($counter = 0; $counter < count($this->arrayGroupVouchersWant); $counter++) {
            $groupInside = $this->arrayGroupVouchersWant[$counter];
            $idVendorVoucherWantInside = $groupInside[0]->getIdVendorVoucher();
            if ($idVendorVoucherWantInside == $idVendorVoucherAdded) {
                $foundIndex = $counter;
                break;
            }
        }
        if ($foundIndex != -1) {
            $groupVoucherWantThatExists = $this->arrayGroupVouchersWant[$foundIndex];

            $infantInNewGroup = $groupVoucherWant[0]->getNumberOfInfant();
            $groupVoucherWant[0]->addNewInfantNumber($infantInNewGroup * (-1));
            $groupVoucherWantThatExists[0]->addNewInfantNumber($infantInNewGroup);
            array_push($groupVoucherWantThatExists, ...$groupVoucherWant);
            $this->arrayGroupVouchersWant[$foundIndex] = $groupVoucherWantThatExists;
        }
    }
}