var isOpen = false;
var canClose = false;
var shadowOpen = false;


$(document).ready(function(){
    
    $(window).resize(function(){
        if(isOpen && canClose){
            canClose = false;
            isOpen = false;
            $('#nav-box').animate({left: '-200px'}, 400);
            $('#body-box').animate({left: '0px'}, 400);
        }
    });
    
    $('body').click(function(){
        if(isOpen && canClose){
            canClose = false;
            isOpen = false;
            $('#nav-box').animate({left: '-200px'}, 400);
            $('#body-box').animate({left: '0px'}, 400);
        }
    });
    
    $('#nav-box').click(function(e){
        e.stopPropagation();
    });
    
    $('#nav-toggle').click(function(e){
        e.stopPropagation();
        if(isOpen){
            isOpen = false;
            $('#nav-box').animate({left: '-200px'}, 400);
            $('#body-box').animate({left: '0px'}, 400);
        }else{
            isOpen = true;
            $('#nav-box').animate({left: '0px'}, 400);
            $('#body-box').animate({left: '200px'}, 400, function(){
                canClose = true;
            });
        }
    });
    
    
    $('body').on('click', 'div#shadow', function(){
        CloseShadow(200);
    });
    
    $('body').on('click', 'div.shadow-container', function(e){
        e.stopPropagation();
    });
});

function SignIn(){
    if(!shadowOpen){
        CreateShadow();
        $('#shadow').load('../ajax/account/signin_form.php', function(){
            OpenShadow(200);
        });
    }
}

function CreateShadow(){
    $('body').append('<div id="shadow" style="display: none;"></div>');
}

function OpenShadow(fade){
    $('#shadow').fadeIn(fade);
    shadowOpen = true;
}

function CloseShadow(fade){
    $('#shadow').fadeOut(fade, function(){
        $('#shadow').remove();
        shadowOpen = false;
    });
}

function LoadCreate(){
    if(shadowOpen){
        $('#shadow').fadeOut(200, function(){
            $('#shadow').empty();
            $('#shadow').load('../ajax/account/signup_form.php', function(){
                OpenShadow(200);
            });
            shadowOpen = false;
        });
    }
}