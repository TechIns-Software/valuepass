<?php

include_once 'updateLibrary.php';


if (!isset($conn)) {
    include '../connection.php';
}
$targetFileName = './update.json';
$fileDestination = 'https://valuepass.gr/request/update/update.json';
@$file = file_get_contents($fileDestination);
if ($file) {
    file_put_contents(
        $targetFileName,
        $file
    );

} else {
    exit('Did not download');
}

if (!file_exists('update.json')) {
    exit('No file found!');
}

$json = file_get_contents('update.json');
$response = json_decode($json, true);
$element_expected = array(
    'version',
    'languages',
    'destinations',
    'categoryVendor',
    'paymentInfoActivity',
    'labelsBox',
    'ratedCategory',
    'includedService',
    'vendors',
    'menu'
);

foreach ($element_expected as $idVendor => $version) {
    if (!array_key_exists($version, $response)) {
        exit('File is not well structured');
    }
}

// # Start only for data
// # Step 1: Check if something is updated
$versions = getVersions($conn);
if ($versions['general'] < $response['version']) {
    if ($versions['destination'] < $response['destinations']['version']) {
        $idsOfDestination = getIdVersionOfElementsOfArrayWithVersion($conn, 'Destination');
        foreach ($response['destinations'] as $idDestination => $destinationValue) {
            if ($idDestination != 'version') {

                $idDestination = intval($idDestination);
                if (array_key_exists($idDestination, $idsOfDestination)) {


                    if ($idsOfDestination[$idDestination] < $destinationValue['version']) {


                        foreach ($destinationValue['languages'] as $idLanguage => $destLangObj) {
                            updateDestinationLanguages(
                                $conn, $idLanguage, $idDestination,
                                $destLangObj['name'], $destLangObj['description'],
                                $destinationValue['version'], $destinationValue['mappingString']
                            );

                        }

                    }
                }

            }

        }

    }

    if ($versions['categoryVendor'] < $response['categoryVendor']['version']) {

        $idsOfCategoryVendor = getIdVersionOfElementsOfArray($conn, 'CategoryVendor');
        foreach ($response['categoryVendor'] as $idCategoryVendor => $idCategoryVendorValue) {
            if ($idCategoryVendor != 'version') {
                $idCategoryVendor = intval($idCategoryVendor);
                if (array_key_exists($idCategoryVendor, $idsOfCategoryVendor)) {


                    foreach ($idCategoryVendorValue['languages'] as $idLanguage => $catObj) {
                        updateCategoryVendor(
                            $conn, $idLanguage, $idCategoryVendor, $catObj['name']
                        );

                    }

                }
            }

        }

    }

    if ($versions['paymentInfoActivity'] < $response['paymentInfoActivity']['version']) {
        $idsOfPayment = getIdVersionOfElementsOfArray($conn, 'PaymentInfoActivity');
        foreach ($response['paymentInfoActivity'] as $idPayment => $paymentValue) {
            if ($idPayment != 'version') {
                $idPayment = intval($idPayment);
                if (array_key_exists($idPayment, $idsOfPayment)) {

                    foreach ($paymentValue['languages'] as $idLanguage => $paymentInfoObj) {
                        updatePaymentInfo(
                            $conn, $idLanguage, $idPayment,
                            $paymentInfoObj['description']
                        );
                    }

                }
            }
        }
    }

    if ($versions['labelsBox'] < $response['labelsBox']['version']) {
        $idsOfLabelsBox = getIdVersionOfElementsOfArray($conn, 'LabelsBox');
        foreach ($response['labelsBox'] as $idLabelsBox => $labelsBoxValue) {
            if ($idLabelsBox != 'version') {
                $idLabelsBox = intval($idLabelsBox);
                if (array_key_exists($idLabelsBox, $idsOfLabelsBox)) {
                    foreach ($labelsBoxValue['languages'] as $idLanguage => $labelBoxObj) {

                        updateLabelBox($conn,$idLanguage,$idLabelsBox,$labelBoxObj['name']);
                    }

                }
            }
        }
    }

////    if ($versions['ratedCategory'] < $respone['ratedCategory']) {}
    if ($versions['includedService'] < $response['includedService']['version']) {
        $idsOfIncludedService = getIdVersionOfElementsOfArray($conn, 'IncludedService');
        foreach ($response['includedService'] as $idIncludedService => $includedServiceValue) {
            if ($idIncludedService != 'version') {
                $idIncludedService = intval($idIncludedService);
                if (array_key_exists($idIncludedService, $idsOfIncludedService)) {

                    foreach ($includedServiceValue['languages'] as $idLanguage => $includeServObj) {

                        updateIncludeService(
                            $conn, $idLanguage, $idIncludedService, $includeServObj['name']
                        );
                    }

                }
            }
        }
    }

    if ($versions['menu'] < $response['menu']['version']) {

        updateMenu($conn, $response['menu']);
    }

}

