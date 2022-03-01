<?php return [ // 0 >>>
	<<<EOMD
# IPA, a microframework
### Description
IPA implements a static site in php. It aims making it manageable to deal with php, css, javascript and some html in a [CoC](https://en.wikipedia.org/wiki/Convention_over_Configuration) and [DRY](https://en.wikipedia.org/wiki/Don%27t_Repeat_Yourself) way.

The letter '__A__' in IPA stands for ascii. It started with a content concept, which force was to be readable and adequate as readable content in it's ascii appearance - the very markdown. __IP__ for interpolation is actual a too big term - also for the mechanism in php.

The big pictues is that suffix names the conversion. .eml could be email - it is ascii too with attachments as base64 ascii. You could write your own edit mode - possible in jEdit and give some invented content type a conversion to html.

As of now it's only markdown snippet, but if needed ahead, suffix could decide default conversion, overrideable for snippets prefixed with a '@type;' modifier.

- [&#129417;](/links "opinion")
- [&#9881;](/links "php")
- [&#128057;](/link "explainer")
- [&#129691;](/link "details")

### The request

index.php:
```
<?php
...
spl_autoload_register(...
...
\$pe = [...

[new \$pe[3](),\$pe[1]]();
```

pagessets/Play.php:
```
<?php
namespace ...

class Play extends PageAware {
	function foo_bar() {
		global \$pe;
		?><pre><?= 
		var_export(\$pe,true) 
		?></pre><?php
	}
```	
 ![play-foo-bar](/img/pages/docs/bws-play-foo_bar.png)

The request [/play/foo_bar/foo_ba-z:bar_baz](/play/foo_bar/foo_ba-z:bar_baz) becomes - due to file .htaccess and php module mod_rewrite, represented as global variable \$pe (for path elements). \$pe[0] is the name of the class that handles the request - \$pe[1] is the method of the class that is called. \$pe[2] can be used for selection inside the method.

Adresses are local absolute addresses - without server name and http://

There are some default.

1. Attemp to call a none existing class redirect to DEFAULTPAGE
2. Address: [/play](/play) actual means [/play/index](/play/index) 

All Classes that has a role of handling a request extends class PageAware. In the following these classses is referred to as 'pages classes'. Every one of them is refererred to as a 'pages class' - notice plural. If a request addresses a none existing page of a pages class magick method \_\_call() of PageAware gets thread of execution. [&#129691;](#1 "details")
EOMD, //1
	<<< EOMD
All public method of pages classes not containing underscore in the name is addressable. If methods, not being addressable is needed for decomposition and reuse of code lines, the methods should be made private or contain underscore in the name.
EOMD, //2
	<<< EOMD
If the 'missing' page is not handled by the interpolation mechanism which I will describe next, javascript invoked redirection to DEFAULTPAGE is the response. [&#128057;](#3 "explainer")
EOMD, //3
	<<< EOMD
Output has already been sendt because PageAware has a contructer that output the html head. Because of that redirection has to go the long way around of being executed in the browser - a full html documents is returned which last contains:
```
<body>
	<script>window.location = '/landing';</script>
</body>
</html>
```
The long four-o-four songs &#129315; also seems being replaced at other web sites - in flavor of sensible defaults. 
EOMD, //4
	<<< EOMD
Next page is [default pages](/docs/default_pages)
 
EOMD];