<?php

namespace Penelope;

/**
 * A pretty Object class.
 */
class Object {

	/**
	 * Contains the primitive
	 * 
	 * @var mixed 
	 */
	protected $value;
	
	/**
	 * Constructor
	 * 
	 * @param mixed $value 
	 */
	public function __construct($value) {
		$this->value = $value;
	}

	/**
	 * Boxes a primitive to an object.
	 * 
	 * @param mixed $arg
	 * @return static 
	 */
	public static function box($arg) {
		return new static($arg);
	}
	
	/**
	 * Returns the primitive again.
	 * 
	 * @return mixed 
	 */
	public function unbox() {
		return $this->value;
	}
	
	/**
	 * Returns a string representation of the primitive inside this
	 * object instance.
	 * 
	 * @return string 
	 */
	public function __toString() {
		return strval($this->value);
	}

}