// # Continue with data
// Step 2: Check for new entries
$allIds = getAllIds($conn);

//foreach ($respone['language'] as ){}

foreach ($response['destinations'] as $idDestination => $destinationValue) {
    if ($idDestination != 'version') {
        $idDestination = intval($idDestination);
        if (!in_array($idDestination, $allIds['Destination'])) {
            if (isset($destinationValue['version'])) {
                addDestination($conn, $idDestination, $destinationValue['languages'],
                    $destinationValue['version'], $destinationValue['mappingString']);
            }
        }
    }
}

foreach ($response['categoryVendor'] as $idCategoryVendor => $categoryVendorValue) {
    if ($idCategoryVendor != 'version') {
        $idCategoryVendor = intval($idCategoryVendor);
        if (!in_array($idCategoryVendor, $allIds['CategoryVendor'])) {
            addCategoryVendor($conn, $idCategoryVendor, $categoryVendorValue['languages']);
        }
    }
}

foreach ($response['labelsBox'] as $idLabelBox => $labelBoxValue) {
    if ($idLabelBox != 'version') {
        $idLabelBox = intval($idLabelBox);
        if (!in_array($idLabelBox, $allIds['LabelsBox'])) {
            addLabelsBox($conn, $idLabelBox, $labelBoxValue['languages']);
        }
    }
}
foreach ($response['includedService'] as $idIncludedService => $includedServiceValue) {
    if ($idIncludedService != 'version') {
        $idIncludedService = intval($idIncludedService);
        if (!in_array($idIncludedService, $allIds['IncludedService'])) {
            addIncludedService($conn, $idIncludedService, $includedServiceValue['icon'], $includedServiceValue['languages']);
        }
    }
}
//checked after other
if ($versions['general'] < $response['version']) {
    if ($versions['vendor'] < $response['vendors']['version']) {
        $idsOfVendors = getIdVersionOfElementsOfArrayWithVersion($conn, 'Vendor');
        foreach ($response['vendors'] as $idVendor => $vendorValue) {
            if ($idVendor != 'version') {
                $idVendor = intval($idVendor);
                if (array_key_exists($idVendor, $idsOfVendors)) {
                    if ($idsOfVendors[$idVendor] < $vendorValue['version']) {
                        $basic = array(
                            $vendorValue['isBestoff'],
                            $vendorValue['idDestination'],
                            $vendorValue['priceAdult'],
                            $vendorValue['originalPrice'],
                            $vendorValue['discount'],
                            $vendorValue['priceKid'],
                            $vendorValue['infantPrice'],
                            $vendorValue['idCategory'],
                            $vendorValue['idPaymentInfo'],
                            $vendorValue['forHowManyPersonsIs'],
                            $vendorValue['childAcceptance'],
                            $vendorValue['infantTolerance'],
                            $vendorValue['isActiveNow'],
                        );
                        $labelBoxes = $vendorValue['labelBox'];
                        $includedServices = $vendorValue['labelBox'];
                        $rated = $vendorValue['rated'];
                        $languages = $vendorValue['languages'];
                        vendorFunction(
                            $conn, $idVendor, $basic, $labelBoxes,
                            $includedServices, $rated,
                            $languages, $vendorValue['version']
                        );
                    }

                }

            }
        }
    }
}

