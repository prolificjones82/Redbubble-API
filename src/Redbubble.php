<?php
namespace Redbubble;

use Redbubble\Config;
use Redbubble\Cache;

class Redbubble
{
    /**
     * @var string
     */
    protected $baseUrl = 'http://www.redbubble.com';

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Cache
     */
    protected $cache;

   /**
     * Get the value of baseUrl
     *
     * @return  string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set the value of baseUrl
     *
     * @param  string  $baseUrl
     *
     * @return  self
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Get the value of config
     *
     * @return  Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the value of config
     *
     * @param  Config  $config
     *
     * @return  self
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;

        return $this;
    }
}
