<?php

namespace Penelope;

/**
 * Pretty String Object
 */
class String extends Object {

	/**
	 * Constructor
	 * 
	 * @param type $value 
	 */
	public function __construct($value) {
		parent::__construct(strval($value));
	}
	
	/**
	 * Loads a string from file
	 * 
	 * @param string $file
	 * @return String 
	 */
	public static function fromFile($file) {
		$this->value = file_get_contents($file);
		return $this;
	}
	
	/**
	 * Explodes a string to a Collection object.
	 * 
	 * @param string $sep
	 * @return Collection 
	 */
	public function explode($sep) {
		return new Collection( explode($sep,$this->value) );
	}
	

}