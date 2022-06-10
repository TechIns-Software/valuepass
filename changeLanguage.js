const changeLanguage = (value) => {
    $.ajax({
        type: "POST",
        url: "changeLanguage.php",
        data: {
            language: value
        },
        success: function(data) {
            console.log(data);
            window.location.reload();
        }
    });
    console.log(value);
}