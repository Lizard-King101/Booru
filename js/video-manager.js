var playing = false;
var video = '';
var vol = '';
var clicks = 0;
var fullscreen = false;
var time = 3;
var hidetimer = setInterval(HideCountDown, 1000);
var settingOpen = false;

$(document).ready(function(){
    
    video = document.getElementById('video-player');
  
  if($('video')[0].hasAttribute('autoplay')){
    $('#play').removeClass();
    $('#play').addClass('fa fa-pause');
    playing = true;
  }
  
    $('#play-pause').click(function(){
        PlayPause();
    });
    
  $("#fullscreen").on('click', function() {
      if(IsFullScreenCurrently()){
        GoOutFullscreen();
        fullscreen = false;
      }
      else{
        GoInFullscreen($("#video-container").get(0));
        fullscreen = true;
      }
  });
  
  
  $('#volume-slider').on('input',function(){
    $('#video-player')[0].volume = this.value;
    vol = this.value;
    if(this.value > 0.6){
      $('#volume-icon').removeClass();
      $('#volume-icon').addClass('fa fa-volume-up');
    }else if(this.value > 0){
      $('#volume-icon').removeClass();
      $('#volume-icon').addClass('fa fa-volume-down');
    }else if(this.value == 0){
      $('#volume-icon').removeClass();
      $('#volume-icon').addClass('fa fa-volume-off');
    }
  });
  
  
  $('#video-container').on('mousemove', function(){
    time = 3;
    
  });
  
  
  $('#video-player').on('click', function(){
    clicks ++;
    if(clicks == 1){
      setTimeout(function(){
        if(clicks == 1){
          PlayPause();
          clicks = 0;
        }else{
          if(IsFullScreenCurrently()){
            GoOutFullscreen();
            fullscreen = false;
          }
          else{
            GoInFullscreen($("#video-container").get(0));
            fullscreen = true;
          }
          clicks = 0;
        }
      }, 300);
    }
  });
  
  
  $('#playback-bar').on('click', function(e){
    var offset = $(this).offset();
    var left = (e.pageX - offset.left);
    var totalWidth = $('#playback-bar').width();
    var percentage = (left / totalWidth);
    var vidTime = video.duration * percentage;
    video.currentTime = vidTime;
  });
  
  
  $('#playback-bar').on('mousemove',function(e){
    var offset = $(this).offset();
    var left = (e.pageX - offset.left);
    var totalWidth = $('#playback-bar').width();
    var percentage = (left / totalWidth);
    var vidTime = video.duration * percentage;
    $('#scrub-bar').css({'width': percentage*100 + '%'});
    $('#scrub-time').html(CalcTime(vidTime));
    
  });
  
  
  $('#video-player').on('timeupdate', function(){
    $('#prog-bar').css({'width': (this.currentTime/ this.duration)*100 + '%'});
    $('#current-time').html(CalcTime(this.currentTime));
  });
  $('#video-player').on('loadeddata', function(e){
    $('#current-time').html(CalcTime(this.currentTime));
    $('#vid-duration').html(CalcTime(video.duration));
  });

    $('#video-player').on('ended',function(){
        PlayPause();
    });
  
});
//end of document ready

function UpdateSettings(){
  var formdata = new FormData();
  $('input.setting').each(function(){
    if($(this).attr('type') == 'checkbox'){
      var setname = $(this).attr('id');
      var value = $(this)[0].checked;
      formdata.append(setname, value);
      if($(this)[0].hasAttribute('vid-var')){
        var varname = $(this).attr('id');
        
        
      }
    }
  });
  
  $.ajax({
    url: 'ajax/update_settings.php',
    type: 'POST',
    data: formdata,
    contentType: false,
    processData: false
  });
}

function SettingsClose(){
  $('#settings-box').fadeOut(200, function(){
    $('#settings-box').remove();
  });
}

function Count(i){
  if(i > 1000000000){
    return Math.round(i/1000000000 * 10)/10+'B';
  }else if(i > 1000000){
    return Math.round(i/1000000 *10)/10+'M';
  }else if(i > 1000){
    return Math.round(i/1000 * 10)/10+'k';
  }else{
    return i;
  }
}

