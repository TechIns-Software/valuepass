<?php
//TODO: authentication
//TODO: nice place to check if voucher are finally paid
if (!isset($_POST["destinations"])) {
    $_POST["destinations"] = [2,3,4,5,6,7];
//    exit('Error: missing arguments');
}

if (!isset($conn)) {
    //TODO: our db connection
    include '../../connection.php';
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
