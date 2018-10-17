<?php

class RedbubbleCache
{
    protected $cache_path   = '/cache/';
    protected $duration     = 60;

    public function getPath()
    {
        return dirname(__FILE__) . $this->cache_path;
    }

    public function getDuration()
    {
        return $this->duration;
    }
}