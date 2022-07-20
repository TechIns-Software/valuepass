<?php
include 'libraryInternal.php';
//TODO: authentication
//TODO: nice place to check if voucher are finally paid
if (!isset($conn)) {
    //TODO: our db connection
    include '../../connection.php';
}
if (
    isset(
        $_POST["maxVendor"],
        $_POST["maxDestination"],
        $_POST["maxLanguage"],
        $_POST["vendorsVersion"],
        $_POST["destinationsVersion"],
        $_POST["menuVersion"]
    )
    AND is_numeric($_POST["maxVendor"])
    AND is_numeric($_POST["maxDestination"])
    AND is_numeric($_POST["maxLanguage"])
    AND is_numeric($_POST["menuVersion"])
    AND is_array($_POST["vendorsVersion"])//associative array
    AND is_array($_POST["destinationsVersion"])//associative array
) {
    //todo: get best off if get vendors
    $languagesLogInfo = languagesLog($conn, $_POST["maxLanguage"]);
    $languagesArrayInfo = $languagesLogInfo['languages'];
    $vendorsIds = getVendorsIds($conn);
    if ($languagesLogInfo['refreshAll']) {
        //gamo to spiti tou panou pou vazei glossa, στις φωτο να γινεται ελεχος στην αλλη μερια

        $_POST["maxVendor"];
        $_POST["maxDestination"];


        foreach ($languagesArrayInfo as $language) {
            $languageId = $language['id'];
        }
        //we dont check for versions
    } else {
        //Languages have not been changed
        $languages = $languagesLogInfo['languages'];

        if ($_POST["maxVendor"] < $vendorsIds[count($vendorsIds) - 1]) {
            foreach ($languagesArrayInfo as $language) {
                $languageId = $language['id'];
                foreach ($vendorsIds as $vendorId) {
                    $vendor = getVendorsNew($conn, $vendorId, $languageId);
                }
            }
        } else {
            //is updated
        }
    }

    if ($_POST["maxVendor"] < 10) {
        //
    }
    if ($_POST["maxDestination"] < 10) {
        //
    }

    //todo: respond for each vendor-location the latest code (update code)
    //todo: best off when destination or vendor

}

//old versions
if (!isset($_POST["destinations"])) {
    $_POST["destinations"] = [2,3,4,5,6,7];
//    exit('Error: missing arguments');
}

$destinations = $_POST["destinations"];
if (count($destinations) == 0) {
    exit("Error: No Destinations Provided");
}

$stringOfIdDestinations = str_repeat('?,', count($destinations) - 1) . '?';
$query = "SELECT VV.id, VV.idVendor, VV.starterVouchers, VV.existenceVoucher, VV.dateVoucher 
        FROM VendorVoucher AS VV, Vendor AS V
        WHERE V.id = VV.idVendor AND V.idDestination IN ($stringOfIdDestinations)";
$stmt = $conn->prepare($query);
$types = str_repeat('i', count($destinations));
$stmt->bind_param($types, ...$destinations);
$vendorVouchers = [];
if ($stmt->execute()) {
    $id = $idVendor = $startersVouchers = $existenceVoucher = $dateVouchers = '';
    $stmt->bind_result($id, $idVendor, $startersVouchers, $existenceVoucher, $dateVouchers);
    while ($stmt->fetch()) {
        array_push($vendorVouchers, [$id, $idVendor, $startersVouchers, $existenceVoucher, $dateVouchers]);
    }
} else {
    $stmt->close();
    $conn->close();
    exit("Error: Something went wrong!");
}
return json_encode($vendorVouchers);
