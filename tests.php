<?php


require_once('Penelope.php');

use Penelope\Object;
use Penelope\Boolean;
use Penelope\Collection;
use Penelope\String;
use Penelope\Number;




$c = 0;


function printtext($text) { echo $text; }

function asrt( $a, $b ) {
	if ($a === $b) {
		global $tests;
		$tests++;
		print( "[".$tests."]" );
	}
	else {
		printtext("FAILED TEST: EXPECTED $b BUT GOT: $a ");
		fail();
	}
}

function pass() {
	global $tests;
	$tests++;
	print( "[".$tests."]" );
}

function fail() {
	printtext("FAILED TEST");
	debug_print_backtrace();
	exit;
}

function clean($s) {
	return preg_replace("/\s/m","",$s);
}


function testpack($name) {
	printtext("\ntesting: ".$name);
}


testpack('Booleans');

$a = 'no';
Boolean::box((3 > 2))->ifTrue(function()use(&$a){ $a = 'yes'; });
asrt($a,'yes');
Boolean::box((2 > 3))->ifFalse(function()use(&$a){ $a = 'no'; });
asrt($a,'no');



testpack('Numbers');

$str='';
Number::box(10)->times(function($i)use(&$str){
	$str .= $i; 
});
asrt($str,'0123456789');




testpack('Strings');

$collection = String::box('a,b,c')->explode(',');
asrt(count($collection),3);





testpack('Collections');

$collection = Collection::box(array(
	'path'=>array(
		'to'=>array(
			'treasure'=>'here'
		)
	)
));

asrt($collection->get('path.to.treasure'),'here');
asrt($collection->get('path.to.forest','there'),'there');
$str = '';


Collection::box(array('a','b','c'))->each(function($k,$v)use(&$str){
	$str .= $v;
});
asrt($str,'abc');

$str='';
$collection->each(function($k)use(&$str){
	$str .= $k;
});
asrt($str,'treasure');

$str = '';
Collection::box(array('nested'=>array(
	'a','b',array('c'),array(array('d',array(array('e'))),'f'),'g'
)))->each(function($k,$v)use(&$str){ $str .= $v; });
asrt($str,'abcdefg');

$collection = new Collection();
$collection->push('hello')->push('world');
asrt($collection->getPop(),'world');
$collection = new Collection();
$collection->push('hello')->push('world');
asrt($collection->getShift(),'hello');
asrt($collection->getShift(),'world');

