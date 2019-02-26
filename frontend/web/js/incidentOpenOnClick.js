$(document).ready(function(){
    var DELAY = 200, clicks = 0, timer = null;
    $("#incident-table tbody").on('click', 'tr', function() {
        clicks++;
        if(clicks === 1) {
        timer = setTimeout(function() {
            clicks = 0;             
        }, DELAY);
        $("#incident-table tbody tr").removeClass('clickedRow');
        $(this).addClass('clickedRow');
        console.log('mouseenter_function'); 
        } 
        else {
            clearTimeout(timer);    //prevent single-click action
            var data = $(this).attr('data-key');
            window.open('view/'+data);
            clicks = 0;
        }
    });
    $("#incident-table thead").on('click', function() {
        $("#incident-table tbody tr").removeClass('clickedRow');
        console.log('click on thead');  
    });
    $(".management").on('click', function() {
        $("#incident-table tbody tr").removeClass('clickedRow');
        console.log('click on thead');  
    });
    $(".content-header").on('click', function() {
        $("#incident-table tbody tr").removeClass('clickedRow');
        console.log('click on thead');  
    });
});