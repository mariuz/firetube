<?php

	/* SVN FILE: $Id$ */
	
	/**
	 * @author Oliver Lillie (aka buggedcom) <publicmail@buggedcom.co.uk>
	 * @package PHPVideoToolkit
	 * @license BSD
	 * @copyright Copyright (c) 2008 Oliver Lillie <http://www.buggedcom.co.uk>
	 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation
	 * files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy,
	 * modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software
	 * is furnished to do so, subject to the following conditions:  The above copyright notice and this permission notice shall be
	 * included in all copies or substantial portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
	 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
	 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
	 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	 */

	echo '<html><head><script type="text/javascript" charset="utf-8" src="pluginobject/pluginobject.js"></script><script>PO.Options.auto_load_prefix="pluginobject/plugins/"</script></head><body>';
	echo '<a style="font-size:12px;" href="index.php#examples">&larr; Back to examples list</a><br /><br />';
	echo '<strong>This example shows you how to convert videos to common formats simply by using the simple adapters.</strong><br />';
	echo '<span style="font-size:12px;">&bull; The flash media player used below is Jeroen Wijering\'s excellent <a href="http://www.jeroenwijering.com/?item=JW_FLV_Media_Player">Flash Media Player</a>. Although bundled with this package the Flash Media Player has a <a href="http://creativecommons.org/licenses/by-nc-sa/2.0/">Creative Commons Attribution-Noncommercial-Share Alike 2.0 Generic</a> license.</span><br />';
	echo '<span style="font-size:12px;">&bull; The media is embedded using <a href="http://sourceforge.net/projects/pluginobject/">PluginObject</a> to embed the examples. It is distributed under a BSD License.</span><br /><br />';
	
// 	load the examples configuration
	require_once 'example-config.php';
	
// 	require the library
	require_once '../phpvideotoolkit.'.$use_version.'.php';
	require_once '../adapters/videoto.php';
	
// 	temp directory
	$tmp_dir = PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'tmp/';
	
// 	processed file output directory
	$output_dir = PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'processed/videos/';
	
//	input movie files
	$files_to_process = array(
		PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'to-be-processed/MOV00007.3gp',
		PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'to-be-processed/Video000.3gp',
		PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'to-be-processed/cat.mpeg'
	);

// 	loop through the files to process
	foreach($files_to_process as $file)
	{
		echo '<strong>Processing '.basename($file).'</strong><br />';
		
// 		convert the video to a gif format
		$result = VideoTo::gif($file, array(
				'temp_dir'					=> $tmp_dir, 
				'output_dir'				=> $output_dir, 
				'output_file'				=> '#filename-gif.#ext', 
				'die_on_error'				=> false,
				'overwrite_mode'			=> PHPVideoToolkit::OVERWRITE_EXISTING
			));
// 		check for an error
		if($result !== PHPVideoToolkit::RESULT_OK)
		{
			echo VideoTo::getError().'<br />'."\r\n";
			echo 'Please check the log file generated as additional debug info may be contained.<br />'."\r\n";
		}
		else
		{
			$output = VideoTo::getOutput();                                                        
			$dimensions = getimagesize($output[0]);
			echo 'Coverted to <img src="processed/videos/'.basename($output[0]).'" width="'.$dimensions[0].'" height="'.$dimensions[0].'" />.<br />'."\r\n";
		}
		
// 		convert the video to a psp mp4
		$result = VideoTo::PSP($file, array(
				'temp_dir'					=> $tmp_dir, 
				'output_dir'				=> $output_dir, 
				'output_file'				=> '#filename-psp.#ext', 
				'die_on_error'				=> false,
				'overwrite_mode'			=> PHPVideoToolkit::OVERWRITE_EXISTING
			));
// 		check for an error
		if($result !== PHPVideoToolkit::RESULT_OK)
		{
			echo VideoTo::getError().'<br />'."\r\n";
			echo 'Please check the log file generated as additional debug info may be contained.<br />'."\r\n";
		}
		else
		{
			$output = VideoTo::getOutput();
			$filename = basename($output[0]);
			$filename_hash = md5($filename);
			echo 'Coverted to PSP mp4...<br />
<div id="'.$filename_hash.'"></div>
<script type="text/javascript" charset="utf-8">
	PluginObject.embed("processed/videos/'.$filename.'", {
		width : 320,
		height: 240,
		force_plugin:PluginObject.Plugins.Quicktime,
		force_into_id:"'.$filename_hash.'",
		params: {
			autoplay: false
		}
	});         
</script><br />'."\r\n";
		}
		
// 		convert the video to flv
		$result = VideoTo::FLV($file, array(
				'temp_dir'					=> $tmp_dir, 
				'output_dir'				=> $output_dir, 
				'die_on_error'				=> false,
				'overwrite_mode'			=> PHPVideoToolkit::OVERWRITE_EXISTING
			));
// 		check for an error
		if($result !== PHPVideoToolkit::RESULT_OK)
		{
			echo VideoTo::getError().'<br />'."\r\n";
			echo 'Please check the log file generated as additional debug info may be contained.<br />'."\r\n";
		}
		else
		{
			$output = VideoTo::getOutput();
			$filename = basename($output[0]);
			$filename_hash = md5($filename);
			echo 'Coverted to Flash Video (flv)...<br />
<div id="'.$filename_hash.'"></div>
<script type="text/javascript" charset="utf-8">
	PluginObject.embed("processed/videos/'.$filename.'", {
		width : 320,
		height: 240,
		force_plugin:PluginObject.Plugins.FlashMedia,
		player: "mediaplayer/mediaplayer.swf",
		force_into_id:"'.$filename_hash.'", 
		overstretch:true,
		params: {
			autoplay: false
		}
	});         
</script><br />'."\r\n";
		}
		
// 		convert the video to an ipod mp4
		$result = VideoTo::iPod($file, array(
				'temp_dir'					=> $tmp_dir, 
				'output_dir'				=> $output_dir, 
				'die_on_error'				=> false,
				'output_file'				=> '#filename-ipod.#ext',
				'overwrite_mode'			=> PHPVideoToolkit::OVERWRITE_EXISTING
			));
// 		check for an error
		if($result !== PHPVideoToolkit::RESULT_OK)
		{
			echo VideoTo::getError().'<br />'."\r\n";
			echo 'Please check the log file generated as additional debug info may be contained.<br /><br />'."\r\n";
		}
		else
		{                                           
			$output = VideoTo::getOutput();
			$filename = basename($output[0]);
			$filename_hash = md5($filename);
			echo 'Coverted to iPod mp4...<br />
<div id="'.$filename_hash.'"></div>
<script type="text/javascript" charset="utf-8">
	PluginObject.embed("processed/videos/'.$filename.'", {
		width : 320,
		height: 240,
		force_plugin:PluginObject.Plugins.Quicktime,
		force_into_id:"'.$filename_hash.'",
		params: {
			autoplay: false
		}
	});         
</script><br />'."\r\n";
		}
		
	}
	
    echo '</body></html>';