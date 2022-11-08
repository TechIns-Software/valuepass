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
    // f.e. objectOfDetails = {'voucherVendorId':1,'adults':2,'children':2,'infants':1, 'vendorId': 1}
    const data = {
        "action": 'addProduct',
        'product': objectOfDetails
    };
    const callBackFnc = (data) => {
        if (data[0] === 'OK') {
            document.getElementById('cartNumberShow').innerText = data[1];
        } else {
            const modal_footer = document.getElementById('modalFooterInitial');
            const modal_body = document.getElementById('modalBodyInitial');
            const modal_body_error = document.getElementById('modalBodyError');
            modal_footer.classList.add('displayNone');
            modal_body.classList.add('displayNone');
            modal_body_error.classList.remove('displayNone');
            modal_body_error.innerHTML = `${data[0]}`;
            $('#questionmodal').on('hidden.bs.modal', function () {
                modal_footer.classList.remove('displayNone');
                modal_body.classList.remove('displayNone');
                modal_body_error.classList.add('displayNone');
            });
        }
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
                const nameVendor = document.getElementById('nameVendor').innerText;
                const data = {
                    'action': 'getPackagesAvailable',
                    'idVendor': idVendor,
                    'date': newFormatDate,
                    'adults': numberAdults,
                    'children': numberChildren,
                    'infants': numberInfants,
                    'nameVendor': nameVendor
                };
                console.log(data);
                const callBack = (data) => {
                    $("#option").empty();
                    $("#option").append(data[0]);
                }
                getAjax(data, callBack);

            }

        }
    }
}

function goBackInHistory(idSelector) {
    document.getElementById(idSelector).addEventListener('click', ()=> {
        if (!history.back()) {
            window.location = './index.php';
        }
    });
    document.getElementById(idSelector).addEventListener('touchend', ()=> {
        if (!history.back()) {
            window.location = './index.php';
        }
    });
}


