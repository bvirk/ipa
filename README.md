# IPA, a microframework
### Description
IPA implements a static site in php. It aims making it manageable to deal with php, css, javascript and some html in a [CoC](https://en.wikipedia.org/wiki/Convention_over_Configuration) and [DRY](https://en.wikipedia.org/wiki/Don%27t_Repeat_Yourself) way.

The letter '__A__' in IPA stands for ascii. It started with a content concept, which force was to be readable and adequate as readable content in it's ascii appearance - the very markdown. __IP__ for interpolation is actual a too big term - also for the mechanism in php.

The big pictues is that suffix names the conversion. .eml could be email - it is ascii too with attachments as base64 ascii. You could write your own edit mode - possible in jEdit and give some invented content type a conversion to html.

As of now it's only markdown snippet, but if needed ahead, suffix could decide default conversion, overrideable for snippets prefixed with a '@type;' modifier.

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
 ![play-foo-bar](https://github.com/bvirk/ipa/blob/main/domain/img/pages/docs/bws-play-foo_bar.png?raw=true)
 
---
Documentation continued in website in this repo. php 7.3. developed in firefox 96 linux.
 
