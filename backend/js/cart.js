function getAjax(data, callbackFnc, relativePosition='', url='backend/actions.php') {
    $.ajax({
        type: "POST",
        url: relativePosition + url,
        data: data,
        success: callbackFnc,
        dataType: "json",
        error: (error, typeError, cc) => {
            console.log(error);
            console.log(typeError);
            console.log(cc);
        }
    });
}

function addToCart(objectOfDetails) {
    // f.e. objectOfDetails = {'vendorId':1,'adults':2,'children':2,'infants':1}
    const data = {
        "action": 'addProduct',
        'product': objectOfDetails
    };
    const callBackFnc = (date) => {
        //TODO:check message return and inform user
        console.log(data);
    }
    getAjax(data, callBackFnc);

}

function deleteItem(idVendorItem) {
    const data = {
        "action": 'deleteProduct',
        'item': idVendorItem
    };

    const callBackFnc = (data) => {
        if (data[0] === "OK") {
            location.reload();
        } else {
            alert(data[0]);
        }
        //TODO:check message return and inform user
        console.log(data);
    }
    getAjax(data, callBackFnc);
}

function getPackagesAvailable() {
    const idVendor = document.getElementById('vendorId').value;
    const dateString = document.getElementById('date').value;
    const numberAdults = $('#adultsInput').val();
    const numberChildren = $('#childrenInput').val();
    const numberInfants = $('#infantsInput').val();
    console.log(numberChildren, numberAdults, numberInfants);
    console.log(dateString, idVendor);
    if (
        Number(numberAdults) ||
        Number(numberChildren)
    ) {
        if (numberInfants > 0 && numberAdults == 0) {

        } else {
            if (dateString) {
                const newFormatDate = $('#date').attr('value2');
                console.log(newFormatDate);
                const data = {
                    'action': 'getPackagesAvailable',
                    'idVendor': idVendor,
                    'date': newFormatDate,
                    'adults': numberAdults,
                    'children': numberChildren,
                    'infants': numberInfants
                };
                const callBack = (data) => {
                    if (data[0] === 'NoneFound') {

                        console.log(data);
                    } else {
                        document.getElementById('option').outerHTML = data[0];

                    }
                }
                getAjax(data, callBack);

            }

        }
    }
}

function checkout() {
    const data = {
        'action': 'checkout'
    };
    const callBack = (data) => {
        if (data[0] === 'mustSignIn') {

        } else if (data[0] === 'muchProducts') {

        } else if (data[0] === 'lessProducts') {

        } else if (data[0] === 'unavailableVouchers') {

        } else {

        }
    };
}

//no needed right now
function addPersonInInputField(idInput, idMinusIcon) {
    const inputField = document.getElementById(idInput);
    inputField.value = Number(inputField.value) + 1;
    idMinusIcon.disabled = false;
}
//no needed right now
function removePersonInInputField(idInput, idMinusIcon) {
    const inputField = document.getElementById(idInput);
    inputField.value = Number(inputField.value) - 1;
    if (inputField.value < 0) {
        inputField.value = 0;
    }
    if (inputField.value == 0) {
        idMinusIcon.disabled = true;
    }
}

