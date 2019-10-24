// Funktionen som visar all data
function displayData(a, b) {
  let element = document.getElementsByClassName("edit-content");
  element[1].innerHTML = "";

  // Använder en switch för att särskilja data som ska presenteras i edit lightboxen
  switch (a) {
    case "adress":
      b.forEach(function(elem) {
        element[1].innerHTML =
          "<form class='form'><div class='content_container'><input type='hidden' name='key' value='adress'>" +
          "<input type='text' name='street' placeholder='Gata' value='" +
          elem.street +
          "'>" +
          "<input type='text' name='zip' placeholder='Postkod' value='" +
          elem.zip_code +
          "'>" +
          "<input type='text' name='city' placeholder='Stad' value='" +
          elem.city +
          "'>" +
          "<input type='text' name='country' placeholder='Land' value='" +
          elem.country +
          "'>" +
          "<button class='__save' type='submit'>Spara</button>" +
          "</div></form>";
      });
      break;
    case "kontakta":
      b.forEach(function(elem) {
        element[1].innerHTML =
          "<form class='form'><div class='content_container'><input type='hidden' name='key' value='kontakta'>" +
          "<input type='text' name='phone' placeholder='Telefonnummer' value='" +
          elem.phone +
          "'>" +
          "<input type='text' name='email' placeholder='Email' value='" +
          elem.email +
          "'>" +
          "<input type='text' name='website' placeholder='Hemsida' value='" +
          elem.website +
          "'>" +
          "<button class='__save' type='submit'>Spara</button>" +
          "</div></form>";
      });
      break;
    case "personligt":
      b.forEach(function(elem) {
        element[1].innerHTML =
          "<form class='form'><div class='content_container'><input type='hidden' name='key' value='personligt'>" +
          "<input type='text' name='fname' placeholder='Förnamn' value='" +
          elem.first_name +
          "'>" +
          "<input type='text' name='lname' placeholder='Efternamn' value='" +
          elem.last_name +
          "'>" +
          "<input type='text' name='title' placeholder='Arbetstitel' value='" +
          elem.work_title +
          "'><br/>" +
          "<textarea name='description' placeholder='Beskrivning'>" +
          elem.pb +
          "</textarea><br/>" +
          "<button class='__save' type='submit'>Spara</button>" +
          "</div></form>";
      });
      break;
    case "edu":
      b.forEach(function(elem) {
        element[1].innerHTML +=
          "<form class='form'><div class='content_container'><input type='hidden' name='key' value='edu'>" +
          "<input type='hidden' name='id' value='" +
          elem.id +
          "'>" +
          "<input type='text' name='place' placeholder='Skola' value='" +
          elem.place +
          "'>" +
          "<input type='text' name='description' placeholder='Kurs/Program' value='" +
          elem.description +
          "'>" +
          "<input type='text' name='start' placeholder='Startdatum' value='" +
          elem.start +
          "'>" +
          "<input type='text' name='end' placeholder='Slutdatum' value='" +
          elem.end +
          "'>" +
          "<button onClick='deleteData(" +
          elem.id +
          "," +
          "&apos;edu&apos;" +
          ")' class='__delete' name='delete_id' type='button'>Ta bort</button>" +
          "<button class='__save' type='submit'>Spara</button>" +
          "</div></form>";
      });
      element[1].innerHTML +=
        "<form class='create-form'><div class='content_container'>" +
        "<h4>Lägg till utbildning</h4>" +
        "<input type='hidden' name='key' value='edu'>" +
        "<input type='text' name='place' placeholder='Skola' value=''>" +
        "<input type='text' name='description' placeholder='Kurs/Program' value=''>" +
        "<input type='text' name='start' placeholder='Startdatum' value=''>" +
        "<input type='text' name='end' placeholder='Slutdatum' value=''>" +
        "<button class='__save' type='submit'>Skapa</button>" +
        "</div></form>";
      // insertDb() anropas eftersom fler forms skapas, och i denna funktion hittar vi alla forms i en loop, detta måste loopas för att de forms som skapas för varje potentiellt datavärde ska kunna skickas till databasen eller uppdateras
      insertDb();
      break;
    case "kur":
      b.forEach(function(elem) {
        element[1].innerHTML +=
          "<form class='form'><div class='content_container'><input type='hidden' name='key' value='kur'>" +
          "<input type='hidden' name='id' value='" +
          elem.id +
          "'>" +
          "<input type='text' name='place' placeholder='Skola' value='" +
          elem.place +
          "'>" +
          "<input type='text' name='description' placeholder='Kurs/Program' value='" +
          elem.description +
          "'>" +
          "<input type='text' name='start' placeholder='Startdatum' value='" +
          elem.start +
          "'>" +
          "<button onClick='deleteData(" +
          elem.id +
          "," +
          "&apos;kur&apos;" +
          ")' class='__delete' name='delete_id' type='button'>Ta bort</button>" +
          "<button class='__save' type='submit'>Spara</button>" +
          "</div></form>";
      });
      element[1].innerHTML +=
        "<form class='create-form'><div class='content_container'>" +
        "<h4>Lägg till Kuriosa / Pris</h4>" +
        "<input type='hidden' name='key' value='kur'>" +
        "<input type='text' name='place' placeholder='Företag' value=''>" +
        "<input type='text' name='description' placeholder='Beskrivning' value=''>" +
        "<input type='text' name='start' placeholder='När skedde det?' value=''>" +
        "<button class='__save' type='submit'>Skapa</button>" +
        "</div></form>";
      insertDb();
      break;
    case "exp":
      b.forEach(function(elem) {
        element[1].innerHTML +=
          "<form class='form'><div class='content_container'><input type='hidden' name='key' value='exp'>" +
          "<input type='hidden' name='id' value='" +
          elem.id +
          "'>" +
          "<input type='text' name='place' placeholder='Skola' value='" +
          elem.place +
          "'>" +
          "<input type='text' name='role' placeholder='Kurs/Program' value='" +
          elem.role +
          "'>" +
          "<input type='text' name='description' placeholder='Kurs/Program' value='" +
          elem.description +
          "'>" +
          "<input type='text' name='start' placeholder='Startdatum' value='" +
          elem.start +
          "'>" +
          "<input type='text' name='end' placeholder='Startdatum' value='" +
          elem.end +
          "'>" +
          "<button onClick='deleteData(" +
          elem.id +
          "," +
          "&apos;exp&apos;" +
          ")' class='__delete' name='delete_id' type='button'>Ta bort</button>" +
          "<button class='__save' type='submit'>Spara</button>" +
          "</div></form>";
      });
      element[1].innerHTML +=
        "<form class='create-form'><div class='content_container'>" +
        "<h4>Lägg till Kuriosa / Pris</h4>" +
        "<input type='hidden' name='key' value='exp'>" +
        "<input type='text' name='place' placeholder='Företag' value=''>" +
        "<input type='text' name='role' placeholder='Roll' value=''>" +
        "<input type='text' name='description' placeholder='Kort beskrivning' value=''>" +
        "<input type='text' name='start' placeholder='Start' value=''>" +
        "<input type='text' name='end' placeholder='Slut' value=''>" +
        "<button class='__save' type='submit'>Skapa</button>" +
        "</div></form>";
      insertDb();
      break;
    case "skills":
      b.forEach(function(elem) {
        element[1].innerHTML +=
          "<form class='form'><div class='content_container'><input type='hidden' name='key' value='skills'>" +
          "<input type='hidden' name='id' value='" +
          elem.id +
          "'>" +
          "<input type='text' name='skill' placeholder='Färdighet' value='" +
          elem.experience +
          "'>" +
          "<button onClick='deleteData(" +
          elem.id +
          "," +
          "&apos;skills&apos;" +
          ")' class='__delete' name='delete_id' type='button'>Ta bort</button>" +
          "<button class='__save' type='submit'>Spara</button>" +
          "</div></form>";
      });
      element[1].innerHTML +=
        "<form class='create-form'><div class='content_container'>" +
        "<h4>Lägg till färdighet</h4>" +
        "<input type='hidden' name='key' value='skills'>" +
        "<input type='text' name='skill' placeholder='Färdighet' value=''>" +
        "<button class='__save' type='submit'>Skapa</button>" +
        "</div></form>";
      insertDb();
      break;
  }

  // Anropar updateDb av samma anledning som insertDb(). Varje rad av data innehåller uppdateringsmöjlighet, detta loopas för att göra det möjligt att uppdatera varje rad.
  updateDb();
}

