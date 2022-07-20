<?php
//todo: change connection
if (!isset($conn)) {
    include '../../connection.php';
}

//info if we added new in db
$maxes = getMaxes($conn);
$maxVendor = $maxes[0];
$maxDestination = $maxes[1];
$maxLanguage = $maxes[2];

//info if updated something
$versionVendors = getDetailsFromTable($conn, 'Vendor');
$versionDestinations = getDetailsFromTable($conn, 'Destination');

//static data
$versionMenu = getStaticMax($conn, 1);

$details = array(
    'maxVendor'=> $maxVendor,
    'maxDestination'=> $maxDestination,
    'maxLanguage'=> $maxLanguage,
    'vendorsVersion'=> $versionVendors,
    'destinationsVersion'=> $versionDestinations,
    'menuVersion'=> $versionMenu
);

//send and received answer








function getDetailsFromTable($conn, $tableName) {
    $query = "SELECT T.id, T.version FROM $tableName AS T";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $versionNumber = "";
    $stmt->bind_result($id, $versionNumber);
    $details = [];
    while ($stmt->fetch()) {
        $details[$id] = $versionNumber;
    }
    return $details;
}

function getMaxes($conn) {
    $query = "select max(V.id), max(D.id), max(L.id)
        from Vendor AS V, Destination AS D, Language AS L";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $maxVendor = $maxDestination = $maxLanguage = 0;
    $stmt->bind_result($maxVendor, $maxDestination, $maxLanguage);
    while ($stmt->fetch()) {}
    $stmt->close();
    return [$maxVendor, $maxDestination, $maxLanguage];
}

function getStaticMax($conn, $idStatic) {
    $query = "select version
        from Version AS V
        WHERE id = $idStatic";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $version = 0;
    $stmt->bind_result($version);
    while ($stmt->fetch()) {}
    $stmt->close();
    return $version;
}