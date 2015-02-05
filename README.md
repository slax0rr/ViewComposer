ViewComposer
============

ViewComposer for CodeIgniter, is an additional layer between Controller and View. You can use it as a presenter, to further prepare your data, or as a composer, when one view requires multiple views to be loaded for it, or needs to fetch some extra data.

Install
=======

To install, download the zip file, and extract in your project root.

Usage
=====

The way the ViewComposer works, is that it "listens" for specific view files to be loaded, and loads the configured composer class, and runs its **compose()** method. To begin using it, add a line to **application/config/viewcomposer.php** in the defined array:
```php
"view/path" => "Composername"
```

This means, when you will load the view *view/path*, ViewComposer will look for a *Composername_composer.php* file in the **application/composer/** directory, and load the *Composername_composer* class, and run its *compose()* method. In the composer it self, you have two sets of data available. The *$this->viewData*, which holds all of the data loaded before this view, and *$this->partialData*, which holds the data that was loaded with this particular view. When your composer finishes executing, it will join both of those arrays together.
