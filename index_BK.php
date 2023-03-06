<?php
ini_set('log_errors','On');//ログを取る設定
ini_set('error_log','php.log');//ログの出力場所
session_start();//セッションを使う

//ポケモン(対戦相手)格納用
$enemy = array();

//ポケモン(対戦相手)格納用
$player = array();

//戦うポケモンのクラス
class pokemon{
	public $name;
	public $maxHp;
	public $hp;
	public $attackMin;
	public $attackMax;
	public $attribateType;
	public $attribateAttack;
	public $img;

	public function __construct($name,$maxHp,$hp,$attackMin,$attackMax,$attribateType,$attribateAttack,$img){
		$this->name = $name;
		$this->maxHp = $maxHp;
		$this->hp = $hp;
		$this->attackMin = $attackMin;
		$this->attackMax = $attackMax;
		$this->attribateType = $attribateType;
		$this->attribateAttack = $attribateAttack;
		$this->img = $img;
	}

	public function getName(){
		return $this->name;
	}

}

//playerのポケモンのクラス
class MyPokemon extends pokemon{
	public function __construct($name,$maxHp,$hp,$attackMin,$attackMax,$attribateType,$attribateAttack,$img){
		parent::__construct($name,$maxHp,$hp,$attackMin,$attackMax,$attribateType,$attribateAttack,$img);
	}
}


//履歴クラス
class History{
	public static function set($str){
		//セッションhistoryがなければ作成する
		if(empty($_SESSION['history'])) $_SESSION['history'];

		//セッションhistoryに格納
		$_SESSION['history'] = $str;
	}
	public static function clear(){
		unset($_SESSION['history']);
	}
}

//インスタンス作成(敵)
$enemy[] = new pokemon('イシツブテ',100,100,20,30,'いわ',35,'img/isitubute.jpeg');
$enemy[] = new pokemon('コイキング',50,50,0,0,'みず',20,'img/koikinngu.jpeg');

//インスタンス作成(player)
$player[] = new MyPokemon('ピカチュウ',60,60,20,40,'でんき',35,'img/pikatyu.jpeg');
$player[] = new MyPokemon('ヒトカゲ',70,70,30,50,'ほのお',35,'img/hitokage.jpeg');

function createPokemon(){
	global $enemy;
	$enemy = $enemy[mt_rand(0,1)];
	History::set($enemy->getName().'が現れた!');
	$_SESSION['pokemon'] = $enemy;
}

function createMyPokemon($num){
	global $player;
	$player = $player[$num];
	History::set($player->getName().'が相棒だ!');
}

function init(){
	History::clear();
	History::set('初期化します!');
	createPokemon();

}

function gameOver(){
	$_SESSION = array();

}



//post送信されていた場合
if(!empty($_POST)){
	$startFlg = (!empty($_POST['start'])) ? true : false;
	$pikaFlg  = (!empty($_POST['pika'])) ? true : false; //ピカチュウを選択したかどうか
	$hitoFlg  = (!empty($_POST['hito'])) ? true : false; //ヒトカゲを選択したかどうか
	if($startFlg){
		History::set('ゲームスタート!!');
		init();
	}else if($pikaFlg){
		createMyPokemon(0);
	}else{
		createMyPokemon(1);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ポケモンスタジアム</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if(empty($_SESSION)){?>
		    <div class="button-container">
			      <form method>
				        <input type="submit" name="start" class="start" value="▶︎ゲームスタート">
			      </form>
	      </div>
    <?php }else{?>
		<div class="button-container">
			    <form method>
				      <input type="submit" name="pika" class="start" value="▶︎ピカチュウ">
				      <input type="submit" name="hito" class="start" value="▶︎ヒトカゲ">
			    </form>

		</div>
    <?php }?>
</body>
</html>
