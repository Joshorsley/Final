# FileStructure

We used a single PHP page for pages 2-4 + an AjaxHandler.php.


This means our final structure looks like this:

## Index.html
Landing page.
Has a single input for user name & submit button.

## Final.php
Handles pages 2-4 via postback. 

Shares SESSION variables with AjaxHandler.php to output gathered data.

## AjaxHandler.php
Handles Ajax calls for the live updating of the cost total on page 2.

-----------------------------------------------------------------------

## Final.js
Javascript for all pages.

## Final.css
CSS for all pages.