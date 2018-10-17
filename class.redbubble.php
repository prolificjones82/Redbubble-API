<?php

/**
 * Redbubble - Homebrew Redbubble API
 * NOTE: Requires PHP version 5 or later
 * @package Redbubble
 * @author Lee Jones
 * @copyright 2012 Lee Jones
 * @version v3.1
 * @license MIT
 */

require_once('libs/html_dom_parser.php');
require_once('class.redbubble_config.php');
require_once('class.redbubble_cache.php');
class Redbubble
{
	protected $rburl 	= 'http://www.redbubble.com';
	protected $config;

	public function getRedbubbleUrl()	{
		return $this->rburl;
	}

	public function getConfig()	{
		return $this->config;
	}

	public function getCache()	{
		return new RedbubbleCache();
	}

	public function __construct($config)
	{
		$this->config = $config;
	}
	
	private function generateCollectionLink($collection_id)
	{
		if ($this->getConfig()->prettyUrls()) {
			$url = '/' .  $this->getConfig()->getRedbubbleUser() . '/' . $collection_id . '/';
		} else {
			$url = '?rbu=' . $this->getConfig()->getRedbubbleUser() . '&cID=' . $collection_id;
		}

		return $url;
	}

	private function convertResponseType($data)
	{
		switch ($this->getConfig()->getResponseType())
		{
			case 'json':
				$new_data = json_encode($data);
				break;
			case 'object':
			default:
				$new_data = (object) $data;
				break;
		}

		return $new_data;
	}

	public function getCollections()
	{
		if ($this->getConfig()->cacheResponses()) {
			$data = $this->getCache()->getCacheObject($this->getConfig()->getRedbubbleUser());
		}

		if (!$data) {
			$url = sprintf($this->getRedbubbleUrl() . "/people/%s/portfolio/", $this->getConfig()->getRedbubbleUser());
			$html = file_get_html($url);
			$collection_elements = $html->find('a[class=collection-link]');
			
			$data = array();
			
			foreach ($collection_elements as $element) {
				$item_array = array();
				
				// get collection id
				$collection_id = str_replace('/people/' . $this->getConfig()->getRedbubbleUser() . '/collections/', '', $element->href);
				$item_array['collection_id'] = $collection_id;
				
				// get collection image
				$pattern = array('background-image: url(',');');
				$item_array['image'] = str_replace($pattern, '', $element->style);
				
				// get collection title
				$spans = $element->find('span span[class=pc-title-background]');
				$item_array['title'] = $spans[0]->innertext;
				
				$item_array['url'] = $this->generateCollectionLink($collection_id);
				
				$data[] = (object) $item_array;
			}

			if ($this->getConfig()->cacheResponses()) {
				$cache = $this->getCache()->setCacheObject($this->getConfig()->getRedbubbleUser(), $data);

				if (!$cache) {
					return $cache;
				}
			}
			
		}

		return $this->convertResponseType($data);
	}
	
	public function getProducts($collection_id)
	{
		if ($this->getConfig()->cacheResponses()) {
			$data = $this->getCache()->getCacheObject($this->getConfig()->getRedbubbleUser() . '-' . $collection_id);
		}

		if (!$data) {
			$url = sprintf($this->getRedbubbleUrl() . "/people/%s/collections/%s", $this->getConfig()->getRedbubbleUser(), $collection_id);
			$html = file_get_html($url);
			$products = $html->find('a[class=grid-item]');
			
			$data = array();
			
			foreach ($products as $product) {
				$item_array = array();
				
				// get product link
				$item_array['link'] = $this->getRedbubbleUrl() . $product->href;
				
				// get product design image
				$pattern = array('background-image: url(',');');
				$item_array['design_image'] = str_replace($pattern, '', $product->style);
				
				// get product image
				$img_tag = $product->find('img[class=design]');
				$item_array['product_image'] = $img_tag[0]->src;
				
				// get product title
				$item_array['title'] = $product->title;
				
				$pricing = $product->find('div span span[class=price] span');
				
				$pricing_array = array();
				foreach ($pricing as $price_element) {
					$pricing_array[] = $price_element->innertext;
				}
				
				$item_array['price'] = implode('', $pricing_array);
				
				$data[] = (object) $item_array;
			}

			if ($this->getConfig()->cacheResponses()) {
				$cache = $this->getCache()->setCacheObject($this->getConfig()->getRedbubbleUser() . '-' . $collection_id, $data);

				if (!$cache) {
					return $cache;
				}
			}
		}
		
		return $this->convertResponseType($data);
	}
}







