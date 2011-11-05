<div>

<?php if (!$playlist): ?>

    <div id="contentFull">
        This mixtape either has either been deactivated or never existed.
    </div>

<?php else: ?>

    <div id="contentVideo">
        <div id="ytplayer">You will need Flash 8 or better to view this content.</div>
        <div id="videoVolume"></div>

        <div id="videoButtons">
            <a id="videoButtonPrev" href="#prev" title="Previous">Previous</a>
            <a id="videoButtonPlay" href="#play" title="Play">Play</a>
            <a id="videoButtonNext" href="#next" title="Next">Next</a>
        </div>

<?php if (!$isUser): ?>

    	<a id="mixFavorite" href="/favorite/update/<?php echo $playlistId; ?>" title="Add to Favorites" class="listmix playing">
            <span class="text">
                <?php echo ($playlist['favorite'] ? 'Remove from' : 'Add to'); ?> Favorites
            </span>    		
                    
            <span class="ui-icon ui-icon-heart ui-state-default ui-corner-all right" 
                <?php echo ($playlist['favorite'] ? '' : 'style="display:none;"'); ?>>Favorite
            </span>
        </a>

<?php endif; ?>

    </div>

    <div id="contentMain">
        <span class="contentHeader">
            <h1>// <?php echo $playlist['title']; ?></h1>
            <h2>by <?php echo $playlist['username']; ?></h2>
        </span>

        <ul id="mixList">

<?php foreach($playlist['songs'] as $song): ?>

    		<li id="song_<?php echo $song['id']; ?>" youtube="<?php echo $song['youtube_id']; ?>" class="listmix">
                <strong><?php  echo $song['title']; ?></strong>
    		</li>

<?php endforeach; ?>

		</ul>
	</div>

<?php endif; ?>

</div>

<style type="text/css">
    #contentVideo {
        float: left;
        width: 212px;
    }

        #videoButtons { 
            overflow: auto;
            width: 160px;
            margin: 8px 26px;
        }

            #videoButtons a { display: block; float: left; overflow: hidden; text-indent: -9999em; background: no-repeat 50% 50%; }            
            #videoButtonPlay { width: 64px; height: 64px; background-image: url(/image/play.png) !important; }
            #videoButtonPrev, #videoButtonNext { width: 48px; height: 48px; }
            #videoButtonPrev { background-image: url(/image/back.png) !important; }
            #videoButtonNext { background-image: url(/image/forward.png) !important; }

            .videoPlaying {
                display: none;
                background-image: url(/image/stop.png) !important;
            }

        #videoVolume {
            width: 190px;
            margin: 6px;
        }

    #contentMain {
        width: 700px;
        float: right;
    }

        .contentHeader {
            display: block;
            margin-bottom: 0.8em;
        }

            .contentHeader h1 { 
                font-weight: bold;
                font-size: 3em;
                line-height: 1em;
                margin: 0;
            }

            .contentHeader h2 { 
                font-size: 2em;
                margin-bottom: 0.8em;
                margin: 0;
            }

        #mixList { 
            list-style: none;
            padding: 0;
        }

            #mixList li {
                background: #555;
                -moz-border-radius: 8px;
                -webkit-border-radius: 8px;
                border-radius: 8px;
                padding: 6px;
                font-size: 1.4em;
                overflow: hidden;
                margin-bottom: 0.4em;
                display: block;
                text-decoration: none;
            }

                #mixList li:hover {
                    background: #3FA59B !important;
                }

                .listPlaying {
                    background: purple !important;
                }

    a { color: inherit; }
</style>

<script type="text/javascript">
    var ytplayer;
    
    $(function() {
        // Initialize Video Object (Currently YouTube only)
        swfobject.embedSWF('http://www.youtube.com/apiplayer?enablejsapi=1&version=3&playerapiid=ytplayer',
            'ytplayer', '212', '183', '8', null, null, { allowScriptAccess: 'always' });

        // Initialize Video Buttons
        $('#videoButtonPrev').click(function(e) {
            e.preventDefault();
            videoPrev();
        });

        $('#videoButtonPlay').click(function(e) {
            e.preventDefault();
            
            var player = $('#ytplayer');
            var status = player.data('status');

            if (status == 'playing') {
                videoPause();
            } else if (status == 'paused') {
                videoContinue();
            } else {
                var item = $('#mixList li:first');
                videoStart(item);
            }
        });

        $('#videoButtonNext').click(function(e) {
            e.preventDefault();
            videoNext();
        });

        // Initialize Volume Slider
        $('#videoVolume').slider({
	        orientation: 'horizontal',
			range:       'min',
			animate:     true,
	        min:         0,
	        max:         100,
	        value:       100,
	        stop: function(e, ui) {
	    		set_volume(ui.value);
	    	}
        });

        // Initialize List Options
        $('#mixList li').click(function(e) {
            e.preventDefault();

            videoStart($(this));
        });
    });

    function videoPause() {
    	ytplayer.pauseVideo();

        $('#videoButtonPlay').removeClass('videoPlaying');
        $('#ytplayer').data('status', 'paused');
    }

    function videoContinue() {
    	ytplayer.playVideo();

        $('#videoButtonPlay').addClass('videoPlaying');
        $('#ytplayer').data('status', 'playing');
    }

    function videoStart(el) {
        ytplayer.loadVideoById(el.attr('youtube'), 0, 'small');

        $('#mixList li').removeClass('listPlaying');
        el.addClass('listPlaying');
        
        $('#videoButtonPlay').addClass('videoPlaying');
        $('#ytplayer').data('status', 'playing');
    }

    function videoNext() {
        var item;
        var list    = $('#mixList');
        var current = list.children('li.listPlaying');

        if (!current.is(':visible') || current.is(':last-child')) {
            item = list.children('li:first');
        } else {
            item = current.next();
        }

        videoStart(item);
    }

    function videoPrev() {
        var item;
        var list    = $('#mixList');
        var current = list.children('li.listPlaying');
        
        if (!current.is(':visible') || current.is(':first-child')) {
            item = list.children('li:last');
        } else {
            item = current.prev();
        }

        videoStart(item);
    }

    function onYouTubePlayerReady(playerId) {
        //like ron popeil says set it and forget it
        ytplayer = document.getElementById('ytplayer');
        ytplayer.addEventListener('onStateChange', 'ytStateChange');
        ytplayer.addEventListener('onError', 'ytError');
    }

    function ytStateChange(state) {
        // This event is fired whenever the player's state changes.
        // Possible values are unstarted (-1),
        // ended (0),
        // playing (1),
        // paused (2),
        // buffering (3),
        // video cued (5).
        // When the SWF is first loaded it will broadcast an unstarted (-1) event.
        // When the video is cued and ready to play it will broadcast a video cued event (5).

        // alert(state + ' ' + ytplayer.getPlaybackQuality());

    	if (state == 0) {
            videoNext();
        }
    }

    function ytError(error) {
        videoNext();
    }
</script>