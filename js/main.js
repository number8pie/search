$(function() {
    // Range Slider Visual Value
    $('.range-slider').on('input', function(){
        var value = $(this).val();
        $(this).siblings('.search-form__label').find('.range-value').text(value);
    });

    // jQuery UI Datepicker
    $(".jqueryui-datepicker" ).datepicker({dateFormat: 'dd/mm/yy'}).on('change', function(){
        $(this).valid();
    });

    // Select 2 init
    $('.select2').select2().on('change', function(){
        $(this).valid();
    });

    // Search Form Validation
    $("#search_form").validate({
        errorElement: "span",
        rules: {
            search_location: "required",
            search_date: "required"
        },
        messages: {
            search_location: "Please enter a location",
            search_date: "Please select a date"
        },
        onfocusout: function(element) { this.element(element) },
        onkeyup: function(element) { this.element(element) }
    });
});