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
            alert('Success');
        }
        //TODO:check message return and inform user
        console.log(data);
    }
    getAjax(data, callBackFnc);
}

function getPackagesAvailable() {
    //TODO make sure that a vendor no children, then in backend we check if to take only adults
    //TODO add a hidden input field that has idVendor
    const idVendor = document.getElementById('vendorId').value;
    const dateString = document.getElementById('date').value;
    const numberAdults = document.getElementById('adultsInput')
    const numberChildren = document.getElementById('childrenInput')
    const numberInfants = document.getElementById('infantsInput')
    if (
        Number(numberAdults.value) &&
        Number(numberChildren.value) &&
        Number(numberInfants.value)
    ) {
        if (Number(numberInfants.value) > 0 && numberAdults.value == 0) {
            numberAdults.value = 0;
            numberChildren.value = 0;
            numberInfants.value = 0;
        } else {
            const data = {
                'action': 'getPackagesAvailable',
                'idVendor': idVendor,
                'date': dateString,
                'adults': numberAdults.value,
                'children': numberChildren.value,
                'infants': numberInfants.value
            };
        }
    } else {
        numberAdults.value = 0;
        numberChildren.value = 0;
        numberInfants.value = 0;
    }
}

function addPersonInInputField(idInput, idMinusIcon) {
    const inputField = document.getElementById(idInput);
    inputField.value = Number(inputField.value) + 1;
    idMinusIcon.disabled = false;
}

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

