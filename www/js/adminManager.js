var markupStr;

$(document).ready(function(){
	adminLoad('users');
	
	$('textarea.editor').summernote({
		height: 300,
		focus: true,
		maxHeight: 400
	});
	
	$('body').on('click', 'a.button.head.edit', function (){
		var id = $(this).attr('data-id');
		$('#head_'+id+' .button-box').html('<a data-id="'+id+'" class="button head save">Save</a>');
		createEditor('#editor_'+id);
		console.log('edit: '+id);
	});
	$('body').on('click', 'a.button.head.save', function (){
		var id = $(this).attr('data-id');
		var data = {
			html: '',
			head: '',
			page: '',
			dowhat: '',
			id: ''
		}
		if(id === "main"){
			data.head = $('#new_head').val();
			data.page = $('#new_page').val();
			data.html = getHtml('textarea.editor');
			data.dowhat = 'new';
		}else{
			data.head = $('#head_'+id+' input[type="text"]').val();
			data.page = $('#head_'+id+' select').val();
			data.html = getHtml('#editor_'+id);
			data.dowhat = 'update_not';
			data.id = id;
			$('#head_'+id+' .button-box').html('<a data-id="'+id+'" class="button head edit">Edit</a>');
			$('#editor_'+id).summernote('destroy');
		}
		$.ajax({
			url: 'ajax/admin/ajax/notification_handler',
			data: data,
			type: 'POST',
			dataType: 'json',
			success: function(data){
				console.log(data);
			}
		});
		console.log(data);
	});
	$('body').on('click', 'a.button.head.delete', function (){
		var id = $(this).attr('data-id');
		$.ajax({
			url: 'ajax/admin/ajax/notification_handler',
			data: {
				dowhat: 'delete',
				id: id
			},
			type: 'POST',
			dataType: 'JSON',
			success: function(data){
				console.log(data);
			}
		});
		console.log('delete: '+id);
	});
	
});

function updateOption(el){
	var id = $(el).attr('data-id');
	var opt = $(el).attr('data-option');
	var data = $(el).val();
	if(data === "on"){
		data = el.checked;
	}
	$.ajax({
		url: 'ajax/admin/ajax/notification_handler',
		data: {
			dowhat: 'update_opt',
			id: id,
			option: opt,
			data: data
		},
		type: 'POST',
		dataType: 'json',
		success: function (data) {
			console.log(data);
		}
	});
	console.log(id, opt, data);
}

function adminLoad(tab){
    $.ajax({
        url: 'ajax/admin/'+tab+'.php',
        type: 'GET',
        success: function(data){
            $('#admin-container').html(data);
			createEditor('textarea.editor');
        }
    });
}

function createEditor(selector){
	$(selector).summernote({
		height: 400,
		focus: true,
		maxHeight: 400,
		minHeight: 400
	});
}

function getHtml(selector){
	return $(selector).summernote('code');
}
function loadHtml(selector, html){
	$(selector).summernote('code', html);
}