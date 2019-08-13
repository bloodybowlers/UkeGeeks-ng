
/**
 * Exposes the only method required for chord hovering in Scriptasaurus Song-a-matic editor.
 *
 * @class hoverChords
 * @namespace ugsEditorPlus
 * @static
 * @singleton
 */
ugsEditorPlus.hoverChords = (function() {

	/**
	 * attach public members to this object
	 * @property _public
	 * @type JsonObject
	 */
	var _public = {};

	_public.init = function() {

    $('#ukeSongText code em').on('mouseover', function (e) {

      var $div = $('#chordsHovering');
      var chordName = e.currentTarget.innerText;
      var $diagram = $('#ukeChordsCanvas [data-chordname=' + chordName + ']')
      var $chordsHoveringCanvas = $('#chordsHoveringCanvas');
    
      cloneCanvas($diagram[0], $chordsHoveringCanvas[0]);

      // Needs to be set BEFORE changing top/left
      $div.show();

      $div.css('top', e.clientY - $div.height() - 20);
      $div.css('left', e.clientX - ($chordsHoveringCanvas.width() / 2));

      return false;
    });

    $('#ukeSongText code em').on('mouseleave', function () {
      $('#chordsHovering').hide();
      return false;
    });

    // Specific CSS styling of the chord name
    // to show the user that hovering is active
    $('#ukeSongText code em').addClass('hoverlink');

  }

	_public.deinit = function() {
    $('#ukeSongText code em').unbind('mouseover');
    $('#ukeSongText code em').unbind('mouseleave');
    // Removing specific styling
    $('#ukeSongText code em').removeClass('hoverlink');
  }

  function cloneCanvas(srcCanvas, destCanvas)
  {
      destCanvas.width = srcCanvas.width;
      destCanvas.height = srcCanvas.height;
      destCanvas.getContext('2d').drawImage(srcCanvas, 0, 0);
  }

	// ------------------------
	// return public interface 
	// ------------------------
	return _public;

}());
