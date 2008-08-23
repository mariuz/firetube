<?php
class Post extends AppModel
{
	var $name = 'Post';

	var $validate = array(
		'title' => array(
			'rule' => array('minLength', 1)
		),
		'body' => array(
			'rule' => array('minLength', 1)
		)
	);
}
?>
