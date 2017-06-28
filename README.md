# Redbubble-API Scraper

A homebrew API style page scraper designed to put your Redbubble products on your webpage. It allows you to pull a users collections and images inside the collections. The API terminates at the point of selecting an individual item, this will send you to the Redbubble website page for that item.

### Websites Using the API:
http://timtopping.com (v2)

## Quick Use
Upload the ```redbubble``` folder to your server.

Include the file in your page ```require "redbubble/redbubble.php";```

Initiante the class with your Redbubble username:

```php
$redbubble = new Redbubble('username');
```

There are now two functions you can use, ```getCollections()``` and ```getProducts($collection_id)```. 

The ```getProducts()``` function requires a ```$collection_id``` as a parameter this is returned as part of the ```GetCollections()``` function.

## Pretty URLS

By default the functions return links as query strings using ```rbu``` and ```cID``` as query parameters. By setting the ```$pretty_urls``` variable to ```true``` when the Redbubble class is initiated these will be rewritten in ```/rbu/cID/``` format, you will need to modify your ```htaccess``` file to compensate.

## Response Types

Returned responses are a simple PHP ```array``` by default, however a third option in the class is to specify the returned data type.

Options are ```array```, ```object```, ```json```

## Change Log

- [27/06/2017] - *v3* switched to a class based system, also using the ```html_dom_parser.php``` script to obtain the page heirarchy.
- [15/01/2013] - API COLLECTIONS - removed input form. Get data should be passed by some other method for a better user experience.
- [04/02/2013] - REMOVED V1 API - removed version 1 of the API, the full collections API is far more versatile and can be adapted to needs.


## Licence

Copyright (c) 2012 Lee Jones, Licensed under GNU Lesser General Public License.
