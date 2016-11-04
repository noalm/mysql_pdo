<?php
class PdoMysql{

	private $db;
	private static $instance;
	private $dbConfig=array(

		'DB_TYPE'=>'mysql',//数据库类型
		'DB_HOST'=>'127.0.0.1',//服务器地址
		'DB_NAME'=>'test_forphp',//数据库名
		'DB_USER'=>'root',//用户名
		'DB_PWD'=>'',//密码
		'DB_PORT'=>'3306',//端口
		'DB_CHARSET'=>'utf8',//数据库编码默认采用utf8

	);
	//私有构造函数
	private function __construct(){

		$this->Connect();
		
	}

	//单例模式
	public static function getInstance(){
	
		if(!self::$instance instanceof self){
			self::$instance=new self();	
		}
			return self::$instance;

	}
	
	//私有克隆
	private function __clone(){

	}

	//连接数据库
	private function Connect(){
	
		try{
			$dsn="{$this->dbConfig['DB_TYPE']}:DB_HOST={$this->dbConfig['DB_HOST']};port={$this->dbConfig['DB_PORT']};dbname={$this->dbConfig['DB_NAME']};charset={$this->dbConfig['DB_CHARSET']}";
			$this->db=new PDO($dsn,$this->dbConfig['DB_USER'],$this->dbConfig['DB_PWD']);
			$this->db->query("set names {$this->dbConfig['DB_CHARSET']}");
			//$this->db=new mysqli($this->dbConfig['DB_HOST'],$this->dbConfig['DB_USER'],$this->dbConfig['DB_PWD'],$this->dbConfig['DB_NAME']);
			//echo "连接成功";
		}catch(PDOExecption $e){
		
			die("数据库连接失败:{$e->getMessage()}");
		}

	}
	//查询
	public function query($sql){
		$ret= $this->db->query($sql);
		$error=$this->db->errorInfo();
		if($ret==false){
			die("数据库操作失败ERROR:{$error[1]}");
		}
		return $ret;
	}
	//查询一条数据
	public function fetchRow($sql){
		$data=$this->query($sql)->fetch(PDO::FETCH_ASSOC);
		return $data;
	}
	//查询所有数据
	public function fetchAll($sql){
		$data=$this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}
}

//实例化类
//$db=PdoMysql::getInstance();

