<?php

namespace Penelope;

/**
 * A pretty and powerful Collection class.
 */
class Collection extends Object implements \IteratorAggregate,\countable {

	
	/**
	 * Constructor
	 * 
	 * @param array $value 
	 */
	public function __construct($value = array()) {
		if (!is_array($value)) {
			throw new \InvalidArgumentException('Expected array.');
		}
		parent::__construct($value);
	}
	
	/**
	 * Allows you to foreach over the contents of the object.
	 * 
	 * @return ArrayIterator 
	 */
	public function getIterator() {
		return new ArrayIterator( $this->value );
	}

	/**
	 * Implodes the array and returns a String object.
	 * 
	 * @param string $glue
	 * @return String 
	 */
	public function implode($glue) {
		return new String( implode($glue,$this->value) );
	}
	

	/**
	 * Gets part of the array using a path notation (dot notation) or
	 * returns the default value if the entry cannot be found.
	 * 
	 * Example:
	 * 
	 * Collection::box(array(
	 *		'path'=>array(
	 *			'to'=>array(
	 *				'treasure'=>'here'
	 *			)
	 *		)
	 *	))
	 * ->get('path.to.treasure');
	 * 
	 * @param string $path
	 * @param mixed $def
	 * @return mixed 
	 */
	public function get($path, $def = null) {
		$p = explode('.',$path);
		$a = $this->value;
		while($k = array_shift($p)) {
			if (!is_array($a)) return $def; 
			elseif(!isset($a[$k])) return $def;
			else $a = $a[$k];
		}
		return $a;
	}

	/**
	 * Executes $func for each entry in the collection.
	 * 
	 * @param closure $func
	 * @return Collection 
	 */
	public function each($func) {
		$i=0;
		foreach($this->value as $k=>$v) {
			if (is_array($v)) {
				$a = new static($v);
				$a->each($func);
			}
			else {
				$func($k,$v,$i++);
			}
		}
		return $this;
	}

	/**
	 * Returns the size of the array as a Number object.
	 * 
	 * @return Number 
	 */
	public function getSize() {
		return Number::box(count($this->value));
	}

	/**
	 * Allows you to count the number of elements in the array using
	 * count().
	 * 
	 * @return integer 
	 */
	public function count(){ return count($this->value); }

	
	/**
	 * Allows you to use all array functions as methods.
	 * 
	 * @param string $method
	 * @param array $arguments 
	 */
	public function __call($method,$arguments) {
		$chain = true;
		if (strpos($method,'get')===0) {
			$chain = false;
			$method = strtolower(substr($method,3));
		}
		if (!is_callable($method)) {
			$method = 'array_'.strtolower(preg_replace('/[A-Z]/','_$1',$method));
		}
		if (!is_callable($method)) {
			throw new \Exception('Uncallable method:'.$method);
		}
		array_unshift($arguments, &$this->value);
		$ret = call_user_func_array($method, $arguments);
		return ($chain) ? $this : $ret;
	}
	
	
}

