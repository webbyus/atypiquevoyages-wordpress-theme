jQuery(function ($) {
  let dateToday = new Date();

  // apply day picker only to other fields (not #date-start)
  $(".past-days-disabled-date-field").not("#date-start").datepicker({
    dateFormat: "dd-mm-yy",
    minDate: dateToday,
  });

  // month–year only for #date-start
  $("#date-start").datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: "MM yy",
    onClose: function (dateText, inst) {
      $(this).datepicker(
        "setDate",
        new Date(inst.selectedYear, inst.selectedMonth, 1)
      );
    },
    beforeShow: function () {
      setTimeout(function () {
        $(".ui-datepicker-calendar").hide();
      }, 0);
    },
  });

  // keep calendar hidden when focusing
  $("#date-start").focus(function () {
    $(".ui-datepicker-calendar").hide();
  });
});
