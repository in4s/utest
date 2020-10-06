<script>
    $(function () {
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('hidepassed')) {
            $(".utest__result_true, .utest__section h6").hide();
            $(".utest__section h5").css("background", "rgba(71, 176, 108, 0.75)");
        }
    });
    /*BGN j4Commentary v80317*/
    $(function () {
        $('body').prepend('<div id="data-j4c" class="j4c"></div>');
        $(document).on('mousemove', "[data-j4c]", function (eventObject) {
            $dj = $(this).attr("data-j4c");
            $("#data-j4c").html($dj).css({"top": eventObject.pageY + 5, "left": eventObject.pageX + 5}).show();
        }).mouseout(function () {
            $("#data-j4c").hide().text("").css({"top": 0, "left": 0});
        });
    });
    /*END j4Commentary*/
</script>
