<?php

$myhtml = file_get_html('/opt/nginx/html/firetube/app/views/movies/html/add.html');
echo  $myhtml;

echo $form->create('Movie');
echo $form->input('Filename');
echo $form->end('Save Post');
?>