foreach ($response['vendors'] as $idVendor => $valueVendor) {
    if ($idVendor != 'version') {
        $idVendor = intval($idVendor);
        if (!in_array($idVendor, $allIds['Vendor'])) {
            $basic = array(
                $valueVendor['isBestoff'],
                $valueVendor['idDestination'],
                $valueVendor['priceAdult'],
                $valueVendor['originalPrice'],
                $valueVendor['discount'],
                $valueVendor['priceKid'],
                $valueVendor['infantPrice'],
                $valueVendor['idCategory'],
                $valueVendor['idPaymentInfo'],
                $valueVendor['forHowManyPersonsIs'],
                $valueVendor['childAcceptance'],
                $valueVendor['infantTolerance'],
                $valueVendor['isActiveNow'],
            );
            $labelBoxes = $valueVendor['labelBox'];
            $includedServices = $valueVendor['includedServices'];
            $rated = $valueVendor['rated'];
            $languages = $valueVendor['languages'];
            vendorFunction(
                $conn, $idVendor, $basic, $labelBoxes,
                $includedServices, $rated, $languages,
                $valueVendor['version'], false
            );
        }
    }
}

// # Step 3: Check if images are modified somehow(add, or remove)

$destinations = $response['destinations'];
$modifiedDestinations = [];
$modifiedImage1 = [];
$modifiedImage2 = [];

$destinationsDetails = getDestinationsImagesDetails($conn);
foreach ($destinations as $idDestination => $destinationValue) {
    if ($idDestination !== 'version') {
        $idDestination = intval($idDestination);

        $destinationNow = $destinationsDetails[$idDestination];

        $image1Obj = $destinationValue['image1'];
        $image2Obj = $destinationValue['image2'];

        if ($destinationNow['image1Version'] < $image1Obj['version']) {
            if (!in_array($idDestination, $modifiedDestinations)) {
                array_push($modifiedDestinations, $idDestination);
            }
            $modifiedImage1[$idDestination] = $image1Obj['path'];
        }
        if ($destinationNow['image2Version'] < $image2Obj['version']) {
            if (!in_array($idDestination, $modifiedDestinations)) {
                array_push($modifiedDestinations, $idDestination);
            }
            $modifiedImage2[$idDestination] = $image2Obj['path'];
        }
    }
}

$image1Modified = [];
foreach ($modifiedImage1 as $idDestination => $imagePathName) {
    $url = "https://valuepass.gr/images/location_images/$imagePathName";
    $targetFileName = "../images/location_images/";
    createFolderIfNotExists($targetFileName);
    $targetFileName .= "$imagePathName";
    if (!file_exists($targetFileName)) {
        @$file = file_get_contents($url);
        if ($file) {
            file_put_contents(
                $targetFileName,
                $file
            );
            $image1Modified[$idDestination] = $imagePathName;
        } else {
            if (($key = array_search($idDestination, $modifiedDestinations)) !== false) {
                unset($modifiedDestinations[$key]);
            }
        }
    } else {
        $image1Modified[$idDestination] = $imagePathName;
    }
}

$image2Modified = [];
foreach ($modifiedImage2 as $idDestination => $imagePathName) {
    $url = "https://valuepass.gr/images/location_images/$imagePathName";
    $targetFileName = "../images/location_images/";
    createFolderIfNotExists($targetFileName);
    $targetFileName .= "$imagePathName";
    if (!file_exists($targetFileName)) {
        @$file = file_get_contents($url);
        if ($file) {
            file_put_contents(
                $targetFileName,
                $file
            );
            $image2Modified[$idDestination] = $imagePathName;
        } else {
            if (($key = array_search($idDestination, $modifiedDestinations)) !== false) {
                unset($modifiedDestinations[$key]);
            }
        }
    } else {
        $image2Modified[$idDestination] = $imagePathName;
    }
}