// Konstant för url_edit
const url_edit =
  "http://localhost/DT173G%20-%20Projekt/build/private/api/cv/cv-modify.php";

// Denna funktion laddar innehållet i lightboxen för edits. Den baserar innehållet i lightboxen på den data som finns i redigeringsknappen.
// Trycker vi exempelvis på att redigera 'adress', skickas det värdet till rest api och servern vet då vad som ska redigeras, och matar oss sedan med rätt innehåll.
// Detta för att undvika att ha flera lightbox som är unika för sitt ändamål. Nu klarar vi oss på en lightbox.
let loadEdit = x => {
  fetch(url_edit, {
    method: "POST",
    body: JSON.stringify({
      data: x
    })
  })
    .then(function(response) {
      if (response.status !== 200) {
        console.log(response.status);
        return;
      }
      response.json().then(function(data) {
        displayData(data["type"], data["content"]);
        console.log(data["content"]);
      });
    })
    .catch(function(err) {
      console.log("Fetch Error:", err);
    });
};

// Denna funktion används för att uppdatera information.
// För att göra det så effektivt som möjligt skickas all data i Html Form. All information läggs in i ett objekt som sedan stringifieras av JSON, denna sträng skickas till REST API där det sedan omvandlas till JSON, och därefter lagras i respektive tabell i databasen.

