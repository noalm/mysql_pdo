<?php
include"pdomysql.php";
class FetchData{
	public function index(){
		$db=PdoMysql::getInstance();
		$sql="select * from info";
		$data=$db->fetchAll($sql);
		return $data;
		//echo '<pre>';
		//var_dump($data);
	}
}

//实例化类
$FetchData=new FetchData();
$data=$FetchData->index();
echo '<pre>';
var_dump($data);