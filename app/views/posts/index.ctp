<?php 

$myhtml = file_get_html(VIEWS.$this->viewPath.'/html/index.html');
$RowTemplate =  file_get_html(VIEWS.$this->viewPath.'/html/for_each_table.html');
$myhtml->find('div[id=add_posts]', 0)->innertext = $html->link('Add Post','/posts/add');

foreach ($posts as $post){
 $RowTemplate->find('td[id=post_id]',0)->innertext = $post['Post']['id'];
 $RowTemplate->find('td[id=post_view]',0)->innertext = $html->link($post['Post']['title'],"/posts/view/".$post['Post']['id']);
 $RowTemplate->find('td[id=post_delete]',0)->innertext = $html->link('Delete', "/posts/delete/{$post['Post']['id']}", null, 'Are you sure?' );
 $RowTemplate->find('td[id=post_date]',0)->innertext = $post['Post']['created'];
 $RowText = $RowTemplate->outertext;
 $myhtml->find('div[id=foreach]', 0)->innertext = $RowText.$myhtml->find('div[id=foreach]', 0)->innertext;
}
echo $myhtml; 
?>
