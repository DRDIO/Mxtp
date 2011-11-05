	$(function() {
		$("#yourList ul").sortable({opacity: 0.6, 
									cursor: 'move',
									handle: 'div.handle'
									});
		//$("#yourList ul").disableSelection();
	});

	function save_list(){

		if($('.playlist li').size() > 0){

	 		if($('#playListTitle').val() == 'Untitled' || $('#playListTitle').val() == 'untitled')
	 		{
	 			alert('Please pick an original playlist title.');
	 		}else{

		 		$('.playlist li').each(function(){
		 			var li = $(this);
		 			var songtitle = li.find('.title').text();
		 			var youtubeid = li.find('.youtubeid').text();
		 			//var duration = li.find('.duration').text();

		 			var inputs  = '<input class="gen" type="hidden" name="songtitle[]" value="'+songtitle+'"/>';
		 			    inputs += '<input class="gen" type="hidden" name="youtubeid[]" value="'+youtubeid+'"/>';
		 				//inputs += '<input class="gen" type="hidden" name="duration[]" value="'+duration+'"/>';

		 				$('#playlist_form').append(inputs);
		 		});

	 				$('#playlist_form').submit();
	 		}
	 		
		}else{
			alert('Please add songs to your playlist.');
		}

	}

	function playlist_play(li){
		var id = li.find("div.id").text();
		play(id);
	}

    function play_song_preview(id){
         if (ytplayer) {
             ytplayer.loadVideoById(id, 0);
           }
    }


    function add(id, title, duration){
    	songNum = $('li').size() + 1;
    	class_id = 'song_'+ songNum;
		 var song_data = '<li class="listmix" id="'+ class_id +'">';
			song_data += '	<div class="handle" style="cursor:move">Move</div>';
			song_data += '	<div class="data">';
			song_data += '		<span class="title" id="play">'+ title +'</span>';
			song_data += '		<span class="remove">remove</span>';
			song_data += '		<span class="edit">Edit</span>';
			song_data += '	</div>';
			song_data += '	<div class="rename" style="display: none;">';
			song_data += '		<input class="song_title" type="text"/>';
			song_data += '		<input class="save button" type="button" value="Save"/>';
			song_data += '		<input class="cancel button" type="button" value="Cancel"/>';
			song_data += '	</div>';
			song_data += '	<div class="youtubeid" style="display:none">'+id+'</div>';
			song_data += '	<div class="id" style="display:none">'+class_id+'</div>';
			song_data += '</li>';
			
		var data = $(song_data);
		$('.playlist').append(data);
		copy_funk(data);
    }

    function remove_song(li){
        li.remove();
   	}

   	function edit_title(li){
   	   	
   		li.find("input.song_title").val(li.find("span.title").text());
   		li.find("div.data").css('display', 'none');
   		li.find("div.rename").css('display', 'block');
   	}

   	function edit_close(li){

   		li.find("div.data").css('display', 'block');
   		li.find("div.rename").css('display', 'none');
   	}

   	function edit_save(li){

   		li.find("span.title").text(li.find("input.song_title").val());
 		edit_close(li);
   	}

   	function copy_funk(playlist){
   		playlist.each(function(i){
   			var li = $(this);

   			li.find("span.edit").click(function(){ edit_title(li); });
   			li.find("input.cancel").click(function(){ edit_close(li); });
   			li.find("input.save").click(function(){ edit_save(li); });
   			li.find("span.remove").click(function(){ remove_song(li); });
   			li.find("span.title").click(function(){ playlist_play(li); });
   			
   		});
   	}   	