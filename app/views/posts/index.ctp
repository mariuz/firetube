<?php 

$myhtml = file_get_html('/opt/nginx/html/firetube/app/views/posts/html/index.html');
$myhtml->find('div[id=add_posts]', 0)->innertext = $html->link('Add Post','/posts/add');

foreach ($posts as $post){
echo "<foo id=fooz>";
}
echo $myhtml; 



?>
