
function plusItem(userId,itemId,name,count,price,photo,uprice,stock){

    var arrObj=selectAll(userId);

    if(arrObj){
        var obj=selectOne(userId,itemId);
        if(obj){
            for(var i=0;i<arrObj.length;i++){
                if(arrObj[i].itemId==itemId){
                    if(arrObj[i].count>stock-1){
                        alert("Insufficient stock");
                    }else{
                        arrObj[i].count++;
                    }
                }
            }
            txt=JSON.stringify(arrObj); 
            $.cookie('cart'+userId,txt,{expires:1,path:'/'});
        }else{//
            obj={itemId:itemId,name:name,count:count,price:price,photo:photo,uprice:uprice,stock:stock};
            arrObj.push(obj);
            txt=JSON.stringify(arrObj);
            $.cookie('cart'+userId,txt,{expires:1,path:'/'});
        }
    } 
    else{
        arrObj=new Array();//
        obj={itemId:itemId,name:name,count:count,price:price,photo:photo,uprice:uprice,stock:stock};
        arrObj.push(obj);
        txt=JSON.stringify(arrObj);

        $.cookie('cart'+userId,txt,{expires:1,path:'/'});
    }  
};




function minusItem(userId,itemId){
    
    var arrObj=selectAll(userId);

    if(arrObj){
        var obj=selectOne(userId,itemId);
        if(obj){
            for(var i=0;i<arrObj.length;i++){
                if(arrObj[i].itemId==itemId){
                    arrObj[i].count--; 
                    if(arrObj[i].count==0){
                        removeItem(userId,itemId);
                    }else{
                        txt=JSON.stringify(arrObj); 
                        $.cookie('cart'+userId,txt,{expires:1,path:'/'});
                    }
                    break;
                }
            }
            
        }
    } 
};


function removeItem(userId,itemId){
    var arrObj=selectAll(userId);
    if(arrObj){
        var temp=-1;
        for(var i=0;i<arrObj.length;i++){
            if(arrObj[i].itemId==itemId){
                temp=i;
            }
        }
        if(temp>-1){ 
            arrObj.splice(temp,1);
            txt=JSON.stringify(arrObj); 
            $.cookie('cart'+userId,txt,{expires:1,path:'/'});
        }
    }
}


function removeAllItem(userId){
    var arrObj=selectAll(userId);
    if(arrObj){ 
        var length=arrObj.length; 
        if(length>0){
            arrObj.splice(0,length);
            txt=JSON.stringify(arrObj); 
            $.cookie('cart'+userId,txt,{expires:1,path:'/'});
        }
        
    }
}


function selectOne(userId,itemId){
   var arrObj= selectAll(userId);
   if(arrObj){
        for(var i=0;i<arrObj.length;i++){
            if(arrObj[i].itemId==itemId){
                return arrObj[i];
            }
       }
   } 
   return;
}


function selectAll(userId){
    var arrTxt=$.cookie('cart'+userId);
    if(arrTxt){ 
        return eval('('+arrTxt+')'); 
    }else{ 
        return;
    } 
}


