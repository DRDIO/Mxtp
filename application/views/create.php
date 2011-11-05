<style>
		 #playList { list-style-type: none; margin: 0; padding: 0; width: 60%; }
		 #playList li { margin: 5px 5px 5px 5px; padding: 10px; font-size: 1.2em; width: 570px; background: #ccc; border: 1px solid black;}
		 #yourlist a { margin: 5px 5px 5px 5px; }
		 .playlist_header {  margin: 5px 5px 5px 5px; }
		 #playListTitle { width:525px; height: 40px; font-size: 25px; }
</style>

<div style="width:835px; margin:0 auto 0 auto;">
	<div style="width: 220px; padding: 0 auto 0 15px; float: right">
		<div id="ytplayer" style="margin: 0 auto;"><p>You will need Flash 8 or better to view this content.</p></div>

		<script type="text/javascript">
			var params = { allowScriptAccess: "always" };
			swfobject.embedSWF("http://www.youtube.com/apiplayer?enablejsapi=1&playerapiid=ytplayer", "ytplayer", "212", "183", "8", null, null, params);
		</script>
		<p>Volume:</p>
		<div id="volume" style="width:190px; margin:15px;"></div>
	</div>

	<div id="yourList" style="width: 600px; border: 1px solid black; margin-bottom: 15px;" >
			<div class="playlist_header">
				<form id="playlist_form" action="save" method="post">
				<p><input type="text" name="playListTitle" id="playListTitle" value="Untitled" maxlength=30 /></p>
				<div id="player_controls">
							<a href="javascript:void(0);" onclick="play_previous();">prev</a> |
							<span id="play-pause"><a href="javascript:void(0);" onclick="play();">play</a></span> |
							<a href="javascript:void(0);" onclick="play_next();">next</a>
				</div>
				</form>
			</div>
		<ul class="playlist" id="playlist"></ul>
		<a onclick="save_list();" href="javascript:void(0);">Save</a>
	</div>

	<div style="width: 580px; height: 20px; border: 1px solid black; margin-bottom: 15px; padding: 10px;">
			<form name="searchForm" action='javascript:search();'>
				Search: <input type='text' id='query' name='query' size='60'/>
				<input type="button" id="searchButton" value="search" onclick="search();">
			</form>
	</div>
	<div onscroll="set_results_position()" style="width: 580px; height: 200px; border: 1px solid black; margin-bottom: 15px; padding: 10px; overflow:auto;" id="results">
		<ul class="results_list"></ul>
	</div>
</div>