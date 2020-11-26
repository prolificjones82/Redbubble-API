<?php
namespace Redbubble;

use Exception;

class Config
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $responseType;

    /**
     * @var array
     */
    protected $allowedResponseTypes = [
        'object',
        'array',
        'json'
    ];

    /**
     * @var bool
     */
    protected $prettyUrls;

    /**
     * @var bool
     */
    protected $cacheResponse;


    public function __construct($username, $responseType, $prettyUrls, $cacheResponse)
    {
        if (is_string($username) && strlen($username) > 0) {
            $this->setUsername($username);
        } else {
            throw new Exception('Redbubble API Error: ("$username" must be a string)', 400);
        }

        if (is_string($responseType)) {
            if (in_array($responseType, $this->allowedResponseTypes)) {
                $this->setResponseType($responseType);
            } else {
                throw new Exception('Redbubble API Error: ("$responseType" must be either: ' . implode(', ', $this->allowedResponseTypes) . ')', 400);
            }
        } else {
            throw new Exception('Redbubble API Error: ("$responseType" must be a string)', 400);
        }

        if (is_bool($prettyUrls)) {
            $this->setPrettyUrls($prettyUrls);
        } else {
            throw new Exception('Redbubble API Error: ("$prettyUrls" must be boolean)', 400);
        }

        if (is_bool($cacheResponse)) {
            $this->setUseCache($cacheResponse);
        } else {
            throw new Exception('Redbubble API Error: ("$cacheResponse" must be boolean)', 400);
        }
    }

    /**
     * Get the value of username
     *
     * @return  string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

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
    public function useCache()
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
    public function setUseCache(bool $cacheResponse)
    {
        $this->cacheResponse = $cacheResponse;

        return $this;
    }
}
