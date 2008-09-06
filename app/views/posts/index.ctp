<?php 

$myhtml = file_get_html('/opt/nginx/html/firetube/app/views/posts/html/index.html');
$myhtml->find('div[id=add_posts]', 0)->innertext = $html->link('Add Post','/posts/add');
$RowTemplate = $myhtml->find('tr[id=for_each]',0);

//save the row template 
$row_text = $RowTemplate->outertext;

//$myhtml->find('tr[id=for_each]',0)->$id = '';
 $row = $myhtml->find('tr[id=for_each]',0);
//print_r($posts);

foreach ($posts as $post){
 $row->outertext=$row->outertext."$row_text";

// $row->find('td[id=post_id]',0)->innertext = $post['Post']['id'];
// $row->find('td[id=post_view]',0)->innertext = $html->link($post['Post']['title'],"/posts/view/".$post['Post']['id']);;
// $row->find('td[id=post_delete]',0)->innertext = $html->link('Delete', "/posts/delete/{$post['Post']['id']}", null, 'Are you sure?' );
// $row->find('td[id=post_date]',0)->innertext = $post['Post']['created'];
//$row = $myhtml->find('tr[id=for_each]',$i);
}
$i=0;

foreach($myhtml->find('tr[id=for_each]') as $for_each) {
//echo $for_each->find('td[id=post_id]',0)->innertext;
echo $posts[$i]['Post']['id'];
 $i++;
}


echo $myhtml; 


?>
