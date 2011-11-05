    
var playing = null;
var playing_status = 'stopped';

function onYouTubePlayerReady(playerId) {
        //like ron popeil says set it and forget it
        ytplayer = document.getElementById("ytplayer");
        ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
        ytplayer.addEventListener("onError", "onplayerError");
        $('#playpause').css('background', 'url(/image/play.png)');        

        playlist_status = 'stopped';
      }
	
function load_song(id, startSeconds) {
         if (ytplayer) {
           ytplayer.loadVideoById(id, startSeconds);
         }
     } 

    function play_song(li){
    	
    	if(playing != null){
    		current_song = playing;
    		current_song.removeClass('playing');
    	}
    	
    	li.addClass('playing');
		var tube = li.find('.youtubeid').text();
	    load_song(tube, 0);
	    playing = li;
	    
	    if(playlist_status == 'paused') {
	    	// pause_html = '<a onclick="pause();" href="javascript:void(0);">pause</a>';
		    // $('#play-pause').html(pause_html);
	    }
	    
	    playlist_status = 'playing';
	    $('#playpause').css('background', 'url(/image/stop.png)');
    }

    function play(id){
    	if(player_state != 3){
	    	if(id){
	    		play_song($('#'+id));
	    		//alert(id);
	    	}else{
				if (playlist_status == 'stopped') {
		    		play_song($('.playlist').find('li:first'));
		    		$('#playpause').css('background', 'url(/image/stop.png)');
				} else if (playlist_status == 'paused') {
					playlist_status = 'playing';	
					$('#playpause').css('background', 'url(/image/stop.png)');
					ytplayer.playVideo();
				} else {
					pause();
				}
	    	}
    	}

	    // pause_html = '<a onclick="pause();" href="javascript:void(0);">pause</a>';
	    // $('#play-pause').html(pause_html);
    }

    function pause(){
    	ytplayer.pauseVideo();
    	$('#playpause').css('background', 'url(/image/play.png)');
    	
    	playlist_status = 'paused';
	    // play_html = '<a onclick="play();" href="javascript:void(0);">play</a>';
    	// $('#play-pause').html(play_html);
    }

    function play_next(){
		current_song = playing;
		//current_song.removeClass('playing');
		next_song = current_song.next('li');
		if(next_song.length != 1){
			next_song = $('.playlist').find('li:first');
		}
		play_song(next_song);
    }

    function play_previous(){
		current_song = playing;
		//current_song.removeClass('playing');
		prev_song = current_song.prev('li');
		
		if(prev_song.length != 1){
			prev_song = $('.playlist').find('li:last');
		}
		play_song(prev_song);
    }

    function onytplayerStateChange(newState) {
    	
    	player_state = newState;
    	
    	if(newState == 0){
    		play_next();
    	}
    }

    function setytplayerState(newState) {
    	if(newState == 0){
    		play_next();
    	}
    }

    function onplayerError(error) {
   		 play_next();
    }
    
    function set_volume(level) {
    	ytplayer.setVolume(level)
    }
    
    $(function() {
	    $("#volume").slider({
	        orientation: 'horizontal',
			range: "min",
			animate: true,
	        min: 0,
	        max: 100,
	        value: 100,
	        stop: function(event, ui) { 
	    		set_volume(ui.value);
	    	}
	  });
    });
