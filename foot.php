
<div id="footer">
    <div class="foot-box">24906253 Chunyan Wang</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui-1.13.3.custom/jquery-ui.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/cart.lib.js"></script>
<script src="js/cart.js"></script>
<script src="js/order.js"></script>

<script type="text/javascript">
    $(function() {

        var availableTags = [<?=implode(",",$hotList)?>];
        $( "#keywords" ).autocomplete({
            source: availableTags
        });

        $( "#keywords" ).focus(function(){
            $(".hots").show();
        });
        $(".hots a").click(function(){
            $( "#keywords" ).val($(this).html());
            $("#searchForm").submit();
        });

        $(".datepicker").datepicker();
    });

</script>
