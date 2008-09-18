<?php

$myhtml = file_get_html(VIEWS.$this->viewPath.'/html/view.html');
$myhtml->find('h1[id=post_title]', 0)->innertext = $post['Post']['title'];
$myhtml->find('p[id=date_created]', 0)->innertext = $post['Post']['created'];
$myhtml->find('p[id=post_body]', 0)->innertext = $post['Post']['body'];

echo  $myhtml;
?>
