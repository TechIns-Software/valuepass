
<?php
//Get all Languages
function getAllLanguages($conn)
{
    $query = "Select l.id,l.language,l.icon,v.version FROM Language as l ,Versions as v where v.name = 'language' ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $language = $icon = $langversion = '';
    $stmt->bind_result($id, $language, $icon,$langversion);
    $languages = [];
    while ($stmt->fetch()) {
        array_push($languages, [$id, $language, $icon , $langversion]);
    }
    $stmt->close();
    return $languages;
}


function getDestinations($conn,$idLanguage , $idDestination = 0) {
    if ($idDestination != 0) {
        $query1 = "SELECT D.id, DT.name, DT.description, D.image1, D.image2 ,D.version 
                FROM Destination AS D, DestinationTranslate AS DT
                WHERE D.id = DT.idDestination AND DT.idLanguage = $idLanguage  and   DT.idDestination = $idDestination
                ORDER BY id ASC;";

        $stmt = $conn->prepare($query1);
        $stmt->execute();
        $id = $name = $description = $image1 = $image2 = $version = '';
        $stmt->bind_result($id, $name, $description, $image1, $image2, $version);
        $destinations = [];
        while ($stmt->fetch()) {
            array_push($destinations, [$id, $name, $description, $image1, $image2, $version]);
        }
        $stmt->close();
    }else{
        $query2 = "SELECT id FROM Destination;";
        $stmt = $conn->prepare($query2);
        $stmt->execute();
        $id =  '';
        $stmt->bind_result($id);
        $destinations = [];
        while ($stmt->fetch()) {
            array_push($destinations, $id);
        }
        $stmt->close();
    }

    return $destinations;
}


function getAllCategories($conn, $idLanguage , $idCategory = 0)
{

    if ($idCategory != 0){

    $query = "SELECT cvt.name,cvt.idCategoryVendor FROM CategoryVendor as cv , CategoryVendorTranslate as cvt WHERE cvt.idCategoryVendor = cv.id and cv.id = $idCategory and cvt.idLanguage = $idLanguage ; ";
    $stmt = $conn->prepare($query);

    $stmt->execute();
    $name = $id_cat =  '';
    $stmt->bind_result($name, $id_cat);
    $categories = [];
    while ($stmt->fetch()) {
        array_push($categories, [$name, $id_cat]);
    }
    $stmt->close();

    }else{
        $query2 = "SELECT id , version FROM  CategoryVendor ;";
        $stmt = $conn->prepare($query2);
        $stmt->execute();
        $id =  $version = '';
        $stmt->bind_result($id,$version);
        $categories = [];
        while ($stmt->fetch()) {
            array_push($categories, [$id ,$version]);
        }
        $stmt->close();

    }

    return $categories;
}

function GetAllPaymentInfos($conn, $idLanguage , $idPayment = 0)
{
    if ($idPayment !=0) {
        $query = " SELECT pia.id , piat.head , piat.description , piat.version FROM PaymentInfoActivity as pia , PaymentInfoActivityTranslate as piat WHERE piat.idLanguage = $idLanguage and pia.id = $idPayment AND piat.idPaymentInfoActivity = pia.id ; ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
       $id =  $head = $description = $version = '';
        $stmt->bind_result($id ,$head, $description, $version);
        $paymentsInfos = [];
        while ($stmt->fetch()) {
            array_push($paymentsInfos, [$id ,$head, $description, $version]);
        }
        $stmt->close();
    }else{
        $query = "SELECT id , version FROM PaymentInfoActivity ;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $id = $version = '';
        $stmt->bind_result($id, $version);
        $paymentsInfos = [];
        while ($stmt->fetch()) {
            array_push($paymentsInfos, [$id,$version]);
        }
        $stmt->close();

    }
    return $paymentsInfos;
}

function  getAllLabels($conn, $idLanguage , $id_label = 0)
{

    if ($id_label != 0 ) {
        $query = "SELECT lb.id , lbt.name ,lbt.version FROM LabelsBox AS lb ,LabelsBoxTranslate AS lbt WHERE lb.id = lbt.idLabelsBox  and lbt.idLanguage = $idLanguage and lb.id =$id_label ; ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $id = $name = $version = '';
        $stmt->bind_result($id, $name,$version);
        $labelBox = [];
        while ($stmt->fetch()) {
            array_push($labelBox, [$id, $name,$version]);
        }
        $stmt->close();
    }else{
        $query = "SELECT id ,version FROM LabelsBox ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $id = $version = '';
        $stmt->bind_result($id,$version);
        $labelBox = [];
        while ($stmt->fetch()) {
            array_push($labelBox, [$id,$version]);
        }
        $stmt->close();

    }
    return $labelBox;
}

