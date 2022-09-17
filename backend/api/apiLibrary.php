<?php

function getImageBasicVendors($conn)
{
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
                'imageBasic' => $imageBasic,
                'imageBasicVersion' => $imageBasicVersion,
                'googleMapsImage' => $googleMapsImage,
                'googleMapsImageVersion' => $googleMapsImageVersion
            );
        }
    }
    $stmt->close();
    return $imagesBasicVendor;
}


function getImageVendors($conn)
{
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


function getNotOkForShowingVendors($conn)
{
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

function getDestinationsImagesDetails($conn)
{
    $query = "SELECT id, image1, image2, image1Version, image2Version
            FROM Destination;";
    $stmt = $conn->prepare($query);
    $destinations = [];
    if ($stmt->execute()) {
        $idDestination = $image1 = $image1Version = $image2 = $image2Version = "";
        $stmt->bind_result($idDestination, $image1, $image2, $image1Version, $image2Version);
        while ($stmt->fetch()) {
            $destinations[intval($idDestination)] = array(
                'image1' => $image1,
                'image1Version' => $image1Version,
                'image2' => $image2,
                'image2Version' => $image2Version
            );
        }
    }
    $stmt->close();
    return $destinations;
}

function getNotOkForShowingDestinations($conn)
{
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

function getVersions($conn)
{
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

function getIdsOfArray($conn, $tableName)
{
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

function getAllIds($conn)
{
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

function getIdVersionOfElementsOfArray($conn, $tableName)
{
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

//TODO: Versions to be updated as well!
function updateDestinationLanguages($conn, $idLang, $idDest, $name, $description)
{
    $query = "UPDATE DestinationTranslate
        SET 
        name = '$name',
        description= '$description' 
    WHERE  idDestination = '$idDest' AND  idLanguage ='$idLang' ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


function updateCategoryVendor($conn, $idLang, $idCat, $name)
{
    $query = "UPDATE  CategoryVendorTranslate 
    SET 
    name = '$name'
    WHERE  idCategoryVendor = '$idCat'AND idLanguage = '$idLang'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}

function updatePaymentInfo($conn, $idLang, $idPayment, $description){
    $query = "UPDATE  PaymentInfoActivityTranslate 
    SET 
    description = '$description'
    WHERE  idPaymentInfoActivity = '$idPayment'AND idLanguage = '$idLang'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();

}

function updateLabelBox($conn, $idLang, $idLabelBox, $name){
    $query = "UPDATE  LabelsBoxTranslate 
    SET 
    name = '$name'
    WHERE  idLabelsBox = '$idLabelBox'AND idLanguage = '$idLang'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}


function updateIncludeService($conn, $idLang, $idInclude, $name){
    $query = "UPDATE  IncludedServiceTranslate 
    SET 
    name = '$name'
    WHERE  idIncludedService = '$idInclude'AND idLanguage = '$idLang'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}

function updateMenu($conn, $menu) {
    foreach ($menu as $menuId=> $menuObj) {
        if ($menuId != 'version') {
            foreach ($menuObj['languages'] as $idLanguage => $menuTextObj) {
                //todo
            }
        }
    }
}

/*
 * Called when modify or add vendor
 */
function vendorFunction(
    $conn, $idVendor, $basic,
    $labelBoxes, $includedServices, $rated, $languages, $updateVendor = true
) {
    $isBestOff = $basic[0];
    $idDestination = $basic[1];
    $priceAdult = $basic[2];
    $originalPrice = $basic[3];
    $discount = $basic[4];
    $priceKid = $basic[5];
    $infantPrice = $basic[6];
    $idCategory = $basic[7];
    $idPaymentInfo = $basic[8];
    $forHowManyPersonsIs = $basic[9];
    if ($updateVendor) {
        $queryBasic = "UPDATE Vendor
        SET idDestination = $idDestination, priceAdult = $priceAdult,
            originalPrice = $originalPrice, discount = $discount,
            priceKid = $priceKid, idCategory = $idCategory,
            idPaymentInfoActivity = $idPaymentInfo,
            infantPrice = $infantPrice,
            forHowManyPersonsIs = $forHowManyPersonsIs
        WHERE id = $idVendor";

        $queryStars = "UPDATE Rated
                SET stars = ? 
                WHERE idVendor = $idVendor AND idRatedCategory = ?";
    } else {
        $queryBasic = "INSERT INTO Vendor(idDestination, priceAdult, originalPrice,
            discount, priceKid, idCategory, idPaymentInfoActivity,
            infantPrice, forHowManyPersonsIs, id) VALUES (
                $idDestination, $priceAdult, $originalPrice, $discount,
                $priceKid, $idCategory, $idPaymentInfo, $infantPrice,
                $forHowManyPersonsIs, $idVendor
            );";


        $queryStars = "INSERT INTO Rated(stars, idVendor, idRatedCategory) 
                    VALUES (?, ?, ?)";
    }

    $stmtBasic = $conn->prepare($queryBasic);
    $stmtBasic->execute();

    $stmtStars = $conn->prepare($queryStars);
    $stars = 5;
    $idRated = 1;
    $stmtStars->bind_param('ii', $stars, $idRated);
    foreach ($rated as $ratedObj) {
        foreach ($ratedObj as $idRated=>$stars) {
            $stmtStars->execute();
        }
    }
    if ($updateVendor) {
        //first remove all included and labeloxes of vendor
        $queryDeleteIncl = "DELETE FROM VendorIncludedService WHERE idVendor = $idVendor";
        $stmtDelIncl = $conn->prepare($queryDeleteIncl);
        $stmtDelIncl->execute();
        $stmtDelIncl->close();
        $queryDeleteLab = "DELETE FROM VendorLabelsBox WHERE idVendor = $idVendor";
        $stmtDelLab = $conn->prepare($queryDeleteLab);
        $stmtDelLab->execute();
        $stmtDelLab->close();

        // #NOTE: no need delete first:
        //              AboutActivityTranslate,
        //              HighlightTranslate,
        //              ImportantInformationHeadTranslate,
        //              ImportantInformationDescription,
        //              ImportantInformationDescriptionTranslate,
        //        we have on delete cascade restrictions
        $queryDeleteAboutActivities =
            "DELETE FROM AboutActivity WHERE idVendor = $idVendor";
        $stmtDeleteAct = $conn->prepare($queryDeleteAboutActivities);
        $stmtDeleteAct->execute();
        $stmtDeleteAct->close();

        $queryDelHighlights =
            "DELETE FROM Highlight WHERE idVendor = $idVendor";
        $stmtDeleteHighlight = $conn->prepare($queryDelHighlights);
        $stmtDeleteHighlight->execute();
        $stmtDeleteHighlight->close();

        $queryDelImportant =
            "DELETE FROM ImportantInformationHead WHERE idVendor = $idVendor";
        $stmtDelImportant = $conn->prepare($queryDelImportant);
        $stmtDelImportant->execute();
        $stmtDelImportant->close();
    }

    //add label and included
    $queryAddLabel = "INSERT INTO VendorLabelsBox(idVendor, idLabelsBox) VALUES ($idVendor, ?)";
    $stmtAddLabel = $conn->prepare($queryAddLabel);
    $labelBox = 0; //unnecessary
    $stmtAddLabel->bind_param('i', $labelBox);
    foreach ($labelBoxes as $labelBox) {
        $stmtAddLabel->execute();
    }
    $queryAddIncl = "INSERT INTO VendorIncludedService(idVendor, idIncludedService) VALUES ($idVendor, ?)";
    $stmtAddIncl = $conn->prepare($queryAddIncl);
    $includedService = 0; //unnecessary
    $stmtAddIncl->bind_param('i', $includedService);
    foreach ($includedServices as $includedService) {
        $stmtAddIncl->execute();
    }
    //best off check
    $queryBestOff = "SELECT id FROM BestOff WHERE idVendor = $idVendor";
    $stmtBestOff = $conn->prepare($queryBestOff);

    $idBestOff = -1;
    if ($stmtBestOff->execute()) {
        $stmtBestOff->bind_result($idBestOff);
        while ($stmtBestOff->fetch()) {}

    }
    $stmtBestOff->close();
    if ($idBestOff != -1) { //already best off
        if (!$isBestOff) {
            $queryDeleteBestOff = "DELETE FROM BestOff WHERE id = $idBestOff";
            $stmtDelBestOff = $conn->prepare($queryDeleteBestOff);
            $stmtDelBestOff->execute();
        }
    } else { //is not best off
        if ($isBestOff) {
            $queryAddBestOff = "INSERT INTO BestOff(idDestination, idVendor) VALUES($idDestination, $idVendor);";
            $stmtAddBestOff = $conn->prepare($queryAddBestOff);
            $stmtAddBestOff->execute();
        }
    }


    $aboutActivityMyInternal = [];
    $importantInfoMyInternal = [];
    $highlightMyInternal = [];
    foreach ($languages as $languageId=>$languageObject) {
        $nameVendorTranslate = $languageObject['name'];
        $descriptionBig = $languageObject['descriptionBig'];
        $descriptionFull = $languageObject['descriptionFull'];
        if ($updateVendor) {
            $queryVendorTr = "UPDATE VendorTranslate
                        SET name = '$nameVendorTranslate',
                            descriptionBig = '$descriptionBig',
                            descriptionFull = '$descriptionFull'
                        WHERE idVendor = $idVendor
                            AND idLanguage = $languageId";
        } else {
            $queryVendorTr = "INSERT INTO VendorTranslate(
                idVendor, idLanguage, name, descriptionBig, descriptionFull)
                VALUES ($idVendor, $languageId, '$nameVendorTranslate',
                        '$descriptionBig', '$descriptionFull'
                )";
        }


        $stmtVendorTranslate = $conn->prepare($queryVendorTr);
        $stmtVendorTranslate->execute();


        $temp_counter = 0;
        foreach ($languageObject['aboutActivity'] as $objectActivity) {
            if (!isset($aboutActivityMyInternal[$temp_counter])) {
                $aboutActivityMyInternal[$temp_counter] = array();
            }
            $obj = array(
                'head'=> $objectActivity['head'],
                'description'=> $objectActivity['description']
            );
            $aboutActivityMyInternal[$temp_counter][$languageId] = $obj;
            $temp_counter = $temp_counter + 1;
        }
        $temp_counter = 0;
        foreach ($languageObject['highlights'] as $highlight) {
            if (!isset($highlightMyInternal[$temp_counter])) {
                $highlightMyInternal[$temp_counter] = array();
            }
            $highlightMyInternal[$temp_counter][$languageId] = $highlight;
            $temp_counter = $temp_counter + 1;
        }
        $temp_counter = 0;
        foreach (
            $languageObject['importantInformation']
                 as $importantHeadId=> $importantObj
        ) {
            $importantHeadName = $importantObj['importantInformationHeadName'];
            $descriptions = $importantObj['descriptions'];
            if (!isset($importantInfoMyInternal[$temp_counter])) {
                $importantInfoMyInternal[$temp_counter] = array();
            }
            $impFinal = array(
                'headName'=> $importantHeadName,
                'descriptions'=> $descriptions
            );

            $importantInfoMyInternal[$temp_counter][$languageId] = $impFinal;
            $temp_counter = $temp_counter + 1;
        }
    }


    foreach ($aboutActivityMyInternal as $objImport) {
        $queryAddAct = "INSERT INTO AboutActivity(idVendor) VALUES ($idVendor)";
        $stmtAddAct = $conn->prepare($queryAddAct);
        $stmtAddAct->execute();
        $idAboutActivityInserted = $conn->insert_id;
        $stmtAddAct->close();
        foreach ($objImport as $idLang=> $langObjImport) {
            $head = $langObjImport['head'];
            $description = $langObjImport['description'];
            $queryAboutTranslate = "INSERT INTO AboutActivityTranslate(
                    idAboutActivity, idLanguage, head, description) 
                    VALUES($idAboutActivityInserted, $idLang, '$head', '$description');";
            $stmtAboutTransl = $conn->prepare($queryAboutTranslate);
            $stmtAboutTransl->execute();
            $stmtAboutTransl->close();
        }
    }
    foreach ($highlightMyInternal as $highlightObj) {
        $queryAddHighlight = "INSERT INTO Highlight(idVendor) VALUES ($idVendor)";
        $stmtAddHighlight = $conn->prepare($queryAddHighlight);
        $stmtAddHighlight->execute();
        $idHighlight = $conn->insert_id;
        $stmtAddHighlight->close();
        foreach ($highlightObj as $idLang=> $highlightItem) {
            $queryAddHighTr = "INSERT INTO HighlightTranslate(
                idHighlight, idLanguage, name) VALUES
                            ($idHighlight, $idLang, '$highlightItem')";
            $stmtAddHighTr = $conn->prepare($queryAddHighTr);
            $stmtAddHighTr->execute();
            $stmtAddHighTr->close();
        }
    }
    $importantInfoDescriptionArray = [];
    foreach ($highlightMyInternal as $impInfoOBJ) {
        $queryAddImpInfHead = "INSERT INTO ImportantInformationHead (idVendor)
                    VALUES ($idVendor)";
        $stmtAddImpInfoHead = $conn->prepare($queryAddImpInfHead);
        $stmtAddImpInfoHead->execute();
        $idImportantHead = $conn->insert_id;
        $stmtAddImpInfoHead->close();

        foreach ($impInfoOBJ as $idLang=> $impInfoObjectInner) {
            $headName = $impInfoObjectInner['headName'];
            $queryImpInfoHeadTransl = "INSERT INTO
                ImportantInformationHeadTranslate(
                    idImportantInformationHead, idLanguage, name
                    ) VALUES ($idImportantHead, $idLang, '$headName');";
            $stmtImpInfoHeadTransl = $conn->prepare($queryImpInfoHeadTransl);
            $stmtImpInfoHeadTransl->execute();
            $stmtImpInfoHeadTransl->close();


            $descriptions = $impInfoObjectInner['descriptions'];
            foreach ($descriptions as $counter=>$description) {
                if (!isset($importantInfoDescriptionArray[$counter])) {
                    $queryImpInfoDescription = "INSERT INTO
                        ImportantInformationDescription(idImportantInformationHead)
                        VALUES($idImportantHead);";
                    $stmtImpInfoDescription = $conn->prepare($queryImpInfoDescription);
                    $stmtImpInfoDescription->execute();
                    $idImportantDescription = $conn->insert_id;
                    $importantInfoDescriptionArray[$counter] =
                        $idImportantDescription;
                    $stmtImpInfoDescription->close();
                }
                $idImportantDescription = $importantInfoDescriptionArray[$counter];
                $queryAddImpInfoDescTr = "INSERT INTO
                    ImportantInformationDescriptionTranslate(
                        idImportantInformationDescription, idLanguage, name
                    ) VALUES ($idImportantDescription, $idLang, '$description')";
                $stmtAddImpInfoDescTr = $conn->prepare($queryAddImpInfoDescTr);
                $stmtAddImpInfoDescTr->execute();
                $stmtAddImpInfoDescTr->close();

            }
        }

    }


}


