// Quantity buttons
function qtySum() {
    var arr = document.getElementsByName('qtyInput');
    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }

    var cardQty = document.querySelector(".qtyTotal");
    cardQty.innerHTML = tot;
}

qtySum();

var quantity = {
    adultsInput: 0,
    childrenInput: 0,
    infantsInput: 0
}


$(function () {

    $(".qtyButtons input").after('<div class="qtyInc"></div>');
    $(".qtyButtons input").before('<div class="qtyDec"></div>');
    $(".qtyDec, .qtyInc").on("click", function () {
        var whichClass = $(this).attr('class');

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if (whichClass == 'qtyInc') {
            var fromwho = $(this).prev();
            displayDetailsPeople(fromwho, true);
        } else {
            var fromwho = $(this).next();
            displayDetailsPeople(fromwho, false);
        }


        if ($button.hasClass('qtyInc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }

        $button.parent().find("input").val(newVal);
        qtySum();
        $(".qtyTotal").addClass("rotate-x");

    });

    function removeAnimation() {
        $(".qtyTotal").removeClass("rotate-x");
    }

    const counter = document.querySelector(".qtyTotal");
    counter.addEventListener("animationend", removeAnimation);

});


function displayDetailsPeople(element, flag) {

    const elementId = element.attr('id');
    const value = element.attr('value');

    if (flag) {
        quantity[`${elementId}`]++;
    } else {
        if (quantity[`${elementId}`] != 0) {
            quantity[`${elementId}`]--;
        }
    }

    for (key in quantity) {
        var displayMessage = '';
        if (quantity[key] > 0) {
            var smallMSg = (key, "", quantity[key])
            displayMessage.concat(" ", smallMSg);
        }
    }


}