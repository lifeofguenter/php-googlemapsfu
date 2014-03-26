<?php
/**
 * GoogleMapsFU: LatLngBounds represents a ne/sw boundary box
 * 
 * @project GoogleMapsFU
 * @author Günter Grodotzki <guenter@weheartwebsites.de>
 * @version 20140324
 * @see https://developers.google.com/maps/documentation/javascript/reference#LatLngBounds
 */
namespace GoogleMapsFU
{
	class LatLngBounds
	{
		private $sw;
		private $ne;
		
		/**
		 * Constructs a rectangle from the points at its south-west and north-east corners.
		 * @param \GoogleMapsFU\LatLng $sw (optional)
		 * @param \GoogleMapsFU\LatLng $ne (optional)
		 */
		public function __construct($sw = null, $ne = null)
		{
			if ($sw instanceof \GoogleMapsFU\LatLng)
			{
				$this->sw = $sw;
			}
			
			if ($ne instanceof \GoogleMapsFU\LatLng)
			{
				$this->ne = $ne;
			}
		}
		
		/**
		 * Returns true if the given lat/lng is in this bounds.
		 * @see http://stackoverflow.com/a/10940116/567193
		 * @param \GoogleMapsFU\LatLng $latLng
		 * @return boolean
		 */
		public function contains(\GoogleMapsFU\LatLng $latLng)
		{
			$eastBound = $latLng->lng() < $this->ne->lng();
			$westBound = $latLng->lng() > $this->sw->lng();
			
			if ($this->ne->lng() < $this->sw->lng())
			{
				$inLng = $eastBound || $westBound;
			}
			else
			{
				$inLng = $eastBound && $westBound;
			}
			
			$inLat = $latLng->lat() > $this->sw->lat() && $latLng->lat() < $this->ne->lat();
			return $inLat && $inLng;
		}
		
		public function equals(\GoogleMapsFU\LatLngBounds $other)
		{
			// @todo
		}
		
		public function extend(\GoogleMapsFU\LatLng $point)
		{
			// @todo
		}
		
		public function getCenter()
		{
			// @todo
		}
		
		/**
		 * Returns the north-east corner of this bounds.
		 * @return \GoogleMapsFU\LatLng
		 */
		public function getNorthEast()
		{
			return $this->ne;
		}
		
		/**
		 * Returns the south-west corner of this bounds.
		 * @return \GoogleMapsFU\LatLng
		 */
		public function getSouthWest()
		{
			return $this->sw;
		}
		
		public function intersects(\GoogleMapsFU\LatLngBounds $other)
		{
			// @todo
		}
		
		public function isEmpty()
		{
			// @todo
		}
		
		public function toSpan()
		{
			// @todo
		}
		
		/**
		 * Converts to string.
		 * @return string
		 */
		public function __toString()
		{
			return '((' . $this->sw->lat() . ', ' . $this->sw->lng() . '), (' . $this->ne->lat() . ', ' . $this->ne->lng() . '))';
		}
		
		public function toUrlValue($precision = 6)
		{
			// @todo
		}
		
		public function union(\GoogleMapsFU\LatLngBounds $other)
		{
			// @todo
		}
	}
}