<?php

class RedbubbleCache
{
    protected $cache_path   = '/cache/';
    protected $duration     = 7200; // two hours

    public function getPath()
    {
        return dirname(__FILE__) . $this->cache_path;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getCacheObject($name)
    {
        $file = $this->getPath() . $name . '.cache';

		if (file_exists($file) && time() - filemtime($file) < $this->getDuration()) {
            $file_contents = file_get_contents($file);

            if (strlen($file_contents) > 0) {
                return unserialize($file_contents);
            } else {
                return false;
            }

		}
        
        return false;
    }

    public function setCacheObject($name, $array)
    {
        $file = $this->getPath() . $name . '.cache';
		file_put_contents($file, serialize($array));
    }
}