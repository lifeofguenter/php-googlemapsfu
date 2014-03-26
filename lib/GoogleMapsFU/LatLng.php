<?php
/**
 * GoogleMapsFU: LatLng
 * 
 * @project GoogleMapsFU
 * @author Günter Grodotzki <guenter@weheartwebsites.de>
 * @version 20140324
 * @see https://developers.google.com/maps/documentation/javascript/reference#LatLng
 */
namespace GoogleMapsFU
{	
	class LatLng
	{
		private $lat;
		private $lng;
		
		// to avoid the same computing, it might be smart to put this object
		// in some memory based cache...
		// @todo add sin/cos properties
		private $latRad;
		private $lngRad;
		
		/**
		 * Creates a LatLng object representing a geographic point. Latitude is
		 * specified in degrees within the range [-90, 90]. Longitude is
		 * specified in degrees within the range [-180, 180]. Set noWrap to true
		 * to enable values outside of this range. Note the ordering of
		 * latitude and longitude.
		 * @param float $lat
		 * @param float $lng
		 */
		public function __construct($lat, $lng, $noWrap = false)
		{
			$lat = (float) $lat;
			$lng = (float) $lng;
			
			if (!$noWrap)
			{
				if ($lat < -90)
				{
					$this->lat = -90;
				}
				elseif ($lat > 90)
				{
					$this->lat = 90;
				}
				else
				{
					$this->lat = $lat;
				}
				
				if ($lng < -180)
				{
					$this->lng = -180;
				}
				elseif ($lng > 180)
				{
					$this->lng = 180;
				}
				else
				{
					$this->lng = $lng;
				}
			}
			else
			{
				$this->lat = $lat;
				$this->lng = $lng;
			}
		}
		
		/**
		 * Comparison function.
		 * @param \GoogleMapsFU\LatLng $other
		 * @return boolean
		 */
		public function equals(\GoogleMapsFU\LatLng $other)
		{
			if ($this->lat() === $other->lat() && $this->lng() === $other->lng())
			{
				return true;
			}
			return false;
		}
		
		/**
		 * Returns the latitude in degrees.
		 * @return float
		 */
		public function lat($asRad = false)
		{
			if ($asRad)
			{
				if ($this->latRad === null)
				{
					$this->latRad = $this->lat * M_PI / 180;
				}
				
				return $this->latRad;
			}
			return $this->lat;
		}
		
		/**
		 * Returns the longitude in degrees.
		 * @return float
		 */
		public function lng($asRad = false)
		{
			if ($asRad)
			{
				if ($this->lngRad === null)
				{
					$this->lngRad = $this->lng * M_PI / 180;
				}
			
				return $this->lngRad;
			}
			return $this->lng;
		}
		
		/**
		 * Converts to string representation.
		 * @return string
		 */
		public function __toString()
		{
			// @see http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerwithlabel/1.1.8/examples/events.html
			return '(' . $this->lat() . ', ' . $this->lng() . ')'; 
		}
		
		/**
		 * Returns a string of the form "lat,lng" for this LatLng. We round the
		 * lat/lng values to 6 decimal places by default.
		 * @param number $precision
		 * @return string
		 */
		public function toUrlValue($precision = 6)
		{
			// @see https://groups.google.com/d/msg/google-maps-js-api-v3/_Ed0J50kmJg/0EnI-XF_P_EJ
			return round($this->lat(), $precision) . ',' . round($this->lng(), $precision);
		}
	}
}