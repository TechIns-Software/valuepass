// Quantity buttons
function qtySum() {
    initializeLabels();
    var arr = document.getElementsByName('qtyInput');
    var tot = 0;
    var displayTotal = 0;
    //var childrenLabel = document.getElementById('childrenLabel');
    //         var infantLabel = document.getElementById('infantsLabel');
    //
    //         var childrenNumber = document.getElementById('')
    for (var i = 0; i < arr.length; i++) {
        var _temp = 0;
        if (parseInt(arr[i].value)) {
            _temp = parseInt(arr[i].value);
            tot += _temp;
        }
        if (arr[i].id === 'adultsInput') {
            if (_temp) {
                displayTotal = displayTotal + 1;
            } else {
                document.getElementById('adultsLabel').classList.add('displayNone');
            }
        } else if (arr[i].id === 'childrenInput') {
            if (_temp) {
                displayTotal = displayTotal + 1;
                document.getElementById('childrenLabel').classList.remove('displayNone');
            }
        } else if (arr[i].id === 'infantsInput') {
            if (_temp) {
                displayTotal = displayTotal + 1;
                document.getElementById('infantsLabel').classList.remove('displayNone');
            }
        }
    }

    if (displayTotal > 1) {
        document.getElementById('displayTotalWord').classList.remove('displayNone');
        var numberAdults1 = document.getElementById('adultsInput').value;
        var numberChildren1 = document.getElementById('childrenInput').value;
        var numberInfants1 = document.getElementById('infantsInput').value;
        if (Number(numberInfants1)) {
            document.getElementById('infantsLabelNext').classList.remove('displayNone');
            document.getElementById('infantsLabelNext').innerHTML = `${numberInfants1}, `;
        }
        if (Number(numberChildren1)) {
            document.getElementById('childrenLabelNext').innerHTML = `${numberChildren1}, `;
            document.getElementById('childrenLabelNext').classList.remove('displayNone');
        }
        if (numberAdults1) {
            if (numberChildren1) {
                document.getElementById('adultsLabelNext').innerHTML = `${numberAdults1}, `;
            } else {
                if (numberInfants1) {
                    document.getElementById('adultsLabelNext').innerHTML = `${numberAdults1}, `;
                } else {
                    document.getElementById('adultsLabelNext').innerHTML = numberAdults1;
                }
            }
        }
    } else if (displayTotal == 0) {
        document.getElementById('adultsLabel').classList.remove('displayNone');
    }

    var cardQty = document.querySelector(".qtyTotal");
    cardQty.innerHTML = tot;
}

qtySum();


$(function () {

    $(".qtyButtons input").after('<div class="qtyInc"></div>');
    $(".qtyButtons input").before('<div class="qtyDec"></div>');
    $(".qtyDec, .qtyInc").on("click", function () {
        var whichClass = $(this).attr('class');

        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

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


function displayDetailsPeople(element, increaseFlag=true) {

    const elementId = element.attr('id');
    const value = element.attr('value');
    console.log(elementId, value);
}

function initializeLabels() {
    document.getElementById('childrenLabel').classList.add('displayNone');
    document.getElementById('childrenLabelNext').classList.add('displayNone');
    document.getElementById('childrenLabelNext').innerHTML = '';
    document.getElementById('infantsLabel').classList.add('displayNone');
    document.getElementById('infantsLabelNext').classList.add('displayNone');
    document.getElementById('infantsLabelNext').innerHTML = '';
    document.getElementById('displayTotalWord').classList.add('displayNone');
    document.getElementById('adultsLabelNext').innerHTML = '';
    document.getElementById('adultsLabel').classList.remove('displayNone');
}