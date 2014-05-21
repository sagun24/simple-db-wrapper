<?php 
	require_once('db.class.php');


	//establish connection
	$db = new db;

	//custom sql
	$sql = "SELECT * FROM faq";
	$result = $db->sql($sql);
	var_dump($result);

	//get single row by id
	$result = $db->get('faq',14);
	//var_dump($result);


	//get all rows
	$result = $db->get_all('faq');
	//var_dump($result);

	//count from a sql
	$sql = "SELECT * FROM faq";
	$result = $db->count($sql);
	//var_dump($result);

	//insert into a table

	$data['question'] = 'q';
	$data['answer'] = 'a';
	$data['add_date'] = '2013-03-10';
	/*$result = $db->insert($data, 'faq');
	echo $result;*/


	//update where
	$data['question'] = 'qup';
	$data['answer'] = 'aup';
	$data['add_date'] = '2013-03-12';
	$where = 'id = 45';
	/*$result = $db->update($data, 'faq', $where);
	echo $result;*/

	//delete where 
	/*$where = 'id = 45';
	$result = $db->delete('faq',$where);
	echo $result;*/

?>