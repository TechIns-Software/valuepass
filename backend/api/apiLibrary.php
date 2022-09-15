<?php

function getImageBasicVendors($conn) {
    $query = "SELECT id, imageBasic,
       imageBasicVersion, googleMapsImage, googleMapsImageVersion
            FROM Vendor;";
    $stmt = $conn->prepare($query);
    $imagesBasicVendor = [];
    if ($stmt->execute()) {
        $idVendor = $imageBasic = $imageBasicVersion = $googleMapsImage = $googleMapsImageVersion = "";
        $stmt->bind_result($idVendor, $imageBasic, $imageBasicVersion, $googleMapsImage, $googleMapsImageVersion);
        while ($stmt->fetch()) {
            $imagesBasicVendor[intval($idVendor)] = array(
                'imageBasic'=> $imageBasic,
                'imageBasicVersion'=> $imageBasicVersion,
                'googleMapsImage'=> $googleMapsImage,
                'googleMapsImageVersion'=> $googleMapsImageVersion
            );
        }
    }
    $stmt->close();
    return $imagesBasicVendor;
}


function getImageVendors($conn) {
    $query = "SELECT id, idVendor FROM VendorImages;";
    $stmt = $conn->prepare($query);
    $imagesAvailable = [];
    if ($stmt->execute()) {
        $idImage = $idVendor = "";
        $stmt->bind_result($idImage, $idVendor);
        while ($stmt->fetch()) {
            if (!isset($imagesAvailable[$idVendor])) {
                $imagesAvailable[$idVendor] = [];
                array_push($imagesAvailable[$idVendor], intval($idImage));
            } else {
                array_push($imagesAvailable[$idVendor], intval($idImage));
            }
        }
    }
    $stmt->close();
    return $imagesAvailable;
}


function getNotOkForShowingVendors($conn) {
    $query = "SELECT id FROM Vendor WHERE isOkForShowing = 0;";
    $stmt = $conn->prepare($query);
    $notOkVendors = [];
    if ($stmt->execute()) {
        $idVendor = "";
        $stmt->bind_result($idVendor);
        while ($stmt->fetch()) {
            array_push($notOkVendors, intval($idVendor));
        }
    }
    $stmt->close();
    return $notOkVendors;
}

function getDestinationsImagesDetails($conn) {
    $query = "SELECT id, image1, image2, image1Version, image2Version
            FROM Destination;";
    $stmt = $conn->prepare($query);
    $destinations = [];
    if ($stmt->execute()) {
        $idDestination = $image1 = $image1Version = $image2 = $image2Version = "";
        $stmt->bind_result($idDestination, $image1, $image2, $image1Version, $image2Version);
        while ($stmt->fetch()) {
            $destinations[intval($idDestination)] = array(
                'image1'=> $image1,
                'image1Version'=> $image1Version,
                'image2'=> $image2,
                'image2Version'=> $image2Version
            );
        }
    }
    $stmt->close();
    return $destinations;
}

function getNotOkForShowingDestinations($conn) {
    $query = "SELECT id FROM Destination WHERE isOkForShowing = 0;";
    $stmt = $conn->prepare($query);
    $notOkVendors = [];
    if ($stmt->execute()) {
        $idDestination = "";
        $stmt->bind_result($idDestination);
        while ($stmt->fetch()) {
            array_push($notOkVendors, intval($idDestination));
        }
    }
    $stmt->close();
    return $notOkVendors;
}

function getVersions($conn) {
    $query = "SELECT name, version FROM Version;";
    $stmt = $conn->prepare($query);
    $versions = [];
    if ($stmt->execute()) {
        $name = $version = "";
        $stmt->bind_result($name, $version);
        while ($stmt->fetch()) {
            $versions[$name] = $version;
        }
    }
    $stmt->close();
    return $versions;
}

function getIdsOfArray($conn, $tableName) {
    $query = "SELECT id FROM $tableName;";
    $stmt = $conn->prepare($query);
    $ids = [];
    if ($stmt->execute()) {
        $id = "";
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            array_push($ids, intval($id));
        }
    }
    $stmt->close();
    return $ids;
}

function getAllIds($conn) {
    $tablesName = [
        'Destination', 'CategoryVendor',
        'Vendor', 'LabelsBox', 'IncludedService', 'Language'
    ];
    $allIds = [];
    foreach ($tablesName as $tableName) {
        $allIds[$tableName] = getIdsOfArray($conn, $tableName);
    }
    return $allIds;
}

function getIdVersionOfElementsOfArray($conn, $tableName) {
    $query = "SELECT id, version FROM $tableName;";
    $stmt = $conn->prepare($query);
    $versions = [];
    if ($stmt->execute()) {
        $id = $version = "";
        $stmt->bind_result($id, $version);
        while ($stmt->fetch()) {
            $versions[intval($id)] = $version;
        }
    }
    $stmt->close();
    return $versions;
}
