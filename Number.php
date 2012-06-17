<?php

namespace Penelope;

/**
 * Number
 * A pretty number class
 */
class Number extends Object {
	
	
	/**
	 * Use for for-loops.
	 * 
	 * Example:
	 * 
	 * Number::box($n)->times(function(){
	 *    ...
	 * });
	 * 
	 * performs $func X times, where X equals
	 * the value of the number instance.
	 * 
	 * @param closure $func
	 * @return Number 
	 */
	public function times($func) {
		for($i=0; $i<$this->value; $i++) $func($i);
		return $this;
	}


	
}
