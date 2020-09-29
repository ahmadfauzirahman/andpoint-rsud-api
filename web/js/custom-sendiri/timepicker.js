$(document).ready(function () {
  // time picker
  $("#masterabsensi-jam_masuk").timepicker({
    showMeridian: false,
    icons: {
      up: "mdi mdi-chevron-up",
      down: "mdi mdi-chevron-down",
    },
  });
  $("#masterabsensi-jam_keluar").timepicker({
    showMeridian: false,
    icons: {
      up: "mdi mdi-chevron-up",
      down: "mdi mdi-chevron-down",
    },
  });

  // datepicker
  jQuery("#datepicker-autoclose").datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd'
  });
});
