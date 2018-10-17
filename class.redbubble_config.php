<?php

/**
* Redbubble Config
*   
* @author      Lee Jones <mail@leejones.me.uk>
* @copyright   October 2018
*/
class RedbubbleConfig 
{
    protected $rbuser;
    protected $response_type;
    protected $pretty_urls;
    protected $cache_responses;

    public function getRedbubbleUser()
    {
        return $this->rbuser;
    }

    public function getResponseType()
    {
        return $this->response_type;
    }

    public function prettyUrls()
    {
        return $this->pretty_urls;
    }

    public function cacheResponses()
    {
        return $this->cache_responses;
    }

    public function __construct($username, $response_type = 'object', $pretty_urls = false, $cache_responses = true)
    {
        $this->rbuser           = $username;
        $this->response_type    = $response_type;
        $this->pretty_urls      = $pretty_urls;
        $this->cache_responses  = $cache_responses;
    }
}