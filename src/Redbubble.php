<?php
/**
 * Redbubble - Homebrew Redbubble API
 * NOTE: Requires PHP version 5 or later
 * @package Redbubble
 * @author Lee Jones
 * @copyright 2020 Lee Jones
 * @version v4.0
 * @license MIT
 */

namespace Redbubble;

use Redbubble\Config;
use Redbubble\Cache;

require_once(__DIR__ . '/libs/html_dom_parser.php');

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
     *
     */
    public function __construct($username, $responseType = 'object', $prettyUrls = false, $cacheResponse = false)
    {
        $config = new Config($username, $responseType, $prettyUrls, $cacheResponse);
        $cache  = new Cache();

        $this->setConfig($config);
        $this->setCache($cache);
    }

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

    /**
     * Get the value of cache
     *
     * @return  Cache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Set the value of cache
     *
     * @param  Cache  $cache
     *
     * @return  self
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     *
     */
    public function getCollections()
    {
        $url = sprintf('%s/people/%s/portfolio/', $this->getBaseUrl(), $this->getConfig()->getUsername());
        $html = file_get_html($url);
        $collectionElements = $html->find('a[class=collection-link]');
        print_r($collectionElements);
    }
}
