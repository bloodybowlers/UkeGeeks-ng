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
     * Sets an element's Inner HTML and sets visibility based on whether the value is empty (or not)
     * @method trySet
     * @private
     * @param id {string} element's Id
     * @param value {string} content value
     */
    var trySet = function(id, value){
            var hasValue = value && (value.length > 0);
            var h = document.getElementById(id);
            if (!h){
                    return;
            }
            h.innerHTML = hasValue ? value : "";
            h.style.display = hasValue ? 'block' : 'none';
    };

 /**
	 * Update various HTML parts (H1 &amp; H2 etc.) using TEXT values of Song
	 * @method updateUi
	 * @private
	 * @param song {Song(Object)}
	 */
	_public.update = function(song){
		var h = document.getElementById('songTitle');
		h.innerHTML = (song.title.length > 0) ? song.title : ugs_il8n.untitled_song;

    // ======================
    // Song informations
    // ======================
		trySet('songArtist', song.artist);
		trySet('songAlbum', song.album);
    trySet('songSubtitle', song.st);
    if(song.key != '')
      trySet('songKey', 'Key : ' + song.key);
    else
      trySet('songKey', '');
    if(song.capo != '')
      trySet('songCapo', 'Capo : ' + song.capo);
    else
      trySet('songCapo', '');

    // ==========================
    // x_UGNG_diagramPosition
    // ==========================
    if(song.x_UGNG_diagramPosition != '')
    {
      // Quick and dirty way of positioning the diagram !
      switch(song.x_UGNG_diagramPosition.toLowerCase())
      {
        case 'none':
          $('#diagramPositionPicker a[href="#none"]').click();
          break;
        case 'top':
          $('#diagramPositionPicker a[href="#top"]').click();
          break;
        case 'left':
        default:
          $('#diagramPositionPicker a[href="#left"]').click();
          break;
      }
    }

    // ==========================
    // x_UGNG_lyricStyle
    // ==========================
    if(song.x_UGNG_lyricStyle != '')
    {
      // Quick and dirty way of changing lyric style !
      switch(song.x_UGNG_lyricStyle.toLowerCase())
      {
        case 'inline':
          $('#lyricChordsPicker a[href="#inline"]').click();
          break;
        case 'minidiagrams':
          // MANDATORY : test if already checked to prevent an infinite loop overflowing the call stack !
          if(!$('#lyricChordsPicker a[href="#miniDiagrams"]').parent('li').hasClass('checked'))
          {
            $('#lyricChordsPicker a[href="#miniDiagrams"]').click();
          }
          break;
        case 'above':
        default:
          $('#lyricChordsPicker a[href="#above"]').click();
          break;
      }
    }

    // ==========================
    // x_UGNG_hideChordEnclosures
    // ==========================
    if(song.x_UGNG_hideChordEnclosures != '')
    {
      $chkEnclosures = $('#chkEnclosures');
      switch(song.x_UGNG_hideChordEnclosures.toLowerCase())
      {
        case 'no':
          if($chkEnclosures.is(":checked")) $chkEnclosures.click();
          break;
        case 'yes':
        default:
          if(!$chkEnclosures.is(":checked")) $chkEnclosures.click();
          break;
      }
    }

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
