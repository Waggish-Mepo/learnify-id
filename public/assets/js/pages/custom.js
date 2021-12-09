$(window).resize(function() {
    var newWidth = window.innerWidth;
    if(newWidth <= 1200){
        $("#img-bg-bottom").css("width", newWidth);
    }else {
        $("#img-bg-bottom").css("width", newWidth-270);
    }
});
$(window).resize(function() {
    var newWidth = window.innerWidth;
    if(newWidth >= 1200){
        $("#img-bg-bottom-activity").css("width", newWidth-30);
    }else{
        $("#img-bg-bottom-activity").css("width", newWidth);
    }
});