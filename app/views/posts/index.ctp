<?php 

$myhtml = file_get_html('/opt/nginx/html/firetube/app/views/posts/html/index.html');
$myhtml->find('div[id=add_posts]', 0)->innertext = $html->link('Add Post','/posts/add');
$row = $myhtml->find('tr[id=for_each]',0);
$row_text = $row->outertext;

$myhtml->find('tr[id=for_each]',0)->outertext = '';
foreach ($posts as $post){

echo $row_text;
}
echo $myhtml; 



?>
