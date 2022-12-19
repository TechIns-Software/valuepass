
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
                            <?php echo $vendor->getId() == 5 ? '<p class="sellout_label2 m-0">'.$menu[203].'    </p>' : '';?>
                            <h3 class="vendorname"><a href="adventure_page.php?id=<?php echo $vendor->getId();?>"><?php echo $vendor->getName();?></a></h3>
                            <p class=" label"><?php echo implode(' / ', $vendor->getLabelsBoxNames());?></p>
                            <p class="criteria">
                                       <?php echo $menu[44] ?>
                                       <?php echo str_repeat('<i class="icon_star voted"></i>',$vendor->getAverageRated())?>
                                       <?php echo str_repeat('<i class="icon_star"></i>', $vendor::$MAX_STARS - $vendor->getAverageRated())?>
                                    </p>

                            <!--                                    <span class="voucher_av">-->
                            <!--                                        --><?php //echo $menu[45] ?>
                            <!--                                        <b> --><?php //echo $vendor->getAvailabilityTodayVoucher();?><!-- </b>-->
                            <!--                                    </span>-->

                            <div class="row  buyNow_part" style="display: none">
                                <div class="col-12 d-flex justify-content-between nowrap ">
                                    <div class="buyvp_label" >  <?php echo $menu[46] ?>  <span class="nowText">  <?php echo $menu[195] ?> </span>    </div>
                                    <div class="buyvp_price">  <b class="nowText"><?php echo $vendor->getPriceAdult();?>€ </b>/ <span class="perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span></div>
                                </div>
                                <div class="col-12 ">
                                    <b >
                                        <?php  echo $_SESSION["languageId"] == 1? 'To':''  ?>  <span class="nowText">VP</span> <?php echo $menu[196] ?>
                                    </b>
                                </div>
                            </div>
                            <div class="row paylater_box" style="display: none">
                                <div class="col-12 pay_value  d-flex justify-content-between  ">
                                    <div ><?php echo $menu[49] ?> <span class="laterText">  <?php echo $menu[197] ?> </span> </div>
                                    <div>
                                        <span class="from_price"> <?php echo $vendor->getOriginalPrice();?>€ </span>
                                        <span class="laterText"><?php echo $totalToPay;?>   € </span> / <span class="perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <p  class="my-0">  <?php echo $menu[198] ?> </p>
                                </div>
                            </div>
                            <div class="row" style="display: none">
                                <div class="col">  <p class="vp_discount my-0 "><?php echo $menu[50] ?>  <?php echo $vendor->getDiscount();?>% <?php echo $menu[51] ?></p></div>

                            </div>
                            <div class="row  my-1">
                                <div class="col-12 buyNow_part2 d-flex justify-content-around ">

                                    <div class="px-1 text-start buyNow_part2_text ">
                                        <?php if ( $_SESSION['languageId'] == 1 ){ ?>
                                            Κάντε κράτηση εν πλω <br>
                                            μέσω  <span class="vpicon"> VP </span>  Voucher

                                        <?php  }else{?>
                                            Book on board <br> via <span class="vpicon"> VP </span> Voucher
                                        <?php }?>
                                    </div>
                                    <div  <?php echo $_SESSION['languageId'] == 1 ? "class ='greekPrice ' ": "class='englishPrice'" ?> >
                                        <?php echo $vendor->getPriceAdult();?> € /<span class="buyNow_part2_perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row   my-1 ">
                                <div class="col-12  infoText1">
                                        <?php if ($_SESSION['languageId'] == 1){ ?>
                                            Κερδίστε <span class="vpicon"> έκπτωση </span> στην αρχική τιμή
                                        <?php  }else{?>
                                            Get a <span class="vpicon"> discount</span>  on the initial price
                                        <?php }?>
                                </div>

                                <div class="col-12  infoText2">
                                    <?php echo $menu[223] ;?>
                                </div>
                                <div class="col-12  text-end">
                                     <span class="from_price2">
                                        <?php echo $menu[48] ;?> <span class="exprice"><?php echo $vendor->getOriginalPrice();?>€ </span>
                                    </span>
                                </div>

                                <div class="col-12  text-end container-real-price2 ">
                                      <span class="real-price2">   <?php echo $totalToPay;?> € </span> /  <span class="perperson">  <?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span>
                                </div>

                                <div class="col-12 win-text ">
                                    <?php if ($_SESSION['languageId'] == 1){ ?>
                                        Χρησιμοποιώντας το <span class="vpicon">VP </span>Voucher <br>
                                        εξοικονομείτε<span class="vpicon"> <?php echo ($vendor->getOriginalPrice() - $totalToPay - $vendor->getPriceAdult() ) ?> €</span>  από την αρχική τιμή
                                    <?php  }else{?>
                                    Save <span class="vpicon"> <?php echo ($vendor->getOriginalPrice() - $totalToPay - $vendor->getPriceAdult() ) ?> €</span>  on the initial price<br>
                                    using  <span class="vpicon">VP </span> Voucher
                                   <?php }?>
                                </div>
                            </div>
                            <div class="row  border-top">
                                <p class="my-0">
                                    <span class="icon-down-1" id="collapse_<?=$counterCollapseVendor?>"></span>
                                    <a class= "detailsCollapse detailsbtn " data-bs-toggle="collapse" href="#collapse<?=$counterCollapseVendor?>"
                                       role="button" aria-expanded="false" aria-controls="collapseExample" >
                                        <span id="collapse1Span<?=$counterCollapseVendor?>"><?=$menu[228]?></span>
                                        <span class="displayNone" id="collapse2Span<?=$counterCollapseVendor?>"><?=$menu[229]?></span>
                                    </a>
                                </p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="collapse " id="collapse<?=$counterCollapseVendor?>">
                                            <div class="text-end my-0">
                                                <p class="details-prices"><b>  <?php echo $menu[224]?> <?php echo ($totalToPay + $vendor->getPriceAdult()  ) ;?>€/
                                                    <span ><?php echo $vendor->getForHowManyPersonsIsString($menu[183],$menu[184],$menu[185],$menu[186]);?> </span>  </b></p>
                                                    <p class="details-prices-text">(<b class="vpicon">  VP</b> Voucher + <?php echo $menu[225]?>) </p>
                                            </div>
                                            <div>
                                                <li class="details-prices-text" ><b class="vpicon ">VP </b> Voucher = <?php echo $menu[226]?>
                                                </li>
                                                <li class="details-prices-text"><?php echo $menu[225]?> = <?php echo $menu[227]?> </li>


                                            </div>
                                        </div>
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
                <?php
                $counterCollapseVendor = $counterCollapseVendor + 1;
            }
            ?>
    </div>

<?php
    $GLOBALS['counterForCollapseVendor'] = $counterCollapseVendor + 1;
}
?>
