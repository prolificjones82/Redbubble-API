# Redbubble-API Scraper

Supports PHP Version: >= ```7.1.3```

A homebrew API style page scraper designed to put your Redbubble products on your webpage. It allows you to pull a users collections and images inside the collections. The API terminates at the point of selecting an individual item, this will send you to the Redbubble website page for that item.

## Quick Use
Upload the ```redbubble``` folder to your server.

Include the file in your page ```require_once("class.redbubble.php");```

Use the `RedbubbleConfig` object to create your settings:

```php
$config = new RedbubbleConfig('username', 'object', false, true);
```

You can then instantiate the `Redbubble` class using this config object:

```php
$connection = new Redbubble($config);
```

There are now two functions you can use, ```getCollections()``` and ```getProducts($collection_id)```.

The ```getProducts()``` function requires a ```$collection_id``` as a parameter this is returned as part of the ```GetCollections()``` function.

## Response Types

Returned responses are a simple PHP ```object``` by default, however an option in the class is to specify the returned data type.

Options are ```object```, ```json```

## Pretty URLS

By default the functions return links as query strings using ```rbu``` and ```cID``` as query parameters. By setting the ```$pretty_urls``` variable to ```true``` when the Redbubble class is initiated these will be rewritten in ```/rbu/cID/``` format, you will need to modify your ```htaccess``` file to compensate.

Example:

```
RewriteEngine On
RewriteRule ^([^/]*)/([^/]*)/$ /?rbu=$1&cID=$2 [L]
```

## Caching Responses

By default response caching is turned on. As this is an unofficial Redbubble API connection the calls can take quite a long time, with this in mind responses are cached for _**two days**_ by default, this value can be edited in `class.redbubble_config.php`.

Responses are cached to a folder in called `redbubble_cache` which will require folder permissions of `777`.

## Example

To view a brief example of how you could structure your code take a look at ```examples/index.php``` in the repository.

## Available Functions

| Name             | Parameters           | Description                                                                                  |
|------------------|----------------------|----------------------------------------------------------------------------------------------|
| getCollections() | none                 | Retrieves a list of all collections belonging to the current ```$rbuser```                    |
| getProducts()    | ```$collection_id``` | Retrieves a list of products from a particular collection, ```$collection_id``` is required. |

## Options

These options need to be set when the class is initiated with ```new RedbubbleConfig()```.

| Name                | Type    | Default       | Description                                                                                                     |
|---------------------|---------|---------------|-----------------------------------------------------------------------------------------------------------------|
| ```rbuser```        | String  | ```null```    | This is **required** allows the class to scrape your Redbubble page.                                              |
| ```response_type``` | String  | ```object```   | Defines response type, possible values are ```object``` and ```json```                             |
| ```pretty_urls```   | Boolean | ```false```   | For SEO purposes you may wish to use pretty URLS, set this to ```true``` and ensure to edit your htaccess file (example below).|

## Licence

Built and maintained by Lee Jones <mail@leejones.me.uk> MIT License
