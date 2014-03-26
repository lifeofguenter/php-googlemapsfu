<?php
/**
 * GoogleMapsFU: Point representation...
 * 
 * @project GoogleMapsFU
 * @author Günter Grodotzki <guenter@weheartwebsites.de>
 * @version 20140324
 * @see https://developers.google.com/maps/documentation/javascript/reference#Point
 */
namespace GoogleMapsFU
{
	class Point
	{
		public $x;
		public $y;
		
		/**
		 * A point on a two-dimensional plane.
		 * @param float $x
		 * @param float $y
		 */
		public function __construct($x, $y)
		{
			$this->x = (float) $x;
			$this->y = (float) $y;
		}
		
		/**
		 * Compares two Points
		 * @param \GoogleMapsFU\Point $point
		 * @return boolean
		 */
		public function equals(\GoogleMapsFU\Point $other)
		{
			if ($this->x === $other->x && $this->y === $other->y)
			{
				return true;
			}
			return false;
		}
		
		/**
		 * Returns a string representation of this Point.
		 * @return string
		 */
		public function __toString()
		{
			return '(' . $this->x . ', ' . $this->y . ')';
		}
	}
}