let updateDb = () => {
  let form = document.getElementsByClassName("form");

  for (let i = 0; i < form.length; i++) {
    // console.log(form[i]);
    form[i].addEventListener("submit", function(e) {
      e.preventDefault();

      const formData = new FormData(this);
      let xy = JSON.stringify(Object.fromEntries(formData));

      console.log(xy);

      fetch(url_edit, {
        method: "put",
        body: JSON.stringify({
          form: xy
        })
      })
        .then(function(response) {
          if (response.status !== 200) {
            console.log(response.status);
            return;
          }
          response.json().then(function(data) {
            getData();
            console.log(data);
          });
        })
        .catch(function(err) {
          console.log("Fetch Error:", err);
        });
    });
  }
};

// Använder samma princip som för att uppdatera. Forminnehåll -> objekt -> sträng -> rest api -> konvertera till json -> lägg in i databas
let insertDb = () => {
  let form = document.getElementsByClassName("create-form");

  for (let i = 0; i < form.length; i++) {
    // console.log(form[i]);
    form[i].addEventListener("submit", function(e) {
      e.preventDefault();

      const formData = new FormData(this);

      // För att kunna uppdatera listan över innehåll i lightbox
      let loadEditAgain = formData.get("key");
      let xy = JSON.stringify(Object.fromEntries(formData));

      fetch(url_edit, {
        method: "post",
        body: JSON.stringify({
          data: "insert",
          form: xy
        })
      })
        .then(function(response) {
          if (response.status !== 200) {
            console.log(response.status);
            return;
          }
          response.json().then(function(data) {
            getData();
            loadEdit(loadEditAgain);
            console.log(data);
          });
        })
        .catch(function(err) {
          console.log("Fetch Error:", err);
        });
    });
  }
};

// Deletefunktion. För att kunna använda samma funktion för alla deletemöjligheter så lagras "nyckeln" som värde.
// Det är den nyckeln som sedan på serversidan avgör vilken tabell som det ska tas bort ifrån.
// Detta gör att alla delete-knappar kan använda samma funktion, förutsatt att nyckeln är satt i delete-knappen som värde.
let deleteData = (id, key) => {
  fetch(url_edit, {
    method: "DELETE",
    body: JSON.stringify({
      id: id,
      key: key
    })
  })
    .then(function(response) {
      if (response.status !== 200) {
        console.log(response.status);
        return;
      }
      response.json().then(function(data) {
        getData();
        loadEdit(key);
        console.log(data);
      });
    })
    .catch(function(err) {
      console.log("Fetch Error:", err);
    });
};
