$(document).ready(function(){
    var DELAY = 200, clicks = 0, timer = null;
    //var table = $('#incident-table').DataTable();
    //$("div.grid-view > table > tbody > tr").click(function(){
    $("#incident-table tbody").on('click', 'tr', function() {
        clicks++;
        if(clicks === 1) {
            timer = setTimeout(function() {
                clicks = 0;             //after action performed, reset counter
            }, DELAY);
            $("#incident-table tbody tr").removeClass('clickedRow');
            $(this).addClass('clickedRow');

        } else {
            clearTimeout(timer);    //prevent single-click action
            var data = $(this).attr('data-key');
            window.open('view?id='+data);
            //$.get('view', 'id=5');
            //console.log(data);  //perform double-click action
            clicks = 0;             //after action performed, reset counter
        }
    });   
});