function getRatedCategories($conn, $idLanguage , $id_rated = 0)
{

    if ($id_rated != 0){
    $query = "SELECT rc.id,rct.nameCategory ,rct.version ,rc.orderNumber FROM RatedCategory AS rc , RatedCategoryTranslate AS rct WHERE rc.id = rct.idRatedCategory  and rct.idLanguage =$idLanguage and rc.id = $id_rated ;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = $categoryName = $version =  $orderNumber =  '';
    $stmt->bind_result($id, $categoryName , $version , $orderNumber);
    $ratedCategories = [];
    while ($stmt->fetch()) {
        array_push($ratedCategories, [$id, $categoryName , $version , $orderNumber]);
    }
    $stmt->close();
    }else{

        $query = "SELECT id,version  FROM RatedCategory  ; ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $id = $version =  '';
        $stmt->bind_result($id , $version);
        $ratedCategories = [];
        while ($stmt->fetch()) {
            array_push($ratedCategories, [$id , $version]);
        }
        $stmt->close();
    }
    return $ratedCategories;
}


function getAllIncludeServices($conn , $idLanguage , $id_included = 0)
{

    if ( $id_included != 0) {
        $query = "SELECT ins.id , inst.name , inst.version , ins.icon from IncludedService as ins ,IncludedServiceTranslate as inst where ins.id = inst.idIncludedService  and inst.idLanguage = $idLanguage and ins.id = $id_included ;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $id = $name =  $version =  $icon = '';
        $stmt->bind_result($id, $name , $version , $icon);
        $includedServices = [];
        while ($stmt->fetch()) {
            array_push($includedServices, [$id, $name , $version , $icon]);
        }
        $stmt->close();
    }else{
        $query = "SELECT id , version FROM IncludedService;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $id =  $version = '';
        $stmt->bind_result($id, $version);
        $includedServices = [];
        while ($stmt->fetch()) {
            array_push($includedServices, [$id,$version]);
        }
        $stmt->close();
    }
    return $includedServices;
}


function getAllVendors($conn )
{
    $query = "SELECT id   FROM Vendor   where  isCompleted = true";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id =  "";
    $stmt->bind_result( $id );
    $vendorIds = [] ;
    while ($stmt->fetch()) {
        array_push($vendorIds, $id);
    }
    $stmt->close();
    return  $vendorIds;

}

function getVendorBasicInfo($conn , $VendorId)
{
    $query = "SELECT V.version, V.idDestination, V.priceAdult, V.originalPrice, V.discount,
                        V.priceKid, V.infantPrice , V.imageBasic, V.imageBasicVersion, V.idCategory , V.idPaymentInfoActivity , 
                        V.googleMapsString ,  V.googleMapsStringVersion , V.forHowManyPersonsIs
              FROM Vendor AS V where  V.id = $VendorId ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $version = $idDestination = $priceAdult = $originalPrice  = $discount = $priceKid =  $infantPrice =
        $imageBasic = $imageBasicVersion = $idCategory  =  $idPaymentInfoActivity = $googleMapsString = $googleMapsStringVersion = $forHowManyPersonsIs =  '';
    $stmt->bind_result( $version , $idDestination , $priceAdult , $originalPrice  , $discount , $priceKid ,  $infantPrice ,
    $imageBasic , $imageBasicVersion , $idCategory ,  $idPaymentInfoActivity , $googleMapsString , $googleMapsStringVersion , $forHowManyPersonsIs  );
    $basicInfo = [];
    while ($stmt->fetch()) {
        array_push($basicInfo, [$version , $idDestination , $priceAdult , $originalPrice  , $discount , $priceKid ,  $infantPrice ,
            $imageBasic , $imageBasicVersion , $idCategory ,  $idPaymentInfoActivity , $googleMapsString , $googleMapsStringVersion , $forHowManyPersonsIs ]);
    }
    $stmt->close();
    return  $basicInfo;
}

function IsBestoff($conn,$VendorId){
    $query = "SELECT idVendor FROM BestOff where  idVendor =  $VendorId ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = '';
    $stmt->bind_result( $id );
    $realid = -99 ;
    while ($stmt->fetch()) {
        $realid =  $id;
    }
    $stmt->close();

    if ($realid == -99 ){
        return false;
    }else{
        return true;
    }

}



function LabelBoxArray($conn,$VendorId){
    $query = "SELECT idLabelsBox FROM VendorLabelsBox where idVendor = $VendorId;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $id = '';
    $stmt->bind_result( $id );
    $labels = [] ;
    while ($stmt->fetch()) {
        array_push($labels,$id );
    }
    $stmt->close();
    return $labels;
}


function VendorImages($conn,$VendorId){
    $query = "SELECT  image, version FROM VendorImages where idVendor = $VendorId;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $image = $version = '';
    $stmt->bind_result( $image ,$version);
    $labels = [] ;
    while ($stmt->fetch()) {
        array_push($labels,['path'=>$image , 'version' =>$version]);
    }
    $stmt->close();
    return $labels;

}

