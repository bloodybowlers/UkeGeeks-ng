/**
 * Reindex songs
 * Dependencies: jQuery
 * @class reindex
 * @namespace ugsEditorPlus
 */
ugsEditorPlus.reindex = (function() {
	/**
	 * attach public members to this object
	 * @property _public
	 * @type JsonObject
	 */
	var _public = {};

	_public.init = function(Uri) {

		$('#reindexBtn').click(function(e) {
      if (confirm(ugs_il8n.reindex_confirm)) 
      {
        window.location.href = Uri;
      }
		});

	};

	// ---------------------------------------
	// return public interface "JSON handle"
	// ---------------------------------------
	return _public;
})();
