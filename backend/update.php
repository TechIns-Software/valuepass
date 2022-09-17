<?php

include_once 'api/apiLibrary.php';


if (!isset($conn)) {
    include '../connection.php';
}

$versionJSON = 1;


$filename = 'api/example.json';
if (!file_exists($filename)) {
    exit('No file found!');
}

$json = file_get_contents($filename);
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
        $idsOfDestination = getIdVersionOfElementsOfArray($conn, 'Destination');
        foreach ($response['destinations'] as $idDestination => $destinationValue) {
            if ($idDestination != 'version') {

                $idDestination = intval($idDestination);
                if (array_key_exists($idDestination, $idsOfDestination)) {


                    if ($idsOfDestination[$idDestination] < $destinationValue['version']) {


                        foreach ($destinationValue['languages'] as $idLanguage => $destLangObj) {
//                            echo $destLangObj['name'];
//                            echo $destLangObj['description'];
//                            echo  $idDestination;
//                            echo 'this is LANGUAGE'. $idLanguage;
//                            echo '<hr>';
                            updateDestinationLanguages(
                                $conn, $idLanguage, $idDestination,
                                $destLangObj['name'], $destLangObj['description']);

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

//                        echo 'THIS IS THE CATEGORY ID -->'.$idCategoryVendor;
//                        echo  'THIS IS THE LANGUAGE-->'.$idLanguage;
//                        echo  $catObj['name'];
//                        echo '<hr>';

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
//                        echo 'THIS IS THE PAYMENTINFO ID -->'.$idPayment;
//                        echo  'THIS IS THE LANGUAGE-->'.$idLanguage;
//                        echo  $paymentInfoObj['description'];
//                        echo '<hr>';

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
//                        echo 'THIS IS THE LABEL ID -->'.$idLabelsBox;
//                        echo  'THIS IS THE LANGUAGE-->'.$idLanguage;
//                        echo  $labelBoxObj['name'];
//                        echo '<hr>';

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
//                        echo 'THIS IS THE INCLUDE ID -->' . $idIncludedService;
//                        echo 'THIS IS THE LANGUAGE-->' . $idLanguage;
//                        echo $includeServObj['name'];
//                        echo '<hr>';

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
    if ($versions['vendor'] < $response['vendors']['version']) {
        $idsOfVendors = getIdVersionOfElementsOfArray($conn, 'Vendor');
        foreach ($response['vendors'] as $idVendor => $vendorValue) {
            if ($idVendor != 'version') {
                $idVendor = intval($idVendor);
                if (in_array($idVendor, $idsOfVendors)) {
                    $basic = array(
                        $isBestOff = $vendorValue['isBestoff'],
                        $idDestination = $vendorValue['idDestination'],
                        $priceAdult = $vendorValue['priceAdult'],
                        $originalPrice = $vendorValue['originalPrice'],
                        $discount = $vendorValue['discount'],
                        $priceKid = $vendorValue['priceKid'],
                        $infantPrice = $vendorValue['infantPrice'],
                        $idCategory = $vendorValue['idCategory'],
                        $idPaymentInfo = $vendorValue['idPaymentInfo'],
                        $forHowManyPersonsIs = $vendorValue['forHowManyPersonsIs']
                    );
                    $labelBoxes = $vendorValue['labelBox'];
                    $includedServices = $vendorValue['labelBox'];
                    $rated = $vendorValue['rated'];
                    $languages = $vendorValue['languages'];

                    vendorFunction(
                        $conn, $idVendor, $basic, $labelBoxes,
                        $includedServices, $rated, $languages
                    );
                }

            }
        }
    }
}

// # Continue with data
// Step 2: Check for new entries
$allIds = getAllIds($conn);

//foreach ($respone['language'] as ){}

foreach ($response['destinations'] as $idDestination => $destinationValue) {
    if ($idDestination != 'version') {
        $idDestination = intval($idDestination);
        if (!in_array($idDestination, $allIds['destination'])) {
            //add them
        }
    }
}

foreach ($response['categoryVendor'] as $idCategoryVendor => $categoryVendorValue) {
    if ($idCategoryVendor != 'version') {
        $idCategoryVendor = intval($idCategoryVendor);
        if (!in_array($idCategoryVendor, $allIds['categoryVendor'])) {
            //
        }
    }
}

foreach ($response['labelsBox'] as $idLabelBox => $labelBoxId) {
    if ($idLabelBox != 'version') {
        $idLabelBox = intval($idLabelBox);
        if (!in_array($idLabelBox, $allIds['labelsBox'])) {
            //
        }
    }
}
foreach ($response['includedService'] as $idIncludedService => $includedServiceValue) {
    if ($idIncludedService != 'version') {
        $idIncludedService = intval($includedServiceValue);
        if (!in_array($idIncludedService, $allIds['includedService'])) {
            //
        }
    }
}


foreach ($response['vendors'] as $idVendor => $valueVendor) {
    if ($idVendor != 'version') {
        $idVendor = intval($idVendor);
        if (!in_array($idVendor, $allIds['vendor'])) {
            //add them
        }
    }
}


//TODO: run sql

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
    $targetFileName = "../images/location_images/$imagePathName";
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
    $targetFileName = "../images/location_images/$imagePathName";
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

foreach ($image1Modified as $idDestination => $path) {
    //sql
}

foreach ($image2Modified as $idDestination => $path) {
    //sql
}

$notOkForShowingDestinations = getNotOkForShowingDestinations($conn);
$okForShowingDestinations = array_intersect($notOkForShowingDestinations, $modifiedDestinations);

foreach ($okForShowingDestinations as $okDestination) {
    //sql
}

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
        $imageGoogleMapsObjectJSON = $vendorValue['googleMapString'];
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
    $targetFileName = "../vendorImages/$idVendorBasicImage/$imagePathName";
    if (!file_exists($targetFileName)) {
        @$file = file_get_contents($url);
        if ($file) {
            file_put_contents(
                $targetFileName,
                $file
            );
            array_push($updatedBasic, $idVendorBasicImage);
        } else {
            if (($key = array_search($idVendorBasicImage, $vendorsModified)) !== false) {
                unset($vendorsModified[$key]);
            }
        }
    } else {
        array_push($updatedBasic, $idVendorBasicImage);
    }

}


$updatedGoogleMaps = [];
foreach ($googleMapsImageToChange as $idVendorGoogleMaps) {
    $imagePathName = $vendors[$idVendorGoogleMaps]['googleMapString']['path'];
    $url = "https://valuepass.gr/vendorImages/$idVendorGoogleMaps/$imagePathName";
    $targetFileName = "../vendorImages/$idVendorGoogleMaps/$imagePathName";
    if (!file_exists($targetFileName)) {
        @$file = file_get_contents($url);
        if ($file) {
            file_put_contents(
                $targetFileName,
                $file
            );
            array_push($updatedGoogleMaps, $idVendorGoogleMaps);
        } else {
            if (($key = array_search($idVendorGoogleMaps, $vendorsModified)) !== false) {
                unset($vendorsModified[$key]);
            }
        }
    } else {
        array_push($updatedGoogleMaps, $idVendorGoogleMaps);
    }

}

$innerImagesUploaded = [];
foreach ($imagesToBeAdded as $imageToAddedObj) {
    $idVendorInnerImage = $imageToAddedObj['idVendor'];
    $imagePathName = $imageToAddedObj['path'];
    $idImage = $imageToAddedObj['id'];

    $url = "https://valuepass.gr/vendorImages/$idVendorInnerImage/$imagePathName";
    $targetFileName = "../vendorImages/$idVendorInnerImage/$imagePathName";
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


foreach ($updatedBasic as $idVendor) {
    $imagePathName = $vendors[$idVendor]['imageBasic']['path'];
    $targetFileName = "../vendorImages/$idVendor/$imagePathName";
    //update sql
}

foreach ($updatedGoogleMaps as $idVendor) {
    $imagePathName = $vendors[$idVendor]['googleMapString']['path'];
    $targetFileName = "../vendorImages/$idVendor/$imagePathName";
    //update sql

}

foreach ($innerImagesUploaded as $idImage => $obj) {
    $idVendor = $obj['idVendor'];
    $imagePathName = $obj['path'];

    $targetFileName = "../vendorImages/$idVendor/$imagePathName";
    //update sql
}

// NOTE: not isOkForShowing, take all of them compare to the
//       vendorsModified and these are ok for showing
$notOkForShowingVendors = getNotOkForShowingVendors($conn);
$okForShowingNow = array_intersect($notOkForShowingVendors, $vendorsModified);

foreach ($okForShowingNow as $okVendor) {
    //sql
}


foreach ($imagesToBeRemoved as $idImage => $idVendor) {
    if (in_array($idVendor, $vendorsModified)) {
        //sql
    }
}





