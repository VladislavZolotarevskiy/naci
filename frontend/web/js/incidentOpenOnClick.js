$(document).ready(function(){
    var DELAY = 700, clicks = 0, timer = null;
    $("div.grid-view > table > tbody > tr").click(function(){
        clicks++;
        if(clicks === 1) {
            timer = setTimeout(function() {
                $(this).find('tr').removeClass();
                $(this).find('tr').addClass('clickedRow');
                console.log("Single Click");  //perform single-click action    
                clicks = 0;             //after action performed, reset counter
            }, DELAY);

        } else {
            clearTimeout(timer);    //prevent single-click action
            console.log("Double Click");  //perform double-click action
            clicks = 0;             //after action performed, reset counter
        }
    });   
});