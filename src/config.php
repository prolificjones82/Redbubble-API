<?php
namespace RedbubbleApi;

use RedbubbleApi\Cache as RedbubbleCache;

/**
 * Redbubble Config
 *
 * @author Lee Jones <mail@leejones.me.uk>
 * @copyright November 2020
 */
class Config
{
    /**
     *@var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $responseType;

    /**
     * @var bool
     */
    protected $prettyUrls;

    /**
     * @var RedbubbleCache
     */
    protected $cache;

    /**
     * Init Class
     *
     * @param string    $user
     * @param string    $responseType
     * @param bool      $prettyUrls
     * @param bool      $cacheResponse
     * @param string    $cachePath
     *
     * @return void
     */
    public function __construct(
        $user,
        $responseType = 'object',
        $prettyUrls = false,
        $useCache = true,
        $cachePath = '',
        $cacheExpiry = 172800
    ) {
        $this->setUser($user);
        $this->setResponseType($responseType);
        $this->setPrettyUrls($prettyUrls);
        $this->setCacheResponse($cacheResponse);
        $this->setCachePath($cachePath);

        // if ($useCache) {
        //     $cache = new RedbubbleCache($cachePath, $cacheExpiry);
        //     $this->setCache($cache);
        // } else {
        //     $this->setCache(null);
        // }
    }

    /**
     * Get *@var string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set *@var string
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of responseType
     *
     * @return  string
     */
    public function getResponseType()
    {
        return $this->responseType;
    }

    /**
     * Set the value of responseType
     *
     * @param  string  $responseType
     *
     * @return  self
     */
    public function setResponseType(string $responseType)
    {
        $this->responseType = $responseType;

        return $this;
    }

    /**
     * Get the value of prettyUrls
     *
     * @return  bool
     */
    public function getPrettyUrls()
    {
        return $this->prettyUrls;
    }

    /**
     * Set the value of prettyUrls
     *
     * @param  bool  $prettyUrls
     *
     * @return  self
     */
    public function setPrettyUrls(bool $prettyUrls)
    {
        $this->prettyUrls = $prettyUrls;

        return $this;
    }

    /**
     * Get the value of cache
     *
     * @return  RedbubbleCache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Set the value of cache
     *
     * @param  RedbubbleCache  $cache
     *
     * @return  self
     */
    public function setCache(RedbubbleCache $cache)
    {
        $this->cache = $cache;

        return $this;
    }
}
