#Redbubble-API
*A bootleg Redbubble API*

`redbubble-api-collections.php` is a homebrew API designed to put your Redbubble products on your webpage. It allows you to pull a users collections and images inside the collections. The API terminates at the point of selecting an individual item, this will send you to the Redbubble website page for that item.

###See it in action:
http://store.leejones.me.uk



##CHANGE LOG


15/01/2013 - API COLLECTIONS - removed input form. Get data should be passed by some other method for a better user experience.
04/02/2013 - REMOVED V1 API - removed version 1 of the API, the full collections API is far more versatile and can be adapted to needs.




##KNOWN ISSUES

1: NO ITEMS IN COLLECIONS

Your list of collections will show up fine. But when you click into the collection it is empty. This is due to they 
type of thumbnail you have for you item previews in you collection.

--- RESOLUTION
Go to your Redbubble page, click the profile tab. Hover over each of the collections that have the issue, you will 
see a red box with a cog icon. Click this and a pop up open with your collection settings. In the thumbnails drop down 
choose any option EXCEPT CROPPED or UNCROPPED. The items will now show in your collections via the API.




##Licence

Copyright (c) 2012 Lee Jones
Licensed under GNU Lesser General Public License.