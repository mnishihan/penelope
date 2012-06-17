<?php

namespace Penelope;

/**
 * Boolean
 * Allows you to do things like:
 * 
 * Bool::box(($value > 3))->ifTrue(function(){
 *	 ... 
 * });
 */
class Boolean extends Object {
	
	/**
	 * Executes $func() closure if value is TRUE
	 * 
	 * @param closure $func
	 * @return Boolean 
	 */
	public function ifTrue( $func ) {
		if ($this->value) $func();
		return $this;	
	}	

	/**
	 * Executes $func() closure if value is FALSE
	 * 
	 * @param closure $func
	 * @return Boolean 
	 */
	public function ifFalse( $func ) {
		if (!$this->value) $func();
		return $this;
	}
	
	

}