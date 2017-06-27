<?php

require 'html_dom_parser.php';

class Redbubble
{
	protected $rburl = 'http://www.redbubble.com';

	public function getRedbubbleUrl()	{ return $this->rburl; }

	public function __construct($rbuser, $pretty_urls = false, $type = 'array')
	{
		$this->rbuser = $rbuser;
		$this->pretty_urls = $pretty_urls;
		$this->response_type = $type; // array, object, or json
	}
	
	private function generateCollectionLink($collection_id)
	{
		if ($this->pretty_urls)
		{
			$url = '/' .  $this->rbuser . '/' . $collection_id . '/';
		}
		else
		{
			$url = '?rbu=' . $this->rbuser . '&cID=' . $collection_id;
		}
		return $url;
	}

	public function getCollections()
	{
		$url = sprintf($this->getRedbubbleUrl() . "/people/%s/portfolio/", $this->rbuser);
		$html = file_get_html($url);
		$collection_elements = $html->find('a[class=collection-link]');
		
		$data = array();
		
		foreach ($collection_elements as $element)
		{
			$item_array = array();
			
			// get collection id
			$collection_id = str_replace('/people/' . $this->rbuser . '/collections/', '', $element->href);
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
		if ($this->response_type === 'object')
		{
			$data = (object)$data;
		}
		else if ($this->response_type === 'json')
		{
			$data = json_encode($data);
		}
		
		return $data;
	}
	
	public function getProducts($collection_id)
	{
		$url = sprintf($this->getRedbubbleUrl() . "/people/%s/collections/%s", $this->rbuser, $collection_id);
		$html = file_get_html($url);
		$products = $html->find('a[class=grid-item]');
		
		$data = array();
		
		foreach ($products as $product)
		{
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
			foreach ($pricing as $price_element)
			{
				$pricing_array[] = $price_element->innertext;
			}
			
			$item_array['price'] = implode('', $pricing_array);
			
			$data[] = $item_array;
		}
		
		if ($this->response_type === 'object')
		{
			$data = (object)$data;
		}
		else if ($this->response_type === 'json')
		{
			$data = json_encode($data);
		}
		
		return $data;
	}
}