updateBasicImages($conn, $image1Modified, $response['destinations'], 'Destination', 'image1', 'image1Version');
updateBasicImages($conn, $image2Modified, $response['destinations'], 'Destination', 'image2', 'image2Version');

$notOkForShowingDestinations = getNotOkForShowingDestinations($conn);
//$modifiedDestinations contains the ok destinations images changed, both new and old
$okForShowingDestinations = array_intersect($notOkForShowingDestinations, $modifiedDestinations);
setOkDestinations($conn, $okForShowingDestinations);

$vendors = $response['vendors'];

$vendorsModified = [];

$basicImagesToChange = [];
$googleMapsImageToChange = [];

$imagesToBeAdded = [];
$imagesToBeRemoved = [];

$basicImagesVendor = getImageBasicVendors($conn);
$imagesAvailableOfAllVendor = getImageVendors($conn);
foreach ($vendors as $idVendor => $vendorValue) {
    if ($idVendor !== 'version') {
        $idVendor = intval($idVendor);
        // # Basic vendor images
        $imagesBasicNow = $basicImagesVendor[$idVendor];
        $imageBasicObjectJSON = $vendorValue['imageBasic'];
        $imageGoogleMapsObjectJSON = $vendorValue['googleMapsImage'];
        if ($imagesBasicNow['imageBasicVersion'] < $imageBasicObjectJSON['version']) {
            array_push($basicImagesToChange, $idVendor);
            if (!in_array($idVendor, $vendorsModified)) {
                array_push($vendorsModified, $idVendor);
            }
        }
        if ($imagesBasicNow['googleMapsImageVersion'] < $imageGoogleMapsObjectJSON['version']) {
            array_push($googleMapsImageToChange, $idVendor);
            if (!in_array($idVendor, $vendorsModified)) {
                array_push($vendorsModified, $idVendor);
            }
        }

        // # vendor images
        if (!isset($imagesAvailableOfAllVendor[$idVendor])) {
            $imagesAvailable = [];
        } else {
            $imagesAvailable = $imagesAvailableOfAllVendor[$idVendor];
        }
        $imagesPlural = $vendorValue['images'];
        foreach ($imagesPlural as $imageObject) {

            $idImage = intval($imageObject['id']);
            $pathImage = $imageObject['path'];
            if (!in_array($idImage, $imagesAvailable)) {
                $imageToBeAdded = array(
                    'id' => $idImage,
                    'idVendor' => $idVendor,
                    'path' => $pathImage
                );
                array_push($imagesToBeAdded, $imageToBeAdded);
                if (!in_array($idVendor, $vendorsModified)) {
                    array_push($vendorsModified, $idVendor);
                }
                $index_temp = array_search($idImage, $imagesAvailable);
                unset($imagesAvailable[$index_temp]);
            }

        }

        foreach ($imagesAvailable as $toBeRemovedImages) {
            $imagesToBeRemoved[$toBeRemovedImages] = $idVendor;
        }

    }
}

// # start download
$updatedBasic = [];

foreach ($basicImagesToChange as $idVendorBasicImage) {
    $imagePathName = $vendors[$idVendorBasicImage]['imageBasic']['path'];
    $url = "https://valuepass.gr/vendorImages/$idVendorBasicImage/$imagePathName";
    $targetFileName = "../vendorImages/$idVendorBasicImage/";
    createFolderIfNotExists($targetFileName);
    $targetFileName .= "$imagePathName";

    if (!file_exists($targetFileName)) {
        @$file = file_get_contents($url);
        if ($file) {
            file_put_contents(
                $targetFileName,
                $file
            );
            $updatedBasic[$idVendorBasicImage] = $imagePathName;
        } else {
            if (($key = array_search($idVendorBasicImage, $vendorsModified)) !== false) {
                unset($vendorsModified[$key]);
            }
        }
    } else {
        $updatedBasic[$idVendorBasicImage] = $imagePathName;
    }

}


