$(document).ready(function () {
  $("#progressbarwizard").bootstrapWizard({
    onTabShow: function (tab, navigation, index) {
      var $total = navigation.find("li").length;
      var $current = index + 1;
      var $percent = ($current / $total) * 100;
      $("#progressbarwizard")
        .find(".bar")
        .css({
          width: $percent + "%",
        });
    },
    tabClass: "nav nav-tabs navtab-wizard nav-justified bg-muted",
  });
});
