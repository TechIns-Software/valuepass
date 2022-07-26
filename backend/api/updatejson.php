<?php
include_once "../../connection.php";
include_once "../jsonQueries.php";
$generalversion = 1;
$languages = getAllLanguages($conn);
$original_obj =[];
$languages_obj = [];

$original_obj['version'] =  $generalversion;

// Create Language Object
$original_obj['languages']['version'] = $languages[0][3];
foreach ($languages as $language){
    $languages_obj[$language[0]]  = ['name'=> $language[1],'icon'=>$language[2]];
}
// Insert languages object in original object
$original_obj['languages'] =  $languages_obj;




$destinations_ids =  getDestinations($conn,1,0);
// Create Destination Object  NOT COMPLETED THIS PART IN LANGUAGES SECTION
$destinations_obj = [];
$destinations_obj['version'] =$generalversion;
$temp_obj1 = [];
foreach ($destinations_ids as $destinations_id){
    $temp_obj = [];
    foreach ($languages as $language){
       $fullDestination = getDestinations($conn,$language[0],$destinations_id);
        $destination_temp = [];
        foreach ($fullDestination as $fulldest) {
            $temp = 0 ;
            if ($temp == 0) {
                $destination_temp[$fulldest[0]] = ['version' => $fulldest[5]];
                $destination_temp[$fulldest[0]]['image1'] = ["path" => $fulldest[3], 'version' => '1'];
                $destination_temp[$fulldest[0]]['image2'] = ["path" => $fulldest[4], 'version' => '1'];
            }
            array_push($temp_obj,['name'=>$fulldest[1],'description'=>$fulldest[2]]);
            $temp++;
        }
        $destination_temp[$fulldest[0]]['languages'] = $temp_obj;

    }
    array_push($temp_obj1,$destination_temp);

}

$destinations_obj['destinations'] = $temp_obj1;
$original_obj = [ ...$original_obj,$destinations_obj];

$categories_ids = getAllCategories($conn,1,0);
// Create CategoryVendor Object  NOT COMPLETED THIS PART IN LANGUAGES SECTION
$categories_obj = [];
$categories_obj['version'] = $generalversion;

$category_temp = [];
foreach ($categories_ids as $categories_id){
    $temp_cat = [];
    foreach ($languages as $language ){
        $fullCategories = getAllCategories($conn, $language[0] , $categories_id[0] );

        foreach ($fullCategories as $fullCategory){
            $categories_obj[$fullCategory[1]] =   ['version' => $categories_id[1]];;
            array_push($temp_cat,['name' => $fullCategory[0]]);
        }
    }
    $categories_obj[$fullCategory[1]]['languages'] = $temp_cat ;
}


$original_obj = [ ...$original_obj,$categories_obj];

$paymentInfo_ids = GetAllPaymentInfos($conn,1,0);
// Create PaymentInfo  Object
$paymentInfo_obj = [];
$paymentInfo_obj['version'] = $generalversion;

foreach ($paymentInfo_ids as $paymentInfo_id){
$temp_pay= [];
    $temp_payment = [];
    foreach ($languages as $language ){
        $fullPaymentInfos = GetAllPaymentInfos($conn,$language[0] ,$paymentInfo_id[0] );
        foreach ($fullPaymentInfos as $fullPaymentInfo){
            $paymentInfo_obj[$fullPaymentInfo[0]] = ['version'=>$fullPaymentInfo[3] ];
            array_push($temp_pay,['head'=>$fullPaymentInfo[1],'description'=>$fullPaymentInfo[2]]);
        }
    }
    $paymentInfo_obj[$fullPaymentInfo[0]]['languages'] = $temp_pay;

}

$original_obj = [ ...$original_obj,$paymentInfo_obj];


$labels_ids = getAllLabels($conn,1,0);
// Create LabelBox  Object  NOT COMPLETED THIS PART IN LANGUAGES SECTION
$labelBox_obj = [];
$labelBox_obj['version'] = $generalversion;

foreach ($labels_ids as $labels_id){
$temp_labels =[];
    foreach ($languages as $language ){
        $fullLabelBoxes = getAllLabels($conn , $language[0] ,$labels_id[0]);
        foreach ($fullLabelBoxes as $fullLabelBox){
            $labelBox_obj[$fullLabelBox[0]] = ['version' =>$fullLabelBox[2] ];
            array_push($temp_labels,['name' =>$fullLabelBox[1] ]);
        }

    }
    $labelBox_obj[$fullLabelBox[0]]['languages'] = $temp_labels;

}

