<?php
/**
 * GoogleMapsFU: a server side implementation of the MarkerClusterer
 * 
 * @project GoogleMapsFU
 * @author Günter Grodotzki <guenter@weheartwebsites.de>
 * @version 20140325
 */
namespace GoogleMapsFU\MarkerClusterer
{
	class Clusterer implements \Iterator
	{
		private $gridSize = 60;
		private $maxZoom = 14;
		private $map;
		private $clusters = array();
		private $pos = 0;
		
		public function __construct($options = null)
		{
			if (!empty($options) && is_array($options))
			{
				if (isset($options['gridSize']))
				{
					$this->gridSize = (int) $options['gridSize'];
				}
				
				if (isset($options['maxZoom']))
				{
					$this->maxZoom = (int) $options['maxZoom'];
				}
				
				if (isset($options['map']) && $options['map'] instanceof \GoogleMapsFU\MapFU)
				{
					$this->map = $options['map'];
				}
			}
		}
		
		/**
		 * @param \GoogleMapsFU\Marker $marker
		 */
		public function addMarker(\GoogleMapsFU\Marker $marker)
		{
			if ($this->map->getZoom() <= $this->maxZoom)
			{
				$pos = $this->map->getProjection()->fromLatLngToDivPixel($marker->getPosition());
				$clustersLength = count($this->clusters);
				
				for ($i = $clustersLength - 1; $i >= 0; --$i)
				{
					$center = $this->clusters[$i]->getCenter();
					$center = $this->map->getProjection()->fromLatLngToDivPixel($center);
					
					if ($pos->x >= $center->x - $this->gridSize && $pos->x <= $center->x + $this->gridSize &&
						$pos->y >= $center->y - $this->gridSize && $pos->y <= $center->y + $this->gridSize)
					{
						$this->clusters[$i]->addMarker($marker);
						return;
					}
				}
			}
			
			$cluster = new \GoogleMapsFU\MarkerClusterer\Cluster;
			$cluster->addMarker($marker);
			$this->clusters[] = $cluster;
		}
		
		public function getClusters()
		{
			return $this->clusters;
		}
		
		public function current()
		{
			return $this->clusters[$this->pos];
		}
		
		public function key()
		{
			return $this->pos;
		}
		
		public function next()
		{
			++$this->pos;
		}
		
		public function rewind()
		{
			$this->pos = 0;
		}
		
		public function valid()
		{
			return isset($this->clusters[$this->pos]);
		}
	}
}