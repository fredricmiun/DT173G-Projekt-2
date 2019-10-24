// Url för rest

// Här har jag valt att använda jQuery.ajax() för att hantera inloggningsdata som skickas till databasen.
// Detta för php session inte var lika smidigt att hantera som i jQuery.ajax(), vad jag märkt.
// Något som jag heller inte fann superbra lösningar på, eller som jag förstod mig på. Detta funkar också!

// Vid successanrop hanterar vi också meddelanden som kommer tillbaka.

$("#login").ready(function() {
  $(".response_errors").hide();
  $("#log_in").submit(function(e) {
    $.ajax({
      type: "POST",
      url: "../private/api/login/login.php",
      data: $("form").serialize(),
      dataType: "json",
      success: function(data) {
        console.log(data);
        $(".response_errors").show();
        $(".response_errors").text(data.content);
        // success
        if (data.response == "success") {
          $(".response_errors").css("background-color", "#47ff9a");
          window.setTimeout(function() {
            location.reload();
          }, 1000);
        }
        // empty
        else if (data.response == "error") {
          $(".response_errors").css("background-color", "#FFEDED");
        }
        // error
        else {
          $(".response_errors").css("background-color", "#FFEDED");
        }
      },
      error: function(data) {
        console.log(data);
        $(".response_errors").show();
        $(".response_errors").text("An error occured");
      }
    });

    e.preventDefault();
  });
});