$original_obj = [ ...$original_obj,$labelBox_obj];

$ratedCategories_ids = getRatedCategories($conn,1,0);
// Create RatedCategory  Object  NOT COMPLETED THIS PART IN LANGUAGES SECTION
$rated_cat_obj = [] ;
$rated_cat_obj['version'] = $generalversion;

foreach ($ratedCategories_ids as $ratedCategories_id){
    $temp_rated = [];
    foreach ($languages as $language ){
        $fullRatedCategories =  getRatedCategories($conn , $language[0] , $ratedCategories_id[0] );
        foreach ($fullRatedCategories as $fullRatedCategory){
            $rated_cat_obj[$ratedCategories_id[0]] = ['orderNumber' => $fullRatedCategory[3] ];
            array_push($temp_rated,['name' =>$fullRatedCategory[1] ]);
        }
    }
    $rated_cat_obj[$ratedCategories_id[0]]['languages'] =  $temp_rated;
}

$original_obj = [ ...$original_obj,$rated_cat_obj];


$includedService_ids = getAllIncludeServices($conn,1,0);
// Create Included Service  Object  NOT COMPLETED THIS PART IN LANGUAGES SECTION
$included_serv_obj = [];
$included_serv_obj['version'] = $generalversion;

foreach ($includedService_ids as $includedService_id){
    $temp_included = [];
    foreach ($languages as $language ){
        $fullIncludedServices =  getAllIncludeServices($conn , $language[0] , $includedService_id[0]);

        foreach ( $fullIncludedServices as $fullIncludedService) {
            $included_serv_obj[$includedService_id[0]] = ['version' =>  $fullIncludedService[2] ,'icon' => $fullIncludedService[3]   ];
            array_push($temp_included, ['name' => $fullIncludedService[1]]);
        }
    }
    $included_serv_obj[$includedService_id[0]]['languages'] =   $temp_included;
}

$original_obj = [ ...$original_obj,$included_serv_obj];

$allVendorIds = getAllVendors ($conn);
//Create Vendor Object
$vendor_obj = [];
$vendor_obj['version'] =  $generalversion ;

foreach ( $allVendorIds as $allVendorId){

    $basicVendorInfos =  getVendorBasicInfo($conn , $allVendorId);
    $isBestoff = IsBestoff($conn , $allVendorId);
    $labelbox_array = LabelBoxArray($conn,$allVendorId);
    $vendorImages = VendorImages($conn,$allVendorId);
    $rated = Rated($conn,$allVendorId);
    $includedService_ids =VendorIncludedService($conn,$allVendorId);
    $language_temp = [];
    foreach ($languages as $language ){
        $extraVendorInfo = extraVendorInfo($conn,$language[0],$allVendorId);
        array_push($language_temp,[$language[0]=>$extraVendorInfo ]);
    }

    foreach ($basicVendorInfos as $basicVendorInfo){
        $vendor_obj[$allVendorId] = ['version'=>$basicVendorInfo[0] ,'isBestoff' => $isBestoff, 'idDestination' => $basicVendorInfo[1],
        'priceAdult' => $basicVendorInfo[2],
        'originalPrice' => $basicVendorInfo[3],
        'discount' => $basicVendorInfo[4],
        'priceKid' => $basicVendorInfo[5],
            'infantPrice' => $basicVendorInfo[6],
          'imageBasic' => ['path'=>$basicVendorInfo[7],'version'=>$basicVendorInfo[8]],
            'idCategory' => $basicVendorInfo[9],
            'idPaymentInfo' => $basicVendorInfo[10],
            'googleMapString' => ['path'=>$basicVendorInfo[11],'version'=>$basicVendorInfo[12]],
            'forHowManyPersonsIs' => $basicVendorInfo[13],
            'labelbox'=>$labelbox_array,
            'images'=>$vendorImages,
            'rated'=>$rated,
            'includedServices'=>$includedService_ids,
            'languages' => $language_temp
        ];

    }

}

$original_obj = [ ...$original_obj,$vendor_obj];


file_put_contents('test.json',[date('Y-m-d H:i:s'),json_encode($original_obj)]);
header('location:../../admin/');

//$myJSON = json_encode($original_obj);
//echo $myJSON;