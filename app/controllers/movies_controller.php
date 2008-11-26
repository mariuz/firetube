<?php
App::import('Vendor','simplehtmldom'.DS.'simple_html_dom');
class MoviesController extends AppController {

	function index() {
		$this->set('movies', $this->Movie->find('all'));
	}

	function view($id) {
		$this->Movie->id = $id;
		$this->set('movie', $this->Movie->read());

	}

	function add() {
		if (!empty($this->data)) {
			if ($this->Movie->save($this->data)) {
				$this->flash('Your Movie has been saved.', '/movies');
			}
		}
	}
	function convert($id) {
	$this->Movie->id = $id;
		$this->set('movie', $this->Movie->read());
	//convert function from ogv to flv
	// 	require the library
	require_once '../phpvideotoolkit.'.$use_version.'.php';
	
// 	temp directory
	$tmp_dir = PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'tmp/';
	
//	input movie files
	$files_to_process = array(
		PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'to-be-processed/MOV00007.3gp',
		PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'to-be-processed/Video000.3gp',
		PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'to-be-processed/cat.mpeg'
	);

//	output files dirname has to exist
	$video_output_dir = PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'processed/videos/';
	
//	log dir
	$log_dir = PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_BATH.'logs/';
	
//	bit rate of audio (valid vaues are 16,32,64)
	$bitrate = 64;

//	sampling rate (valid values are 11025, 22050, 44100)
	$samprate = 44100;
	
// 	start PHPVideoToolkit class
	$toolkit = new PHPVideoToolkit($tmp_dir);
	
// 	set PHPVideoToolkit class to run silently
	$toolkit->on_error_die = TRUE;
	
// 	start the timer collection
	$total_process_time = 0;
	
// 	loop through the files to process
	foreach($files_to_process as $key=>$file)
	{
// 		get the filename parts
		$filename = basename($file);
		$filename_minus_ext = substr($filename, 0, strrpos($filename, '.'));
		echo '<strong>Processing '.$filename.'</strong><br />';
		
// 		set the input file
		$ok = $toolkit->setInputFile($file);
// 		check the return value in-case of error
		if(!$ok)
		{
// 			if there was an error then get it 
			echo $toolkit->getLastError()."<br /><br />\r\n";
			$toolkit->reset();
			continue;
		}
		
// 		set the output dimensions
		$toolkit->setVideoOutputDimensions(320, 240);
		
// 		set the video to be converted to flv
		$toolkit->setFormatToFLV($samprate, $bitrate);
		
// 		set the output details and overwrite if nessecary
		$ok = $toolkit->setOutput($video_output_dir, $filename_minus_ext.'.flv', PHPVideoToolkit::OVERWRITE_EXISTING);
// 		check the return value in-case of error
		if(!$ok)
		{
// 			if there was an error then get it 
			echo $toolkit->getLastError()."<br /><br />\r\n";
			$toolkit->reset();
			continue;
		}
		
// 		execute the ffmpeg command using multiple passes and log the calls and ffmpeg results
		$result = $toolkit->execute(true, true);
		
// 		get the last command given
		$command = $toolkit->getLastCommand();
// 		echo $command[0]."<br />\r\n";
// 		echo $command[1]."<br />\r\n";
		
// 		check the return value in-case of error
		if($result !== PHPVideoToolkit::RESULT_OK)
		{
// 			move the log file to the log directory as something has gone wrong
			$toolkit->moveLog($log_dir.$filename_minus_ext.'.log');
// 			if there was an error then get it 
			echo $toolkit->getLastError()."<br /><br />\r\n";
			$toolkit->reset();
			continue;
		}
		
// 		get the process time of the file
		$process_time = $toolkit->getLastProcessTime();
		$total_process_time += $process_time; 
		
		$file = array_shift($toolkit->getLastOutput());
		$filename = basename($file);
		$filename_hash = md5($filename);
		
// 		echo a report to the buffer
	//	echo 'Video converted in '.$process_time.' seconds... <b>'.$file.'</b><br /><br />'; 

	}
	}
	function delete($id) {
        $this->Movie->del($id);
        $this->flash('The Movie with id: '.$id.' has been deleted.', '/movies');
	}
}
?>
