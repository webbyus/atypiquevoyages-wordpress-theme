jQuery(function ($) {
  const today = new Date();
  const $start = $("#date-start").prop("readonly", true);
  const $end = $("#date-end").prop("readonly", true);

  // --- init #date-end (normal day picker) ---
  $end.datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
  });

  // --- init #date-start (month + year only) ---
  $.extend($.datepicker._defaults, { closeText: "Set Date", currentText: "" });

  function tidy(inst) {
    const $w = inst.dpDiv;
    $w.find(".ui-datepicker-calendar, .ui-datepicker-current").hide();
    $w.find(".ui-datepicker-close").val("Set Date");
  }

  $start.datepicker({
    dateFormat: "MM yy",
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    beforeShow: (input, inst) => setTimeout(() => tidy(inst), 0),
    onChangeMonthYear: (y, m, inst) => {
      setTimeout(() => tidy(inst), 0);
      $start.datepicker("setDate", new Date(y, m - 1, 1));
    },
    onClose: (txt, inst) =>
      $start.datepicker(
        "setDate",
        new Date(inst.selectedYear, inst.selectedMonth, 1)
      ),
  });

  // --- readonly inputs need this to open the picker ---
  $start.add($end).on("focus click", function () {
    $(this).datepicker("show");
  });
});
