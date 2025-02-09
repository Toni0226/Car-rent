(function($){


    function getDaysBetweenDates(date1, date2) {

        var d1 = new Date(date1);
        var d2 = new Date(date2);


        var timeDiff = Math.abs(d2.getTime() - d1.getTime());


        var days = Math.ceil(timeDiff / (1000 * 3600 * 24));

        return days;
    }

    $(document).on('change', '.settotal', function () {

        var startdate=$("#startdate").val();
        var enddate=$("#enddate").val();
        var days =0;
        if(startdate && enddate){
            days=getDaysBetweenDates(startdate, enddate);
        }

        var total=parseFloat($("#subtotal").val());

        if(!isNaN(total) && days>0){
            $("#total").val(total*days);
            $(".checkout-bottom-price").text(total*days);
            $("#days").val(days);
        }

    });
    //plus
    $(document).on('click', '.plus', function () {
        var itemId = $(this).parent().parent('.shop-item').attr('item-id');


        var stock=$(this).data("stock");
        var userId = $.cookie('PHPSESSID');

        plusItem(userId,itemId,'',1,'','','',stock);

        window.location.reload();
    });
    //minus
    $(document).on('click', '.minus', function () {
        var itemId = $(this).parent().parent('.shop-item').attr('item-id');

        deleteCart(itemId);
    });


    //
    initOrder();


    $(".removeAllItem").click(function() {
        var userId = $.cookie('PHPSESSID');
        removeAllItem(userId);
        window.location="index.php";
    });

    //
    function validateEmail(email) {
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailRegex.test(email);
    }


    $('.commit-btn').click(function() {


        var email=$('#email').val();
        var phone=$('#phone').val();
        var license=$('#license').val();
        var startdate=$('#startdate').val();
        var enddate=$('#enddate').val();
        var name=$('#name').val();
        var days=$('#days').val();
        var totalqty=$('#totalqty').val();
        var total=$('#total').val();



        if(!name){
            alert("Name is required");
            return false;
        }else if(!phone){
            alert("Phone is required");
            return false;
        }else if(!email){
            alert("Email is required");
            return false;
        }else if(!validateEmail(email)){
            alert("Email is error");
            return false;
        }else if(!startdate){
            alert("Startdate is required");
            return false;
        }else if(!enddate){
            alert("Enddate is required");
            return false;
        }else if(!license){
            alert("Driver's license is required");
            return false;
        }else{


        var postUrl="commitOrder.php";

        var userId=$.cookie('PHPSESSID');

        if(userId){
            var arrObj=selectAll(userId);
            if(arrObj&&arrObj.length>0){
                var itemsTxt=JSON.stringify(arrObj);
                $.post(postUrl,
                    {
                        items:itemsTxt,
                        days:days,
                        amount:total,
                        phone:phone,
                        email:email,
                        startdate:startdate,
                        enddate:enddate,
                        name:name,
                        license:license,
                        totalqty:totalqty
                    },
                    function(data,status,xhr) {

                        if(status=="success"){
                            $res= $.parseJSON(data);
                            if($res.code=="1"){

                                //
                                removeAllItem(userId);
                                alert($res.msg);
                                window.location.href="order_detail.php?id="+$res.order_id;

                            }else if($res.code=="0"){
                                alert($res.msg);
                            }
                        }else{
                            alert("Server exception");
                        }
                    });
            }else{
                alert("The order has already been submitted");
            }
        }


        }
    });


    $('.confirm').click(function() {


            var id=$(this).data("id");


            var postUrl="confirmOrder.php";

            $.post(postUrl,
            {
                id:id
            },
            function(data,status,xhr) {

                if(status=="success"){
                    $res= $.parseJSON(data);
                    if($res.code=="1"){

                        alert($res.msg);
                        window.location.href="index.php";

                    }else if($res.code=="0"){
                        alert($res.msg);
                    }
                }else{
                    alert("Server exception");
                }
            });

    });



})(jQuery);





function initOrder(){
    var userId=$.cookie('PHPSESSID');

    if(userId){
        var arrObj=selectAll(userId);

        if(arrObj&&arrObj.length>0){
            var price3=0;
            var count2=0;
            var htmlTxt="<li class='checkout-tablerow shop-item' item-id='$id'>"

                +"<div class='cell itemname'><div class='fl'>$photo</div><div class='fl'>$name <br>$ $uprice / Day </div></div>"
                +"<div class='cell itemquantity item-count'>"
                + "<button class='minus'>-</button>"
                + "<input type='text' value='$count' "
                + "readonly='readonly' maxlength='3'>"
                + "<button class='plus' data-stock='$stock'>+</button>"
                + "</div>"
                +"<div class='cell itemtotal'>$ $price <br><a href='javascript://' onclick='deleteCart($delid)' >Delete</a></div>" +
                "</li>";
            for(var i=0;i<arrObj.length;i++){
                var itemId=arrObj[i].itemId;
                var name=arrObj[i].name;
                var count=arrObj[i].count;
                var price=arrObj[i].price;
                var uprice = arrObj[i].uprice;
                var stock = arrObj[i].stock;
                var photo = "<img src='"+arrObj[i].photo+"' width='80' style='margin-right: 10px' />";
                var price2=price*count;
                price3+=price2;
                count2+=count;

                var newTxt=htmlTxt.replace("$stock",stock).replace("$delid",itemId).replace("$id",itemId).replace("$name",name).replace("$count",count).replace("$price",price2).replace("$uprice",uprice).replace("$photo",photo);

                $('.checkout-body').append(newTxt);
            }

            $("#subtotal").val(price3);
            $("#totalqty").val(count2);

           var newTxt='<li class="checkout-tablerow shop-item" ><div class="cell itemname"><div class="fl"></div><div class="fl">Total</div></div><div class="cell itemquantity ">'+count2+'</div><div class="cell itemtotal">$ '+price3+'</div></li>';
               $('.checkout-body').append(newTxt);

                $("#totalqty").val(count2);
                $(".checkout-bottom-price").text(price3);

        }


    }
}

