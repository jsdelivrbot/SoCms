if ($(".error").text().trim().length > 1) {
    sweetAlert("Oops!", $(".error").text(), "error"); //SweetAlert utan callback-funktion
    $(".error").css("display", "none");
}
if ($(".success").text().trim().length > 1) { //Om text dyker upp i elementet med class="success"
    swal({ //SweetAlert för meddelanden till användaren
            title: "Success!", //titel
            text: $(".success").text(), //text i alerten
            type: "success" //typ av meddelande
        },
        function() { //Callback funktion för register.php redirect - sker efter att man klickat OK
            window.location.href = 'index.php'; //Skickas till startsidan
        }); //slut på SweetAlert
    $(".success").css("display", "none");
} //slut på if-sats