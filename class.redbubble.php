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
class Redbubble
{
	protected $rburl = 'http://www.redbubble.com';
	protected $config;

	public function getRedbubbleUrl()	{
		return $this->rburl;
	}

	public function getConfig()	{
		return $this->config;
	}

	public function __construct($config)
	{
		$this->config = $config;
	}
	
	private function generateCollectionLink($collection_id)
	{
		if ($this->pretty_urls) {
			$url = '/' .  $this->getConfig()->getRedbubbleUser() . '/' . $collection_id . '/';
		} else {
			$url = '?rbu=' . $this->getConfig()->getRedbubbleUser() . '&cID=' . $collection_id;
		}

		return $url;
	}

	public function getCollections()
	{
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
			
			$data[] = $item_array;
		}
		
		// conversion options
		if ($this->response_type === 'object') {
			$data = (object)$data;
		} else if ($this->response_type === 'json') {
			$data = json_encode($data);
		}
		
		return $data;
	}
	
	public function getProducts($collection_id)
	{
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
			
			$data[] = $item_array;
		}
		
		if ($this->response_type === 'object') {
			$data = (object)$data;
		} else if ($this->response_type === 'json') {
			$data = json_encode($data);
		}
		
		return $data;
	}
}