$updatedGoogleMaps = [];
foreach ($googleMapsImageToChange as $idVendorGoogleMaps) {
    $imagePathName = $vendors[$idVendorGoogleMaps]['googleMapsImage']['path'];
    $url = "https://valuepass.gr/vendorImages/$idVendorGoogleMaps/$imagePathName";
    $targetFileName = "../vendorImages/$idVendorGoogleMaps/";
    createFolderIfNotExists($targetFileName);
    $targetFileName .= "$imagePathName";
    if (!file_exists($targetFileName)) {
        @$file = file_get_contents($url);
        if ($file) {
            file_put_contents(
                $targetFileName,
                $file
            );
            $updatedGoogleMaps[$idVendorGoogleMaps] = $imagePathName;
        } else {
            if (($key = array_search($idVendorGoogleMaps, $vendorsModified)) !== false) {
                unset($vendorsModified[$key]);
            }
        }
    } else {
        $updatedGoogleMaps[$idVendorGoogleMaps] = $imagePathName;
    }

}

$innerImagesUploaded = [];
foreach ($imagesToBeAdded as $imageToAddedObj) {
    $idVendorInnerImage = $imageToAddedObj['idVendor'];
    $imagePathName = $imageToAddedObj['path'];
    $idImage = $imageToAddedObj['id'];

    $url = "https://valuepass.gr/vendorImages/$idVendorInnerImage/$imagePathName";
    $targetFileName = "../vendorImages/$idVendorInnerImage/";
    createFolderIfNotExists($targetFileName);
    $targetFileName .= "$imagePathName";
    if (!file_exists($targetFileName)) {
        @$file = file_get_contents($url);
        if ($file) {
            file_put_contents(
                $targetFileName,
                $file
            );
            $innerImagesUploaded[$idImage] = array(
                'idVendor' => $idVendorInnerImage,
                'path' => $imagePathName
            );
        } else {
            if (($key = array_search($idVendorInnerImage, $vendorsModified)) !== false) {
                unset($vendorsModified[$key]);
            }
        }
    } else {
        $innerImagesUploaded[$idImage] = array(
            'idVendor' => $idVendorInnerImage,
            'path' => $imagePathName
        );
    }

}

updateBasicImages($conn, $updatedBasic, $response['vendors'], 'Vendor', 'imageBasic', 'imageBasicVersion');
updateBasicImages($conn, $updatedGoogleMaps, $response['vendors'], 'Vendor', 'googleMapsImage', 'googleMapsImageVersion');


updateInnerImages($conn, $innerImagesUploaded);


// NOTE: not isOkForShowing, take all of them compare to the
//       vendorsModified and these are ok for showing
$notOkForShowingVendors = getNotOkForShowingVendors($conn);
$okForShowingNow = array_intersect($notOkForShowingVendors, $vendorsModified);

setOkVendor($conn, $okForShowingNow);

$queryImageRemove = "DELETE FROM VendorImages
                    WHERE id = ? AND idVendor = ?";
$stmtImageRemove = $conn->prepare($queryImageRemove);
$idImage = $idVendor = 0;
$stmtImageRemove->bind_param('ii', $idImage, $idVendor);
foreach ($imagesToBeRemoved as $idImage => $idVendor) {

    if (in_array($idVendor, $vendorsModified)) {//because can stay without images
        $stmtImageRemove->execute();
    }
}

$allVersions = [
    $response['version'],
    $response['ratedCategory']['version'],
    $response['menu']['version'],
    $response['destinations']['version'],
    $response['categoryVendor']['version'],
    $response['paymentInfoActivity']['version'],
    $response['vendors']['version'],
    $response['labelsBox']['version'],
    $response['includedService']['version']
];
updateVersionTable($conn, $allVersions);

$from = "test@valuepass.gr";
$to = "christosbaztekas@gmail.com";
$subject = "Check Cron Job Update Vm";
$message = "Check Cron Job Update Vm";
$headers = "From:" . $from;
mail($to,$subject,$message, $headers);

