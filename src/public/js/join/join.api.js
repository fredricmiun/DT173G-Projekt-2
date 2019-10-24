// Url för rest
const url =
  "http://localhost/DT173G%20-%20Projekt/build/public/api/join/join.php";

$("#signup").submit(function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  let username = formData.get("username");
  let email = formData.get("email");
  let password = formData.get("password");
  let password_confirm = formData.get("password_confirm");

  fetch(url, {
    method: "POST",
    body: JSON.stringify({
      username: username,
      email: email,
      password: password,
      password_confirm: password_confirm
    })
  })
    .then(function(response) {
      if (response.status !== 200) {
        console.log(response.status);
        return;
      }
      response.json().then(function(data) {
        $(".response_errors").show();
        $(".response_errors").text(data.content);
        if (data.response == "error") {
          $(".response_errors").css("background-color", "#FFEDED");
        } else {
          $(".response_errors").css("background-color", "#47ff9a");
          window.setTimeout(function() {
            location.reload();
          }, 1000);
        }
      });
    })
    .catch(function(err) {
      console.log("Fetch Error:", err);
    });
});
