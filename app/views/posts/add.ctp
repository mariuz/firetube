<?php

$myhtml = file_get_html('/opt/nginx/html/firetube/app/views/posts/html/add.html');
echo  $myhtml;

echo $form->create('Post');
echo $form->input('title');
echo $form->input('body', array('rows' => '3'));
echo $form->end('Save Post');
?>
