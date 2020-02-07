$(document).ready(function(){
	
	
	$.ajax({
		url: 'ajax/get_posts.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			page: 0,
			type: 'latest',
			search: ''
		},
		success: function(data){
			insertPosts('.latest-box', data.posts);
		}
	});
	
	$.ajax({
		url: 'ajax/get_posts.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			page: 0,
			type: 'featured',
			search: ''
		},
		success: function(data){
			insertPosts('.featured-box', data.posts);
		}
	});
});