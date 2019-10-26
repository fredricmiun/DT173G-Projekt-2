# DT173G - Webbutveckling III

[Mittuniversitetet](https://www.miun.se/ "Mittuniversitetets Hemsida")

### Moment Projekt

Frontend - Gulp

1.  Gulp & Tillägg

    - gulp-sourcemaps
      
      Sourcemaps används för att underlätta felsökning.

    - gulp-babel
      
      Tillägget har använts för att degradera nyare versioner av ES.

    - browser-sync
      
      Används för att underlätta arbetsflödet och uppdaterar webbläsaren automatiskt vid sparningar.

    - gulp-concat (Ej aktiverad)
      
      Används för att slå ihop filer. Denna är ej "aktiverad".

    - gulp-uglify-es (Ej aktiverad)
      
      Används för att fula ner js-kod. Används ej för tillfället.

    - gulp-sass
      
      Allt utseende är skrivet med hjälp av SASS-verktyget. Detta översätts sedan till ren CSS genom gulp - automatiserat.

2.  JS-filer

    - join.api.js
      Filen sköter formulärhanteringen av registrering av användare. Denna fil talar med ett api som gör det möjligt för en användare att skapas.

    - login.api.js
      Filen har hand om inloggningar. Filen talar med ett api som kontrollerar att uppgifterna stämmer och skapar sedan en session med användar id som sessions-id.

    - fetch.js
      Den här filen har hand om allt som berör redigering, inmatning eller borttagning av information i databasen. Den har inte hand om GET som visar CV:t, denna funktion finns tillgänglig i index.php filen.

    - tabindex.js
      En viktig fil för användarupplevelsen vid hanteringen av formulär. Featherlight har en bugg för tillfället där alla input-fields saknar tabindex, vilket gör att det inte går att hoppa mellan input-fields på ett smidigt sätt. Denna fil gör så att vi lägger till tabindex. Funkar i de flesta webbläsare.

3.  SCSS/CSS

    - All CSS är skriven med hjälp av SCSS-verktyg. Detta översätts sedan till CSS-kod.

4.  Övrigt

    - Det går att testa hemsidan på följande länk [Projekt](http://studenter.miun.se/~frfr1800/DT173G/proj/public/ "Testa hemsidan")

    - Följande kod är skriven direkt i index.php-filen eftersom inloggnings-sessioner inte verkar vilja följa med om detta läggs in i en separat fil. Varför detta händer har jag dessvärre inte kunskapen om. Det går att komma förbi om det skrivs i AJAX istället som med login.api.js-filen, jag vill dock använda Fetch för att vara konsekvent med de andra Fetch API-filerna.

```javascript
function getData() {
  fetch(url_, {
    method: "GET"
  })
    .then(function(response) {
      if (response.status !== 200) {
        console.log(response.status);
        return;
      }
      response.text().then(function(data) {
        elem[0].innerHTML = data;
        // console.log(data);
      });
    })
    .catch(function(err) {
      console.log("Fetch Error:", err);
    });
}
```

- I .gitignore filen finns src/private, detta eftersom REST API har befunnit sig i samma projekt. REST API ska dock befinna sig i en annan repository. Filsystemet är uppbyggt genom src/private och src/public där public är klientsidan och private är backend.
