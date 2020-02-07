var expanded = 0;

$(document).ready(function(){
    $('img').click(function(){
        if(expanded == 0){
            $('.expandable').addClass('expanded');
            expanded = 1;
        }else if(expanded == 1 && canMax){
            $('img').addClass('full');
            $('.expandable').addClass('full');
            expanded = 2;
        }else{
            expanded = 0;
            $('.expandable').removeClass('expanded');
            $('.expandable').removeClass('full');
            $('img').removeClass('full');
        }
        
    });
});