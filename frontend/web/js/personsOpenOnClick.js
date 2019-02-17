$(document).ready(function(){
    var DELAY = 200, clicks = 0, timer = null;
    $("#persons-table tbody").on('click', 'tr', function() {
        clicks++;
        if(clicks === 1) {
            timer = setTimeout(function() {
                clicks = 0;             //after action performed, reset counter
            }, DELAY);
            $("#persons-table tbody tr").removeClass('clickedRow');
            $(this).addClass('clickedRow');

        } else {
            clearTimeout(timer);    //prevent single-click action
            var data = $(this).attr('data-key');
            window.open('/naci-test/persons/view/'+data);
            clicks = 0;             //after action performed, reset counter
        }
    });
    $("#persons-table thead").on('click', function() {
        $("#persons-table tbody tr").removeClass('clickedRow');
        console.log('click on thead');  
    });
    $(".management").on('click', function() {
        $("#persons-table tbody tr").removeClass('clickedRow');
        console.log('click on thead');  
    });
    $(".content-header").on('click', function() {
        $("#persons-table tbody tr").removeClass('clickedRow');
        console.log('click on thead');  
    });
});