console.log('postManager');

$(document).ready(function(){
	
	$('#vote-down').click(function(){

	});
	$('#vote-up').click(function(){

	});
    
	$('#feature').click(function(){
		$.post('ajax/post_mod', {dowhat: 'featured', set: '1', id: $(this).attr('data-id')});
	});
	
	$('form#search-form').submit(function(e){
		e.preventDefault();
		var sPath = window.location.pathname;
		var sPage = sPath.substr(sPath.lastIndexOf('/') + 1);
		if(sPage !== 'search'){
			var temp = toTagSafe(toTitleCase($('form#search-form input[type="text"]').val()));
			$.ajax({
				url:'ajax/update_settings',
				type: 'POST', 
				data: {
					back_tags: temp, 
					back_page: 0
				}, 
				success: () => { 
					console.log('Redirect to search')
					location = "/search";
				}
			});
		}else{
			Search();
		}
	});
	
	$('form#mobile-search-form').submit(function(e){
		var temp = toTagSafe(toTitleCase($('form#mobile-search-form input[type="text"]').val()));
		e.preventDefault();
		Search(temp);
	});
    
	$('body').on('click', '.page-item', function(e){
		var el = e.currentTarget;
		if(!el.classList.contains('disabled')){
			var page = el.children[0].getAttribute('data-page');
			Search('', page);
		}
	});
	
  $('form#comment').submit(function(e){
      e.preventDefault();
      var post = $(this).attr('data-post');
      var comment = $(this).children('input[type="text"]').val();
      $(this).children('input[type="text"]').val('');
      if(comment !== ''){
          $.ajax({
              url: 'ajax/comment',
              type: 'POST',
              data: {
                  post: post,
                  message: comment
              },
              success: function(data){
                  $('#comment-list').html(data);
              }
          });
      }else{
          $('#comment-list').prepend('<li class="list-item comment-error">Please enter a message to send!</li>');
      }
  })
    
});

function tagSearch(tag){
    $.ajax({url:'ajax/update_settings',type: 'POST', data: {back_tags: tag, back_page: 0}, success: () => { location = "/search";}});
}

function insertPosts(container, posts){
	$(container).empty();
	for(var i = 0; i < posts.length; i++){
		var url = '';
    var size = '';
		if(posts[i].type === 'image'){
			if(posts[i].thumb !== 'default_thumb.png'){
				url = 'uploads/thumbs/'+posts[i].thumb;
			}else{
				url = 'uploads/photo/'+posts[i].loc;
			}
		}
    if(container === '.featured-box'){
        size = 'col-md-12 col-xs-6';
    }else if(container === '.latest-box'){
        size = 'col-md-3 col-sm-4 col-xs-6';
    }else{
        size = 'col-md-2 col-sm-4 col-xs-6';
    }
		$(container).append('<a href="/view?id='+posts[i].id+'" class="post-box '+size+'"><span class="preview" data-src="'+url+'"></span><span class="post-name">'+posts[i].name+'</span><span class="post-type '+posts[i].type+'">'+posts[i].type+'</span></a>');
	}
    $('span.preview').unveil(100, function(){
		console.log('Load', $(this).attr('data-src'));
		$(this).css({'background-image': 'url('+$(this).attr('data-src')+')'});
	});
}

var tags = [];
    
function Search(tags = false, page = 0, per = 24){
	showLoad('.search-box');
	var temp;
	if(tags){
		temp = tags;
	}else{
		temp = toTagSafe(toTitleCase($('form#search-form input[type="text"]').val()));
	}
	$.ajax({
		url: 'ajax/get_posts',
		type: 'POST',
		data: {
			tags: temp,
			page: page,
			per_page: per
		},
		dataType: 'JSON',
		success: function(data){
			console.log(data);
			pageUpdate(data.page_info);
			insertPosts('.search-box', data.posts);
		}
	});
	
}

function pageUpdate(page){
	$('.search-info').html('Found '+page.total+' results');
	$('#page-tabs').empty();
	console.log(page);
	var pages = Math.ceil(page.total/page.perpage);
	if(pages > 0){
		$('#page-tabs').append('<li class="page-item '+checkDisable(page.page, 0)+'"><a class="page-link" data-page="'+(parseInt(page.page) - 1)+'">Previous</a></li>');
		for(var i = 0; i < pages; i++){
			$('#page-tabs').append('<li class="page-item  '+checkDisable(page.page, i)+'"><a class="page-link" data-page="'+i+'">'+(i+1)+'</a></li>');
		}
		$('#page-tabs').append('<li class="page-item '+checkDisable(page.page, pages - 1)+'"><a class="page-link" data-page="'+(parseInt(page.page) + 1)+'">Next</a></li>');
	}
}

function showLoad(container){
	$(container).empty();
	$(container).html("<p class='text-center post-loader'><img class='loading' src='login/images/ajax-loading.gif'></p>");
}

function checkDisable(page, check){
	if(page == check){
		return 'disabled';
	}else{
		return '';
	}
}

function getIndex(text){
	for(var i = 0; i < tags.length; i++){
		if(tags[i] == text){
			return i;
		}
	}
}

function getId() {
	return '_' + Math.random().toString(36).substr(2, 9);
};

function toTagSafe(tags){
	let tmp = tags.split(',');
	var ret = '';
	for(var i = 0; i < tmp.length; i++){
		if(tmp[i].charAt(0) === ' '){
			tmp[i] = tmp[i].replace(' ','');
		}
		if(i == 0){
			ret += tmp[i].replace(/ /g, '_');
		}else{
			ret += ','+tmp[i].replace(/ /g, '_');
		}
	}
	return ret;
}

function toTitleCase(str){
	return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}