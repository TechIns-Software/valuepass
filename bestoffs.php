
<?php
function bestoffs($bestOffs,$menu){
    $counterCollapseVendor = $GLOBALS['counterForCollapseVendor'] ?? 1;
?>
        <div id="reccomended" class="owl-carousel owl-theme">

            <?php
            foreach ($bestOffs as $vendor) {
                $moneySaved = $vendor->getOriginalPrice() * ($vendor->getDiscount() / 100);
                $totalToPay = $vendor->getOriginalPrice() - $moneySaved - $vendor->getPriceAdult();

                ?>
                <div class="item">
                    <div class="box_grid">

                        <a href="adventure_page.php?id=<?php echo $vendor->getId();?>">
                            <img src="vendorImages/<?php echo $vendor->getId().'/'. $vendor->getPathToImage();?>"
                                 class="img-fluid" alt="" width="800" height="933">
                        </a>
                        <div class="wrapper best ">
                            <small><?php echo $vendor->getCategoryName();?></small>
                            <div class="bookmarkContainer2 "> <?php echo $menu[48] ;?> <span class="text-decoration-line-through"><?php echo $vendor->getOriginalPrice();?>€ </span>  <br>   <?php echo $vendor->getPriceAdult();?> €/ <span class="buyNow_part2_perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span>  </div>

                            <div style="margin-top: -50px">
                            <?php echo $vendor->getId() == 5 ? '<p class="sellout_label2 m-0">'.$menu[203].'    </p>' : '';?>
                            <h3 class="vendorname"><a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><?php echo $vendor->getName();?></a></h3>
                            <p class=" label"><?php echo implode(' / ', $vendor->getLabelsBoxNames());?></p>
                            <p class="criteria">
                                       <?php echo $menu[44] ?>
                                       <?php echo str_repeat('<i class="icon_star voted"></i>',$vendor->getAverageRated())?>
                                       <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated())?>
                                    </p>
                                <div class="row my-1">
                                    <div class="col-12  infoText1">
                                        <p class="my-1" style="font-size: 15px">
                                            <?php if ($_SESSION['languageId'] == 1) { ?>
                                                Κερδίστε <span class="vpicon"> έκπτωση </span> μέσω του <span
                                                        class="vpicon"> VP </span>  Voucher
                                            <?php } else { ?>

                                                Get a <span class="vpicon"> discount</span>  via  <span class="vpicon">VP </span> Voucher
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="d-flex justify-content-end">
                                                                         <span class="from_price2">
                                        <?php echo $menu[48]; ?> <span class="exprice"><?php echo $vendor->getOriginalPrice(); ?>€ </span>
                                    </span>
                                    </div>
                                    <div class="col-12 win-text ">
                                        <?php if ($_SESSION['languageId'] == 1) { ?>
                                            Χρησιμοποιώντας το <span class="vpicon">VP </span>Voucher <br>
                                            εξοικονομείτε<span
                                                    class="vpicon"> <?php echo($vendor->getOriginalPrice() - $totalToPay - $vendor->getPriceAdult()) ?> €</span>  από την αρχική τιμή
                                        <?php } else { ?>
                                            Save <span
                                                    class="vpicon"> <?php echo($vendor->getOriginalPrice() - $totalToPay - $vendor->getPriceAdult()) ?> €</span>  on the initial price
                                            <br>
                                            using  <span class="vpicon">VP </span> Voucher
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="d-flex justify-content-between">
                                        <div class="p-0 m-0 "><b> <?php if ($_SESSION['languageId'] == 1) { ?>
                                                    Πληρώστε στην τοποθεσία<br>
                                                    της δραστηριότητας
                                                <?php } else { ?>
                                                    Pay at the activity location
                                                <?php } ?>
                                            </b>
                                        </div>
                                        <div class=""><b><?php echo $totalToPay; ?>
                                                €/ <?php echo $vendor->getForHowManyPersonsIsString($menu[183], $menu[184], $menu[185], $menu[186]); ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-1 ">
                                    <div class="d-flex justify-content-between offerContainer align-items-start">
                                        <div>
                                            <p class=" text-white my-auto " style="font-size: 15px">
                                                <?php if ($_SESSION['languageId'] == 1) { ?>
                                                    Κάντε Κράτηση εν πλω<br>
                                                    μέσω <span class="vpicon"> VP </span> Voucher

                                                <?php } else { ?>
                                                    Book on board <span class="vpicon">VP </span> Voucher
                                                <?php } ?>
                                            </p>
                                        </div>
                                        <div class="my-auto"> <?php echo $vendor->getPriceAdult(); ?> €/ <span
                                                    class="buyNow_part2_perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183], $menu[184], $menu[185], $menu[186]); ?> </span>
                                        </div>
                                    </div>
                                </div>


                            <div class="row">
                                <div class="col-12">
                                    <a href="adventure_page.php?id=<?php echo $vendor->getId(); ?>">
                                        <div class=" buy_button2"> <?php echo $menu[52] ?>  </div>
                                    </a>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php
                $counterCollapseVendor = $counterCollapseVendor + 1;
            }
            ?>
    </div>

<?php
    $GLOBALS['counterForCollapseVendor'] = $counterCollapseVendor + 1;
}
?>
