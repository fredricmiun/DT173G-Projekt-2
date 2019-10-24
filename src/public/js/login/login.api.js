// Url för rest

$("#login").ready(function() {
  $(".response_errors").hide();
  $("#log_in").submit(function(e) {
    $.ajax({
      type: "POST",
      url: "api/login/login.php",
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
