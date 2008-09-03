<?php 

$myhtml = file_get_html('/opt/nginx/html/firetube/app/views/posts/html/index.html');
$myhtml->find('div[id=add_posts]', 0)->innertext = $html->link('Add Post','/posts/add');
$row = $myhtml->find('tr[id=for_each]',0);
$row_text = $row->outertext;

//$myhtml->find('tr[id=for_each]',0)->$id = '';
$i=0;
foreach ($posts as $post){
 $row->find('td[id=post_id]',0)->innertext = $post['Post']['id'];
 $row->find('td[id=post_view]',0)->innertext = $html->link($post['Post']['title'],"/posts/view/".$post['Post']['id']);;
 $row->find('td[id=post_delete]',0)->innertext = $html->link('Delete', "/posts/delete/{$post['Post']['id']}", null, 'Are you sure?' );
 $row->find('td[id=post_date]',0)->innertext = $post['Post']['created'];
$i++;
$row->outertext=$row->outertext."$row_text";
//$row = $myhtml->find('tr[id=for_each]',$i);


}
echo $myhtml; 


?>
