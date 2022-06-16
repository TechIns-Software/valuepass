<?php

namespace ValuePass;


class Cart
{
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
        return $newItems <= 11;
    }

    //ok
    public function addItemsToCart(array $groupVoucherWant, $conn) : string {
        //see if can add
        if ($this->checkUpperLimit(count($groupVoucherWant))) {
            //see if can buy from one vendor all these vouchers
            $voucherIdWant = $groupVoucherWant[0];
            $ids = $this->getConcentratedVendorVoucherIds();
            $idAdded = $voucherIdWant->getIdVendorVoucher();
            $newTotalNumber = 0;
            if (isset($ids[$idAdded])) {
                $newTotalNumber = $ids[$idAdded];
            }
            $newTotalNumber = $newTotalNumber + 1;
            //we get the max voucher can have, if does not exist we get 0
            $maxVoucherFromVendorThatCanHave = getMaxVendorVoucher($conn, $idAdded);

            if ($newTotalNumber < $maxVoucherFromVendorThatCanHave) {
                //TODO: check if they are permission to be checked, fe infants and children
                //TODO: if exists infants then only with parents
                array_push($this->arrayGroupVouchersWant, $groupVoucherWant);
                $message = "OK";
            } else {
                $message = "Can Not Have More Than $maxVoucherFromVendorThatCanHave vouchers in that specific time";
            }

        } else {
            $message = 'You can have up to 11 vouchers totally selected';
        }
        return $message;
    }

    public function checkIfVoucherStillAvailable() : string {

        return 'Something has changed because of voucher availability';
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
                    = $ids[$groupVoucherWant[0]->getIdVendorVoucher()] + 1;
            } else {
                $ids[$groupVoucherWant[0]->getIdVendorVoucher()] = 1;
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

}