(function ($) {
    $(function () {

        $(document).foundationAlerts();
        $(document).foundationAccordion();
        $(document).tooltips();
        $('input, textarea').placeholder();



        $(document).foundationButtons();



        $(document).foundationNavigation();



        $(document).foundationCustomForms();




        $(document).foundationTabs({callback: $.foundation.customForms.appendCustomMarkup});



        // UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE8 SUPPORT AND ARE USING .block-grids
        // $('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'left'});
        // $('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'left'});
        // $('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'left'});
        // $('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'left'});
    });

    $('.myModal').reveal({
        animation: 'none', //fade, fadeAndPop, none
        animationspeed: 300, //how fast animations are
        closeOnBackgroundClick: true, //if you click background will modal close?
        dismissModalClass: 'close-reveal-modal' //the class of a button or element that will close an open modal
    });

})(jQuery);



$(document).ready(function () {

    < !-- data table -- >
            $('.dataTable').dataTable(
            {
                "oLanguage": {
                    "sLengthMenu": '<select >' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="100">100</option>' +
                            '<option value="-1">All</option>' +
                            '</select>'
                }
            });


    < !-- number and money format -- >
            $(".just_number").keypress(function (e)
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $(".just_money").keypress(function (e)
    {
        if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
            < !-- /number and money format -->


            < !-- validate -- >
            $("form").validate();
});
  