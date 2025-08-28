jQuery(function ($) {
  const today = new Date();
  const $start = $("#date-start").prop("readonly", true);
  const $end = $("#date-end").prop("readonly", true);

  // --- init #date-end (normal day picker) ---
  $end.datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
  });

  if ($start.length && $.fn.MonthPicker) {
    $start.MonthPicker({
      MonthFormat: "yy MM",
      MinMonth: 0, // optional: block past months/years
      MaxMonth: "+5y",
      Button: false, // 👈 hide icon; picker shows on input focus
      // prevent auto-close when we trigger Open() from a focus/click
      OnBeforeMenuClose: function (e) {
        if ($(e.target).is("#date-start")) e.preventDefault();
      },
    });

    // make absolutely sure it opens on both focus and click
    $start.on("focus click", function () {
      $(this).MonthPicker("Open"); // API method to open menu
    });
  }
});
