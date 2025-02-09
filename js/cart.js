(function ($) {


    //Order
    $('.buy').click(function (e) {

        var itemId = $(this).parents(".menu-item").attr("item-id");

        addCart(itemId);

        location.href = "order.php";

    });

})(jQuery);


//add
function addCart(itemId) {

    var obj1 = $(".menu-item[item-id='" + itemId + "']");
    var price = obj1.find('.price').attr("item-price");
    var uprice = obj1.find('.price').attr("item-price");
    var photo = obj1.find('.photo').attr("src");
    var name = obj1.find('.name').text();
    var stock = obj1.find('.stock').attr("item-stock");



    if(typeof photo=="undefined"){
        photo=$(".buybtn").data("photo");

    }
    var userId = $.cookie('PHPSESSID');
    if (userId) {
        plusItem(userId, itemId, name, 1, price, photo, uprice,stock);
    }
}
function deleteCart(itemId) {
    var userId = $.cookie('PHPSESSID');
    if (userId) {
        minusItem(userId, itemId);
    }

    window.location.reload();
}

