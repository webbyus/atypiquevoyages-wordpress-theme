jQuery(function ($) {
  const today = new Date();
  const $start = $("#date-start");
  const $end = $("#date-end");

  // no typing in either field
  $start.add($end).prop("readonly", true);

  // regular day pickers for others (exclude #date-start)
  $(".past-days-disabled-date-field").not($start).datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
  });

  // set global labels once
  $.extend($.datepicker._defaults, { closeText: "Set Date", currentText: "" });

  const tidyPanel = () => {
    $(".ui-datepicker-calendar").hide();
    $(".ui-datepicker-close").val("Set Date");
  };

  // month+year picker for #date-start
  $start.datepicker({
    dateFormat: "MM yy",
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    beforeShow: () => setTimeout(tidyPanel, 0),
    onChangeMonthYear: (y, m) =>
      $start.datepicker("setDate", new Date(y, m - 1, 1)),
    onClose: () => {
      const $w = $("#ui-datepicker-div");
      const m = $w.find(".ui-datepicker-month :selected").val();
      const y = $w.find(".ui-datepicker-year :selected").val();
      if (y && m !== null) $start.datepicker("setDate", new Date(y, m, 1));
    },
  });

  // always reopen nicely
  $start.on("focus click", () => {
    $start.datepicker("show");
    tidyPanel();
  });
});