function HideCountDown(){
  if(time > 0){
    time --;
    timeset = true;
    $('#video-controls').fadeIn(100);
    $('#video-info').fadeIn(100);
    $('#video-container').css({'cursor':'unset'});
  }else{
    SettingsClose();
    timeset = false;
    if(playing){
      $('#video-controls').fadeOut();
      $('#video-info').fadeOut();
      if(fullscreen){
        $('#video-container').css({'cursor':'none'});
      }else{
        $('#video-container').css({'cursor':'unset'});
      }
    }
  }
}

function MuteToggle(el){
  var vol = $()
}

function CalcTime(time){
  if(time < 0){
    return '00:00';
  }
  if(time < 3600){
    //calc min. and sec. only
    var minutes = Math.floor(time / 60);
    var seconds = Math.floor(time % 60);
    if(seconds < 10){
      seconds = '0'+seconds;
    }
    if(minutes < 10){
      minutes = '0'+minutes;
    }
    return minutes +':'+ seconds;
  }else{
    //calc hr., min. and sec.
    var minutes = Math.floor(time / 60);
    var seconds = Math.floor(time % 60);
    var hours = Math.floor(time / 3600);
    if(seconds < 10){
      seconds = '0'+seconds;
    }
    if(minutes < 10){
      minutes = '0'+minutes;
    }
    if(hours < 10){
      hours = '0'+hours;
    }
    return hours +':'+ minutes +':'+ seconds;
  }
}


function ShowSettings(){
  if($('#settings-box').length < 1){
    $('#video-container').append('<div id="settings-box" style="display: none;"></div>');
    $('#settings-box').load('../ajax/video_settings.php', function(){
      $('#settings-box').fadeIn(200);
    });
    settingOpen = true;
  }else{
    console.log('Settings open allready');
  }
}

function PlayPause(){
  if(!playing){
    if(settingOpen){
        SettingsClose();
    }
    video.play();
    playing = true;
    $('#play').removeClass();
    $('#play').addClass('fa fa-pause');
  }else if(playing){
    video.pause();
    playing = false;
    $('#play').removeClass();
    $('#play').addClass('fa fa-play');
  }
}
function Vote(v){
  $.ajax({
    url: 'ajax/vote.php',
    data: {id:$_GET['id'], vote:v},
    type: 'POST',
    success: function(data){
      if(v > 0){
        $('#t-up-count').html(Count(data));
      }else{
        $('#t-down-count').html(Count(data));
      }
    }
  });
}

function GetUploader(type, up){
  $.ajax({
    url: 'ajax/video_get_uploader.php',
    type: 'POST',
    data:{
      type: type,
      uploader: up
    },
    dataType: 'json',
    success: function(data){
      DisplayUploader(type ,data);
    }
  })
}

function DisplayUploader(type, data){
  console.log(data);
  if(type > 0){
    $('#upIcon').attr('style', 'background-image: url("img/chann-icon/'+data['icon']+'")');
    $('#upName').html(data['name']);
  }else{
    $('#upIcon').attr('style', 'background-image: url("img/profile/'+data['icon']+'")');
    $('#upName').html(data['name']);
  }
}


function GoInFullscreen(element) {
	if(element.requestFullscreen)
		element.requestFullscreen();
	else if(element.mozRequestFullScreen)
		element.mozRequestFullScreen();
	else if(element.webkitRequestFullscreen)
		element.webkitRequestFullscreen();
	else if(element.msRequestFullscreen)
		element.msRequestFullscreen();
}

/* Get out of full screen */
function GoOutFullscreen() {
	if(document.exitFullscreen)
		document.exitFullscreen();
	else if(document.mozCancelFullScreen)
		document.mozCancelFullScreen();
	else if(document.webkitExitFullscreen)
		document.webkitExitFullscreen();
	else if(document.msExitFullscreen)
		document.msExitFullscreen();
}

/* Is currently in full screen or not */
function IsFullScreenCurrently() {
	return (document.fullscreen || document.webkitIsFullScreen || document.mozFullScreen);
}

$(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange msfullscreenchange', function() {
	if(IsFullScreenCurrently()) {
		
	}
	else {
		
	}
});