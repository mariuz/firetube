<?php
App::import('Vendor', 'simplehtmldom'.DS.'simple_html_dom');
class PostsController extends AppController {
	function index() {
		$this->set('posts', $this->Post->find('all'));
	}

	function view($id) {
		$this->Post->id = $id;
		$this->set('post', $this->Post->read());

	}

	function add() {
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->flash('Your post has been saved.', '/posts');
			}
		}
	}
	function delete($id) {
        $this->Post->del($id);
        $this->flash('The post with id: '.$id.' has been deleted.', '/posts');
	}
}
?>
