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
	function delete($id) {
        $this->Movie->del($id);
        $this->flash('The Movie with id: '.$id.' has been deleted.', '/movies');
	}
}
?>
