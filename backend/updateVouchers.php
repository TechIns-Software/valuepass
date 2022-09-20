<?php
include_once 'api/apiLibrary.php';

if (!isset($conn)) {
    include '../connection.php';
}

$targetFileName = './updateVoucherVendor.json';
$fileDestination = 'https://valuepass.gr/request/update/updateVoucherVendor.json';
@$file = file_get_contents($fileDestination);
if ($file) {
    file_put_contents(
        $targetFileName,
        $file
    );

}

if (!file_exists('update.json')) {
    exit('No file found!');
}

$json = file_get_contents('update.json');
$response = json_decode($json, true);
$idVendorVoucherExists = getIdVendorVoucher($conn);
foreach ($response as $idVendorVoucher=> $vendorVoucherObj) {
    $idVendorVoucher = intval($idVendorVoucher);

    $idVendor = $vendorVoucherObj['idVendor'];
    $isDateRestrict = $vendorVoucherObj['isDateRestrict'];
    $starterVoucher = $vendorVoucherObj['starterVoucher'];
    $existenceVoucher = $vendorVoucherObj['existenceVoucher'];
    $dateVoucher = $vendorVoucherObj['dateVoucher'];
    $isUpdated = in_array($idVendorVoucher, $idVendorVoucherExists);
    vendorVoucherProcedure($conn, $idVendorVoucher, $idVendor,
        $isDateRestrict, $starterVoucher, $existenceVoucher,
        $dateVoucher, $isUpdated);

}