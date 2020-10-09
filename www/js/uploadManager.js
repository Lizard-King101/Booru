var tags = [];
var thumb;
$(document).ready(function(){
    //Start Ready
    var fileTypes = ['image/jpeg','image/png','image/gif','video/mp4','video/webm','application/x-shockwave-flash'];
    
    $('input#file').change(function(e){
        $('#file-container').empty();
        $('#upload-box').empty();
        $('#upload-box').removeClass('add-pad');
        if($(this).val() == ''){
            $('#file-container').append('<h3 class="no-m">Please Select A File</h3>');
            $('#file-container').removeClass('min');
            $('#tag-container').slideUp(200, function(){
                ClearTags();
            });
            $('#upload-container').slideUp(200, function(){
                $('a#upload').remove(); 
            });
            
        }else{
            var file = this.files[0];
            if(fileTypes.indexOf(file.type) > -1){
                $('#file-container').append('<p class="no-m">'+file.name+'</p><h3 class="no-m">File Ready For Upload</h3>');
                $('#upload-box').addClass('add-pad');
                $('#file-container').addClass('min');
                $('#name-container').slideDown();
                $('#tag-container').slideDown();
                if(file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/gif'){
					ResizeImage();
                }
            }else{
                $('#file-container').append('<h3 class="no-m">File Not Suported</h3>');
                $('#file-container').removeClass('min');
            }
			console.log(file);
        }
        
    });
    
    $('#clear-tags').click(function (){
        ClearTags();
        CheckValid();
    });
    
    $('form#tags').submit(function(e){
        e.preventDefault();
        var tag = toTitleCase($('input#tag').val());
        var dashtag = tag.replace(/[^a-z0-9\s]/gi, '').replace(/[-\s]/g, '_');
        var index = tags.indexOf(tag);
        console.log(tags);
        $('input#tag').val('');
        if (index < 0){
            tags.push(dashtag);
            $('div.tags-box').append('<span class="tag" id="'+dashtag+'">'+tag+'&nbsp;<a class="button dark small" onClick="RemoveTag(this);"><i class="fa fa-times"></i></a></span>');
            CheckValid();
        }
    });
    
    
    //End Ready
});

function ResizeImage() {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var filesToUploads = document.getElementById('file').files;
        var file = filesToUploads[0];
        if (file) {

            var reader = new FileReader();
            // Set the image once loaded into file reader
            reader.onload = function(e) {
				
                var img = document.createElement("img");
                img.src = e.target.result;
				img.onload = function(){
					var canvas = document.createElement("canvas");
					var ctx = canvas.getContext("2d");
					ctx.drawImage(img, 0, 0);

					var MAX_WIDTH = 300;
					var MAX_HEIGHT = 300;
					var width = img.width;
					var height = img.height;
					console.log(width, height);
					if (width > height) {
						if (width > MAX_WIDTH) {
							height *= MAX_WIDTH / width;
							width = MAX_WIDTH;
						}
					} else {
						if (height > MAX_HEIGHT) {
							width *= MAX_HEIGHT / height;
							height = MAX_HEIGHT;
						}
					}
					canvas.width = width;
					canvas.height = height;
					var ctx = canvas.getContext("2d");
					ctx.drawImage(img, 0, 0, width, height);

					dataurl = canvas.toDataURL(file.type);
					thumb = dataurl;
				}
            }
            reader.readAsDataURL(file);

        }

    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
}

function ClearTags(){
    tags = [];
    $('span.tag').remove();
}

function RemoveTag(el){
    var tag = $(el).parent().attr('id');
    var index = tags.indexOf(tag);
    if(index > -1){
        tags.splice(index, 1);
        var select = '.tag#'+tag;
        console.log('Selecter: '+select);
        $(select).remove();
    }
    CheckValid();
}

function Upload(){
    var file = document.getElementById('file').files[0];
    var name = $('#post-name').val().replace(/[^a-z0-9\s]/gi, '');
    var formdata = new FormData();
    formdata.append('file', file);
    formdata.append('tags', tags);
    formdata.append('name', name);
	if(thumb){
		formdata.append('thumb', thumb);
	}
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "ajax/file_upload_parser");
    ajax.send(formdata);
}

function progressHandler(e){
    var percent = (e.loaded / e.total) * 100;
    if($('#prog').length < 1){
        $('#upload-box').empty();
        $('#upload-box').append('<span id="prog"><span id="prog-bar"></span></span>');
    }
    $('#prog-bar').css('width', percent+'%');
}
function completeHandler(e){
    try {
        var data = JSON.parse(e.target.responseText);
        if(data.error == 0){
            $('#upload-box').empty();
            $('#upload-box').append('<h3 style="margin: 0;">Upload Complete</h3>');
            $('#upload-box').append('<p>View your post at <a href="/view.php?id='+data.extra+'">/view.php?id='+data.extra+'</a> Or Upload Another post.</p>');
        }
        if(data.error == 1) {
            $('#upload-box').empty();
            $('#upload-box').append('<a id="upload" class="button hollow" onClick="Upload();">Upload</a>');
            $('#upload-box').append('<h3 style="margin: 0;">Error Uploading</h3>');
            $('#upload-box').append('<p>'+data.msg+'</p>');
        }
    } catch {
        console.error(e.target.responseText);
    }
}
function errorHandler(e){
    console.error(e);
}
function abortHandler(e){
    
}

function CheckValid(){
    if(tags.length > 0){
        if($('a#upload').length < 1){
            $('#upload-box').append('<a id="upload" class="button hollow" onClick="Upload();">Upload</a>');
            $('#upload-container').slideDown(200);
        }
    }else{
        $('#upload-container').slideUp(200, function(){
            $('a#upload').remove(); 
        });
    }
}

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
