<?php

class Redbubble
{
	protected $rburl = 'http://www.redbubble.com';

	public function getRedbubbleUrl()	{ return $this->rburl; }

	public function __construct($rbuser, $type = false)
	{
		$this->rbuser = $rbuser;
		if ($type)
		{
			$this->response_type = $type; // JSON or XML
		}
	}

	public function getCollections()
	{
		$url = sprintf($this->getRedbubbleUrl() . "/people/%s/portfolio/", $this->rbuser);

		if ($xhtml = file_get_contents($url, FILE_SKIP_EMPTY_LINES))
		{
			$data 	= array();
			$errors	= array();

			$doc = new DOMDocument();
            if (!@$doc->loadHTML($xhtml))
			{
                $errors['errors'][] = 'PHP Config: allow_url_fopen required.';
            }
			
			if (count($errors) > 0)
			{
				return $errors;
			}
			else
			{
				$xpath = new DOMXpath($doc);
				$itemquery = "//a[contains(concat(' ',normalize-space(@class),' '), 'collection-link')]";
				$items = $xpath->query($itemquery);

				foreach ($items as $item)
				{
					$item_array = array();
					
					$pattern 		= "/people/" . $this->rbuser . "/collections/";
					$collection_id	= str_replace($pattern, "", $item->getAttribute('href'));

					$item_array['collection_id'] 	= $collection_id;
					$item_array['link']				= '?rbu=' . $this->rbuser . '&cID=' . $collection_id;
					
					$strip = array('background-image: url(', ');');
					$img = $item->getAttribute('style');
					$bgimg = str_replace($strip, '', $img);
					$item_array['image'] = $bgimg;
					
					if ($title = $item->getElementsByTagName('span'))
					{
						$item_array['title'] = trim($title->item(0)->nodeValue);
					}
					
					$data[] = $item_array;
				}
				
				return $data;
			}
		}
		else
		{
			$errors['errors'][] = '404: Page not found.';
		}
	}

	public function getProducts($collection_id)
	{
		
	}
}