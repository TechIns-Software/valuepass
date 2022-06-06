<?php
$title = "Προσθήκη Label";
include_once "header.php";

?>



<div class="content-wrapper">
    <div class="container-fluid">
        <div class="loc_title">
            <h4>Εισαγωγή Label</h4>
        </div>

        <form id="myform">

            <?php
            // for each language the admin has to enter a location
            // TODO : WHILE LOOP WHITH ALL THE LANGUAGES WITH INPUTS
            ?>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Label (flag)</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Πρέπει να μπει Label σε όλες τις γλώσσες</div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Εισαγωγή label</button>
        </form>
    </div>
</div>





<?php

include_once "footer.php";

?>