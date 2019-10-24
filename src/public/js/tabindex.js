$(".fl").featherlight({
  afterOpen: function(event) {
    $(".normal_input").attr("tabindex", 1);
    $(".normal_submit").attr("tabindex", 1);
  }
});
