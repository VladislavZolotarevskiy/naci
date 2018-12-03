//$("document").ready(function(){
//    $(".add-ticket").click(function(){
//        $(".modal-body").html('<i class="fa fa-refresh fa-spin"></i>');
//        $("#add-ticket").modal().find(".modal-body").load($(this).attr('href-data'));
//    });
//    var href = $(".add-ticket").attr('href-data');
//    var data = $(".modal-body#tticket-form").serialize();
//    
//    $(".modal-body").on(("#tticket-form").submit, function(){
//        $.ajax({
//            url:href,
//            data:$('#tticket-form').serialize()
//            dataType:"json"
//            type:'POST'
//            
//        });
//        console.log('data');
//    });
//    $("#add-item").on("pjax:complete", function() {
//            $.pjax.reload({container:"#tickets"});  //Reload GridView
//        });
//});