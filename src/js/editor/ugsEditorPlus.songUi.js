/**
 * Handles transfering the easy text bits of a Song -- title, artist, etc -- to the page.
 * @class songUi
 * @namespace ugsEditorPlus
 */
ugsEditorPlus.songUi = (function() {
	/**
	 * attach public members to this object
	 * @property _public
	 * @type JsonObject
	 */
	var _public = {};


 /**
	 * Update various HTML parts (H1 &amp; H2 etc.) using TEXT values of Song
	 * @method updateUi
	 * @private
	 * @param song {Song(Object)}
	 */
	_public.update = function(song){
		var h = document.getElementById('songTitle');
		h.innerHTML = (song.title.length > 0) ? song.title : 'Untitled-Song';

		$('#songArtist').html(song.artist);
		$('#songAlbum').html(song.album);
    if(song.key != '')
      $('#songKey').html('Key : ' + song.key);
    else
      $('#songKey').html('');
		$('#songSubtitle').html(song.st);

		h = document.getElementById('songMeta');
		if (!song.ugsMeta || (song.ugsMeta.length < 1)){
			h.style.display = 'none';
		}
		else {
			var s = '';
			for(var i = 0; i < song.ugsMeta.length; i++){
				s += '<p>' + song.ugsMeta[i] + '</p>';
			}
			h.innerHTML = s;
			h.style.display = 'block';
		}

    // Update stickychords
    ugsEditorPlus.stickyChords.init();
	};

	// ---------------------------------------
	// return public interface "JSON handle"
	// ---------------------------------------
	return _public;

}()
);
