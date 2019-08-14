<?php
/*****
 * combine given array of JS source files into a single destination file
 *****/

//destination file
$destination = '../../js/ukeGeeks.scriptasaurus.merged.js';

// explanatory text (unminified comment at start of destination file)
$destination_header = "
/*****
 * Project: UkeGeeks' Scriptasaurus - Next Generation
 * Project Repository: https://github.com/bloodybowlers/UkeGeeks-ng
 * Original Author: Buz Carter
 * Copyright: Copyright 2010-2015 Buz Carter.
 * License GNU General Public License (http://www.gnu.org/licenses/gpl.html)
 * 
 * 
 * Reads marked-up music (lyrics + chords) extracting all of the chords used;
 * Generates a chord diagrams using HTML5 &lt;canvas&gt; and rewrites the music with
 * standard HTML wrapping the chords.
 *
 *****/
 
";

//source files in correct order
$files_array = array(
	'./scriptasaurus/ukeGeeks.namespace.js', 
	'./scriptasaurus/ukeGeeks.definitions.js', 
	'./scriptasaurus/ukeGeeks.settings.js', 
	'./scriptasaurus/ukeGeeks.data.js', 
	'./scriptasaurus/ukeGeeks.chordImport.js', 
	'./scriptasaurus/ukeGeeks.transpose.js', 
	'./scriptasaurus/ukeGeeks.definitions.standardUkuleleGcea.js', 
	'./scriptasaurus/ukeGeeks.canvasTools.js', 
	'./scriptasaurus/ukeGeeks.chordBrush.js', 
	'./scriptasaurus/ukeGeeks.chordParser.js', 
	'./scriptasaurus/ukeGeeks.cpmParser.js', 
	'./scriptasaurus/ukeGeeks.chordPainter.js', 
	'./scriptasaurus/ukeGeeks.tabs.js', 
	'./scriptasaurus/ukeGeeks.overlapFixer.js', 
	'./scriptasaurus/ukeGeeks.scriptasaurus.js',
);

/**********
 * THAT'S IT, NO NEED TO EDIT ANYTHING BELOW THIS LINE
 **********/

// initialize
$contentJS     = '';
$input_counter = count($files_array);
$cat_counter   = 0;

echo '<pre>';
echo 'now building '.$destination.'<br><br>';

// loop through array and concat all files to $contentJS
foreach ($files_array as $file){ //loop through array list
	if(is_file($file)) {
		$contentJS  .= file_get_contents($file); //read each file
		$cat_counter = $cat_counter + 1;
	}
}

echo '+ combined '.$cat_counter.' of intended '.$input_counter.' files<br>';
//echo $contentJS;

// minifyJS
//$contentJS = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $contentJS);
//$contentJS = str_replace(["\r\n","\r","\t","\n",'  ','    ','     '], '', $contentJS);
//$contentJS = preg_replace(['(( )+\))','(\)( )+)'], ')', $contentJS);

// backup existing file before overwriting
$backup_file = $destination . '.sav';
if (is_file($backup_file)) {
	unlink($backup_file); //delete existing (previous) backup
}
rename($destination, $backup_file);
echo '+ saved previous version to '.$backup_file.'<br>';

// write new header and minified content to destination
$merged_file = fopen($destination, "w" ); //open file for writing
fwrite($merged_file, $destination_header);
fwrite($merged_file , $contentJS); //write to destination
fclose($merged_file); 

echo '+ new content written to '.$destination.'<br>';

echo '= all done';
echo '</pre>';

?>
