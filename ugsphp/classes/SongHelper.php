<?php 

/**
 * 
 */
class SongHelper {
	
	/**
	 *
	 * @param string $text input text file block
	 * @return Song(object)
	 */
	public static  function parseSong($text) {
		$song = (object) array(
			 'isOK' => false,
			 'title' => 'Song Not Found',
			 'subtitle' => 'Check your link, please',
			 'artist' => '',
			 'album' => '',
       'key' => '',
       'capo' => '',
       'category' => array(),
			 'body' => '{title: '.Lang::Get('song_not_found_title').'}'."\n".'{subtitle: '.Lang::Get('song_not_found_subtitle').'}'."\n".
                 '[D]Lalalaaaa [A7]Lalaaaaaaaaaaaaala ?' . "\n" . 'Lala [G]laaaaaalalalaaaaaaaaaa [D]la !',
			 'meta' => array()
		);
		
    if (!$text){
      return $song;
    }
		
		$song->isOK = true;
		$song->title = self::getTitle($text);
		$song->subtitle = self::getSubtitle($text);
		$song->artist = self::getArtist($text);
		$song->album = self::getAlbum($text);
		$song->key = self::getKey($text);
		$song->capo = self::getCapo($text);
		$song->meta = self::getMeta($text);
		$song->category = self::getCategory($text);
		$song->body = $text;
		
		return $song;
	}

	// -----------------------------------------
	// PRIVATE METHODS
	// -----------------------------------------
	
	/**
	 * parses Title tag: {Title: Blah Blah}
	 * @param string $text input string to be parses
	 * @return string 
	 */
	private static function getTitle($text) {
		return self::_matchRegEx($text, 2, "/{(t|title)\s*:\s*(.+?)}/i");
	}

	/**
	 * parses Subtitle tag: {Subtitle: Blah Blah}
	 * @param string $text input string to be parses
	 * @return string 
	 */
	private static function getSubtitle($text) {
		return self::_matchRegEx($text, 2, "/{(st|subtitle)\s*:\s*(.+?)}/i");
	}

	/**
	 * parses Artist tag: {Artist: Blah Blah}
	 * @param string $text input string to be parses
	 * @return string 
	 */
	private static function getArtist($text) {
		return self::_matchRegEx($text, 1, "/{artist\s*:\s*(.+?)}/i");
	}

	/**
	 * parses Album tag: {Album: Blah Blah}
	 * @param string $text input string to be parses
	 * @return string 
	 */
	private static function getAlbum($text) {
		return self::_matchRegEx($text, 1, "/{album\s*:\s*(.+?)}/i");
	}

	/**
	 * parses Key tag: {Key: X}
	 * @param string $text input string to be parses
	 * @return string 
	 */
	private static function getKey($text) {
		return self::_matchRegEx($text, 1, "/{key\s*:\s*(.+?)}/i");
	}

	/**
	 * parses Capo tag: {Capo: X}
	 * @param string $text input string to be parses
	 * @return string 
	 */
	private static function getCapo($text) {
		return self::_matchRegEx($text, 1, "/{capo\s*:\s*(.+?)}/i");
	}

	/**
	 * parses Uke Geeks Meta tag: {ukegeeks-meta: Blah Blah}
	 * @param string $text input string to be parses
	 * @return string 
	 */
	private static function getMeta($text) {
		$rtn = array();
		$regEx = "/{(ukegeeks-meta|meta)\s*:\s*(.+?)}/i";
		preg_match_all($regEx, $text, $matches);
		if (count($matches[2]) > 0){
			foreach ($matches[2] as $m) {
				$rtn[] = $m;
			}
		}
		return $rtn;
	}

	/**
	 * parses x_UGNG_category tag: {x_UGNG_category: X,Y,Z}
	 * @param string $text input string to be parses
	 * @return array 
	 */
	private static function getCategory($text) {
    $retCategories = array();
		$x_ugng_category = self::_matchRegEx($text, 1, "/{x_UGNG_category\s*:\s*(.+?)}/i");
    if($x_ugng_category != '')
    {
      $aCategories = explode(',', $x_ugng_category);
      foreach($aCategories as $c)
      {
        $retCategories[] = trim($c);
      }
    }
    return $retCategories;
	}

	/**
	 *
	 * @param string $text input string to be parses
	 * @param int $patternIndex 
	 * @param string $regEx regular expression string
	 * @return string
	 */
	private static function _matchRegEx($text, $patternIndex, $regEx){
		preg_match_all($regEx, $text, $matches);
		return trim((count($matches[$patternIndex]) < 1) ? '' : $matches[$patternIndex][0]);
	}


}