function Rated($conn,$VendorId){
    $query = "SELECT idRatedCategory , stars FROM Rated where  idVendor = $VendorId;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $idRatedCategory = $stars = '';
    $stmt->bind_result( $idRatedCategory ,$stars);
    $ratedids  = [] ;
    while ($stmt->fetch()) {
        array_push($ratedids,[$idRatedCategory=>$stars ]);
    }
    $stmt->close();
    return $ratedids;
}

function VendorIncludedService($conn,$VendorId){
    $query = "SELECT idIncludedService FROM VendorIncludedService where idVendor = $VendorId;";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $idIncludedService  = '';
    $stmt->bind_result( $idIncludedService );
    $idIncludedService_ids  = [] ;
    while ($stmt->fetch()) {
        array_push($idIncludedService_ids,$idIncludedService );
    }
    $stmt->close();
    return $idIncludedService_ids;
}


function extraVendorInfo($conn,$languageid ,$VendorId){
    $query1 = "SELECT  version, voucherMessage1, voucherMessage2 ,  name, descriptionBig, descriptionFull FROM VendorTranslate where idLanguage = $languageid and idVendor = $VendorId;";
    $stmt = $conn->prepare($query1);
    $stmt->execute();
    $version  = $voucherMessage1 =$voucherMessage2 =
    $name  = $descriptionBig = $descriptionFull = '';
    $stmt->bind_result( $version,$voucherMessage1 ,$voucherMessage2 ,
    $name,$descriptionBig, $descriptionFull );
    $extrainfo1 = [] ;
    while ($stmt->fetch()) {
     $extrainfo1 = [  ...$extrainfo1, ['version'=>$version,'voucherMessage1'=>$voucherMessage1 ,'voucherMessage2'=>$voucherMessage2 ,
         'name'=>$name,'descriptionBig'=>$descriptionBig,'descriptionFull'=>$descriptionFull] ];
    }
    $stmt->close();

    $query2 = "SELECT  ht.name  FROM Highlight as h ,HighlightTranslate as ht where ht.idHighlight =  h.id and ht.idLanguage = $languageid and h.idVendor= $VendorId;";
    $stmt = $conn->prepare($query2);
    $stmt->execute();
    $name  = '';
    $highlights = [];
    $stmt->bind_result( $name );
    while ($stmt->fetch()) {
        array_push($highlights , $name);
    }
    $stmt->close();
  $extrainfo1 = [  ...$extrainfo1, ['highlights'=> $highlights]];

    $query3 = "SELECT act.head,act.description FROM AboutActivity as ac ,AboutActivityTranslate as act where act.idAboutActivity = ac.id  and act.idLanguage= $languageid and ac.idVendor= $VendorId ;";
    $stmt = $conn->prepare($query3);
    $stmt->execute();
    $head = $description =  '';
    $aboutActivity = [];
    $stmt->bind_result( $head, $description);
    while ($stmt->fetch()) {
        array_push($aboutActivity , ['head'=>$head ,'description'=>$description]);
    }
    $stmt->close();

  $extrainfo1 = [ ...$extrainfo1, ['aboutActivity'=> $aboutActivity]];

    $query4 = "SELECT DISTINCT  IIH.id, IIHT.name, IIDT.name
                    FROM ImportantInformationHead AS IIH, ImportantInformationHeadTranslate AS IIHT,
                    ImportantInformationDescription AS IID, ImportantInformationDescriptionTranslate AS IIDT
                    WHERE IIH.idVendor = $VendorId
                    AND IIH.id = IID.idImportantInformationHead
                    AND IIH.id = IIHT.idImportantInformationHead
                    AND IID.id = IIDT.idImportantInformationDescription
                    AND IIHT.idLanguage = $languageid
                    AND IIDT.idLanguage = $languageid
                    ORDER BY IIH.id";
    $stmt = $conn->prepare($query4);
    $stmt->execute();
   $id = $importantHead = $description1 =  '';
    $importantInfo = [];
    $stmt->bind_result($id, $importantHead, $description1);
    $ids =[];
    $headers = [];
    $descriptions = [];
    while ($stmt->fetch()) {
        array_push( $ids, $id);
        array_push( $headers, $importantHead);
        array_push( $descriptions, $description1);
//        $importantInfo[$id] =[];
//        $importantInfo[$id] =[...$importantInfo[$id],$description ];
//        array_push( $importantInfo[$importantHead],$description);
//        array_push($importantInfo , [$head $description]);
    }
    $descr = [];
        for ($i =0 ; $i<count($ids) ; $i++){
            if ($ids[$i] == $ids[$i+1]){
                $importantInfo = ['importantInformationHeadName'=> $headers[$i],[$description1[$i]] ];
            }

        }

    $stmt->close();

    return $importantInfo;
}

