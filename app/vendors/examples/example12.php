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

	echo '<html><head></head><body>';
	echo '<a style="font-size:12px;" href="index.php#examples">&larr; Back to examples list</a><br /><br />';
	echo '<strong>This example shows you how to manipulate/format timecode strings.</strong><br /><br />';
	$ignore_demo_files = true;
	
// 	load the examples configuration
	require_once 'example-config.php';
	
// 	require the library
	require_once '../phpvideotoolkit.'.$use_version.'.php';
	
// 	temp directory
	$tmp_dir = PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'tmp/';
	
// 	set the frame rate for the timecodes
	$frame_rate = 25;
	
// 	set the time to examine / format
	$timecode = '01:14:32.59';
	$timecode_format = '%hh:%mm:%ss.%ms';
	
	echo '<strong>Original Timecode</strong><br />';
	echo $timecode.'<br /><br />';
	
// 	start ffmpeg class
	$toolkit = new PHPVideoToolkit($tmp_dir);
	
	echo '<strong>Timecode conversion to seconds</strong><br />';
	echo 'Frame seconds (rounded) -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%st', $frame_rate).'<br />';
	echo 'Frame seconds (rounded down) -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%sf', $frame_rate).'<br />';
	echo 'Frame seconds (rounded up) -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%sc', $frame_rate).'<br />';
	echo 'Frame seconds -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%mt', $frame_rate).'<br /><br />';
	
	echo '<strong>Timecode conversion to frames</strong><br />';
	echo 'Frame number (in current second) -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%fn', $frame_rate).'<br />';
	echo 'Frame number (in video) -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%ft', $frame_rate).'<br /><br />';
	
	echo '<strong>Timecode conversion to other timecodes</strong><br />';
	echo 'hh:mm -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%hh:%mm', $frame_rate).'<br />';
	echo 'hh:mm:ss -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%hh:%mm:%ss', $frame_rate).'<br />';
	echo 'hh:mm:ss.fn -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%hh:%mm:%ss.%fn', $frame_rate).'<br />';
	echo 'hh:mm:ss.ms -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%hh:%mm:%ss.%ms', $frame_rate).'<br />';
	echo 'mm:ss (smart minutes) -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%mm:%ss', $frame_rate).'<br />';
	echo 'mm:ss.fn (smart minutes) -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%mm:%ss.%fn', $frame_rate).'<br />';
	echo 'ss.ms (smart seconds) -> '.$toolkit->formatTimecode($timecode, $timecode_format, '%ss.%ms', $frame_rate).'<br />';
	
    echo '</body></html>';
