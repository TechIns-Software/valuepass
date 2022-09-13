<?php
//TODO get versions
$versionJSON = 1;


$filename = 'example.json';
if (!file_exists($filename)) {
    exit('No file found!');
}

$json = file_get_contents($filename);
$respone = json_decode($json,true);
$element_expected = array(
    'version'=>1,
    //must no version has, the number of languages instead,
    //to be used below
    'languages'=>1,
    'destinations'=>1,
    'categoryVendor'=>1,
    'paymentInfoActivity'=>1,
    'labelsBox'=>1,
    'ratedCategory'=>1,
    'includedService'=>1,
    'vendors'=>1
);

foreach ($element_expected as $key => $version) {
    if (!array_key_exists($key, $respone)) {
        exit('File is not well structured');
    }

}
// # Step 1: Check if something is updated

if ($element_expected['version'] < $respone['version']) {
    if ($element_expected['languages'] < count($respone['languages'])) {
        //a language is added
    } else {
        // # Destination checking
        if ($element_expected['destinations'] < $respone['destinations']['version']) {
            // # prepare new data
            // TODO get versions of destinations
            $destinationsVersions = array('1'=>1, '2'=>1);
            foreach ($respone['destinations'] as $destination => $destinationJSON) {
                if ($destination != 'version') {
                    if (!array_key_exists($destination, $destinationsVersions)) {
                        // # add new destination
                    } else {
                        // # check the existed destination
                        if ($destinationsVersions[$destination] < $destinationJSON['version']) {
                            # update the existed destination
                        }
                    }
                }
            }
        }

        // # categoryVendor checking
        if ($element_expected['categoryVendor'] < $respone['categoryVendor']['version']) {
            // # preparing new data
            //TODO get versions of categoryVendor
            $categoryVendorVersions = array('1'=>1,'2'=>1);
            foreach ($respone['categoryVendor'] as $categoryVendor => $categoryVendorJSON) {
                if ($categoryVendor != 'version') {
                    if (!array_key_exists($categoryVendor, $categoryVendorVersions)) {
                        // # add new category vendor
                    } else {
                        // # check the existed categoryVendor
                        if ($categoryVendorVersions[$categoryVendor] < $categoryVendorJSON['version']) {
                            // # update the category vendor
                        }
                    }
                }
            }
        }



        if ($element_expected['vendors'] < $respone['vendors']['version']) {
            // # preparing new data
            //TODO get versions of vendors
            $vendors = array();
        }

    }
}

