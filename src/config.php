<?php
namespace RedbubbleApi;

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
     * @var bool
     */
    protected $cacheResponse;

    /**
     * @var string
     */
    protected $cachePath;

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
    public function __construct($user, $responseType = 'object', $prettyUrls = false, $cacheResponse = false, $cachePath = '')
    {
        $this->setUser($user);
        $this->setResponseType($responseType);
        $this->setPrettyUrls($prettyUrls);
        $this->setCacheResponse($cacheResponse);
        $this->setCachePath($cachePath);
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
     * Get the value of cacheResponse
     *
     * @return  bool
     */
    public function getCacheResponse()
    {
        return $this->cacheResponse;
    }

    /**
     * Set the value of cacheResponse
     *
     * @param  bool  $cacheResponse
     *
     * @return  self
     */
    public function setCacheResponse(bool $cacheResponse)
    {
        $this->cacheResponse = $cacheResponse;

        return $this;
    }

    /**
     * Get the value of cachePath
     *
     * @return  string
     */
    public function getCachePath()
    {
        return $this->cachePath;
    }

    /**
     * Set the value of cachePath
     *
     * @param  string  $cachePath
     *
     * @return  self
     */
    public function setCachePath(string $cachePath)
    {
        $this->cachePath = $cachePath;

        return $this;
    }
}
