$(document).ready(function(){

    $(".contacts").click(function(){

        $(".modal-body").html('<i class="fa fa-refresh fa-spin"></i>');

        $("#contacts").modal().find(".modal-body").load($(this).attr('href-data'));

        });
});
