<?php
/*****
 * combine given array of JS source files into a single destination file
 *****/

//destination file
$destination = '../../js/ugsEditorPlus.merged.js';

// explanatory text (unminified comment at start of destination file)
$destination_header = "
/*****
 * Project: UkeGeeks' Song-a-matic Editor - Next Generation
 * Project Repository: https://github.com/bloodybowlers/UkeGeeks-ng
 * Original Author: Buz Carter
 * Copyright: Copyright 2010-2015 Buz Carter.
 * License GNU General Public License (http://www.gnu.org/licenses/gpl.html)
 * 
 * 
 * This library implements the UkeGeeks Scriptasaurus Song-a-matic editor functions, bridging the page UI and scriptasaurus methods.
 * 
 *****/
 
";

//source files in correct order
$files_array = array(
	'./editor/ugsEditorPlus.namespace.js'            ,
	'./editor/ugsEditorPlus.options.js'              ,
	'./editor/ugsEditorPlus.actions.js'              ,
	'./editor/ugsEditorPlus.songUi.js'               ,
	'./editor/ugsEditorPlus.styles.js'               ,
	'./editor/ugsEditorPlus.themes.js'               ,
	'./editor/ugsEditorPlus.optionsDlg.js'           ,
	'./editor/ugsEditorPlus.reformat.js'             ,
	'./editor/ugsEditorPlus.autoReformat.js'         ,
	'./editor/ugsEditorPlus.topMenus.js'             ,
	'./editor/ugsEditorPlus.submenuUi.js'            ,
	'./editor/ugsEditorPlus.newSong.js'              ,
	'./editor/ugsEditorPlus.updateSong.js'           ,
	'./editor/ugsEditorPlus.deleteSong.js'           ,
	'./editor/ugsEditorPlus.reindex.js'              ,
	'./editor/ugsEditorPlus.typeahead.js'            ,
	'./editor/ugsEditorPlus.resize.js'               ,
	'./editor/ugsEditorPlus.chordBuilder.js'         ,
	'./editor/ugsEditorPlus.songAmatic.js'           ,
	'./editor/ugsEditorPlus.stickyChords.js'         ,
	'./editor/ugsEditorPlus.autoscroll.js'           ,
	'./editor/ugsEditorPlus.hoverChords.js'          ,
	'./editor/ugsChordBuilder.js'                    ,
	'./editor/ugsChordBuilder.chooserList.js'        ,
	'./editor/ugsChordBuilder.reverseChordFinder.js' ,
	'./editor/ugsChordBuilder.chordFinder.js'        ,
	'./editor/ugsChordBuilder.editorUi.js'           ,
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
