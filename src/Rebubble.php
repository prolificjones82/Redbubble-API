<?php
namespace RedbubbleApi;

use RedbubbleApi\Config as RedbubbleConfig;
use RedbubbleApi\Cache as RedbubbleCache;

class Redbubble
{
    /**
     * @var string
     */
    protected $rbUrl = 'http://www.redbubble.com';

    /**
     * @var RedbubbleConfig
     */
    protected $config;

    /**
     * @var RedbubbleCache
     */
    protected $cache;

    /**
     * Get the value of rbUrl
     *
     * @return  string
     */
    public function getRbUrl()
    {
        return $this->rbUrl;
    }

    /**
     * Set the value of rbUrl
     *
     * @param  string  $rbUrl
     *
     * @return  self
     */
    public function setRbUrl(string $rbUrl)
    {
        $this->rbUrl = $rbUrl;

        return $this;
    }

    /**
     * Get the value of config
     *
     * @return  RedbubbleConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the value of config
     *
     * @param  RedbubbleConfig  $config
     *
     * @return  self
     */
    public function setConfig(RedbubbleConfig $config)
    {
        $this->config = $config;

        return $this;
    }
}
