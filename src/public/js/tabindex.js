// Märkte ett problem med featherlight och det är att tabindex inte är optimalt, detta behöver läggas på i efterhand.
// Något som verkar vara känt inom featherlight's community, diverse lösningar fanns och detta funkade för detta projekt

$(".fl").featherlight({
  afterOpen: function(event) {
    $(".normal_input").attr("tabindex", 1);
    $(".normal_submit").attr("tabindex", 1);
  }
});
