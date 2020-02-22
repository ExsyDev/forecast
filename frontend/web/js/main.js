$(function () {
    var dateStart = $('#date_start').val(),
        dateEnd = $('#date_end').val();

    $('#date_start').datetimepicker({
        pickTime: false,
        format: 'DD.MM.YYYY',
        maxDate: moment(dateEnd, ["DD.MM.YYYY"])// set simple `dateStart` don't work
    });

    $('#date_end').datetimepicker({
        pickTime: false,
        format: 'DD.MM.YYYY',
        minDate: moment(dateStart, ["DD.MM.YYYY"]),//.subtract(1, 'days'),
        useCurrent: false //Important! See issue #1075
    });

    $("#date_start").on("dp.change", function (e) {
        $('#date_end').data("DateTimePicker").setMinDate(e.date);
    });
    $("#date_end").on("dp.change", function (e) {
        $('#date_start').data("DateTimePicker").setMaxDate(e.date);
    });

    $('.filter-statistic').on('click', function (e) {
        e.preventDefault();
        $('.statistic-forecast').dataTable().api().draw()
    })
});