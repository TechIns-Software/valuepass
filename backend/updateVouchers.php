<?php
include_once 'updateLibrary.php';

if (!isset($conn)) {
    include '../connection.php';
}

$targetFileName = './updateVouchers.json';
$fileDestination = 'https://valuepass.gr/request/update/updateVouchers.json';
@$file = file_get_contents($fileDestination);
if ($file) {
    file_put_contents(
        $targetFileName,
        $file
    );

}

if (!file_exists('updateVouchers.json')) {
    exit('No file found!');
}

$json = file_get_contents('updateVouchers.json');
$response = json_decode($json, true);
$idVendorVoucherExists = getIdVendorVoucher($conn);
$idVendorExistsAgain = [];
foreach ($response as $idVendorVoucher=> $vendorVoucherObj) {
    $idVendorVoucher = intval($idVendorVoucher);

    $idVendor = $vendorVoucherObj['idVendor'];
    $isDateRestrict = $vendorVoucherObj['isDateRestrict'];
    $starterVoucher = $vendorVoucherObj['starterVouchers'];
    $existenceVoucher = $vendorVoucherObj['existenceVoucher'];
    $dateVoucher = $vendorVoucherObj['dateVoucher'];
    $isUpdated = in_array($idVendorVoucher, $idVendorVoucherExists);
    if ($isUpdated) {
        array_push($idVendorExistsAgain, $idVendorVoucher);
    }
    vendorVoucherProcedure($conn, $idVendorVoucher, $idVendor,
        $isDateRestrict, $starterVoucher, $existenceVoucher,
        $dateVoucher, $isUpdated);

}
$toRemovedVendorVoucher = array_diff($idVendorVoucherExists, $idVendorExistsAgain);
removeVendorVoucher($conn, $toRemovedVendorVoucher);

