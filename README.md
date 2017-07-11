# Redbubble-API Scraper

A homebrew API style page scraper designed to put your Redbubble products on your webpage. It allows you to pull a users collections and images inside the collections. The API terminates at the point of selecting an individual item, this will send you to the Redbubble website page for that item.

### Websites Using the API:
http://timtopping.com (v2)

## Quick Use
Upload the ```redbubble``` folder to your server.

Include the file in your page ```require "redbubble/redbubble.php";```

Initiante the class with your Redbubble username:

```php
$redbubble = new Redbubble('username', false, 'array');
```

There are now two functions you can use, ```getCollections()``` and ```getProducts($collection_id)```. 

The ```getProducts()``` function requires a ```$collection_id``` as a parameter this is returned as part of the ```GetCollections()``` function.

## Pretty URLS

By default the functions return links as query strings using ```rbu``` and ```cID``` as query parameters. By setting the ```$pretty_urls``` variable to ```true``` when the Redbubble class is initiated these will be rewritten in ```/rbu/cID/``` format, you will need to modify your ```htaccess``` file to compensate.

## Response Types

Returned responses are a simple PHP ```array``` by default, however a third option in the class is to specify the returned data type.

Options are ```array```, ```object```, ```json```

## Example

To view a brief example of how you could structure your code take a look at ```index.php``` in the repository.

## Available Functions

| Name             | Parameters           | Description                                                                                  |
|------------------|----------------------|----------------------------------------------------------------------------------------------|
| getCollections() | none                 | Retrieves a list of all collections belonging to the current ```rbuser```                    |
| getProducts()    | ```$collection_id``` | Retrieves a list of products from a particular collection, ```$collection_id``` is required. |

## Options

These options need to be set when the class is intantated with ```new Redbubble()```.

| Name                | Type    | Default       | Description                                                                                                     |
|---------------------|---------|---------------|-----------------------------------------------------------------------------------------------------------------|
| ```rbuser```        | String  | ```null```    | This is **required** allows the class to scrape your Redbubble page.                                              |
| ```pretty_urls```   | Boolean | ```false```   | For SEO purposes you may wish to use pretty URLS, set this to ```true``` and ensure to edit your htaccess file. |
| ```response_type``` | String  | ```array```   | Defines response type, possible values are ```array```, ```object``` and ```json```                             |

## Licence

Built and maintained by Lee Jones <mail@leejones.me.uk> MIT License
