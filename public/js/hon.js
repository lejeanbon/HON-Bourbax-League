$(document).ready(function() {
    $('#accountSelect').change(function() {
      $.ajax({
            type:"POST",
            url:"/ajax/account/a/"+$('#accountSelect').val(),
            success: function(returnData){
            }
        })
    });
});

function getItems(aid, gim) {
    $.ajax({
        type:"POST",
        url:"/ajax/items/aid/"+aid+"/gim/"+gim,
        success: function(returnData){
            //alert("j "+returnData+" j");
            $('#item_'+aid).html(returnData);
        }
    });
}