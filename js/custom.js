! function($) {
    $(document).on("click", "ul.nav li.parent > a ", function() {
        $(this).find('em').toggleClass("fa-minus");
    });
    $(".sidebar span.icon").find('em:first').addClass("fa-plus");
}

(window.jQuery);
$(window).on('resize', function() {
    if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function() {
    if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})


$(document).ready(function() {
    $('#rooms').DataTable();
});


//Campos del Form
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
var checkin = $('#check_in_date').fdatepicker({
    format: 'dd-mm-yyyy',
    onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkout.update(newDate);
    }
    checkin.hide();
    $('#check_out_date')[0].focus();


}).on('changeDate', function(ev) {
    var checkin = $('#check_in_date').datepicker('getDate');
    var checkout = $('#check_out_date').datepicker('getDate');

    if (checkin && checkout) {
        var totalDays = Math.floor((checkout - checkin) / (1000 * 60 * 60 * 24)); // Calculate total days

        // Get the room price as a float
        var roomPrice = parseFloat($('#price').text());

        // Calculate the total price (room price * total days)
        var totalPrice = roomPrice * (totalDays + 1); // Adding 1 for inclusive days

        // IVA tax rate (13%)
        var ivaTaxRate = 0.13;

        // Tourism tax rate (5%)
        var tourismTaxRate = 0.05;

        // Calculate the tax based on the total price
        var ivaTax = totalPrice * ivaTaxRate;
        var tourismTax = totalPrice * tourismTaxRate;

        // Calculate the total price including taxes
        var totalPriceWithTaxes = totalPrice + ivaTax + tourismTax;

        // Update the displayed values
        $('#staying_day').html(totalDays + 1); // Adding 1 for inclusive days
        $('#iva_tax').html('$' + ivaTax.toFixed(2)); // Format IVA tax to 2 decimal places
        $('#tourism_tax').html('$' + tourismTax.toFixed(2)); // Format tourism tax to 2 decimal places
        $('#total_price').html('$' + totalPriceWithTaxes.toFixed(2)); // Format total price to 2 decimal places
    }
}).data('datepicker');



var joining_date = $('.joining_date').fdatepicker({
    format: 'dd-mm-yyyy',
    onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
}).data('datepicker');