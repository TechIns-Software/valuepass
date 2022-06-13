function getAjax(data, callbackFnc, relativePosition = '', url = 'admin_actions.php') {
    $.ajax({
        type: "POST",
        url: relativePosition + url,
        data: data,
        success: callbackFnc,
        dataType: "json",
        // error: (error, typeError, cc) => {
        //     console.log(error);
        //     console.log(typeError);
        //     console.log(cc);
        // }
    });

}