<?php return [ // 0 >>>
	<<<EOMD
# IPA, a microframework
### Default Pages

Like php offers a mechanism for interpolate variables in strings, html snippets is interpolated in the body element of the html page.  

If a file _hello.md_ with following placement in relation to _Play.php_ exists,  a request: [/play/hello](/play/hello) can invoke default interpolation. 
```
pagessets
├── play
│   ├── hello.md
├── Play.php
```
Concept is, _hello.md_ relates to _Play.php_ because it is placed in a directory which name only differs from _Play.php_ by leading lowercase and without _.php_ suffix. 

Default interpolation occurs when relevant method, here hello(), don't exists in class Play. If method hello() had existed, it could do whatever, including laid interpolating in html in body element with selected fragments from _	hello.md_

Following two examples uses 'default pages' [&#9881;](#1 "php")
EOMD, //1
	<<< EOMD
What happens 'default' is as __if__ this has been defined:
```
function hello() {
	\$this->defPages();
}
```

And PageAware.defPages() contains this fragment that polls the converted, from markdown to html, snippets of hello.md 

```
...
while (\$this->htmlGenObj->valid())
	\$this->nextDiv();
...
```
EOMD, //2
	<<< EOMD
 [![hello-md](/img/pages/docs/jes-play-hello.png)](/sitemap/mdsrc/play:hello-docs:default_pages)

In my favorite editor, jEdit, _hello.md_ has an 'editor mode' of markdown because of it's _.md_ suffix. _hello.md_ in the web page, is, by being read of the include function, a php file that returns an array of strings. Two strings is returned here.  
Here documents markdown snippets looks a little messy in jEdit - some comments tricks needed to keeps the editor  capable of syntax highligtning despite php here stuff.  

Notice the comments - eg. //1 in the line 'EOMD, //1'. This is the index af the markdown snippet that follows. Its can be important for styling. [&#128057;](#3 "explainer")
EOMD, //3
	<<< EOMD
 [![hello-md](/img/pages/docs/jes-docs-index.png)](/sitemap/mdsrc/docs:default_pages-docs:default_pages)

This is a screen dump from the very same markdown text in editor that makes the content of this box.
 
Notice the (#5 "explainer") before the line EOMD, //5. Because the 'mouse explainer icon' link has href="#5", javascript ensures the markdown snippet with index 5 is initial hidden, given a grey border and the href="#5" link given an onClick event that unhide and add a close button.  
There is no fun in editing the snippets numbers manual when inserting where snippets and opening link follows. An editor macro rocks - mine is [markdownSnippetIndex](https://github.com/bvirk/.jedit). regex enabled ;\\\\]\\\\(#\\\\d+ search sends the carret on mission.  

#####Implmentation details
Class Docs, which is the Class of this text, has in its definition
```
class Docs extends PageAware {
...
protected \$jsAsMethods = ["attachHashNumLinksOnReady"];
...
```
In class PageAware where the head is made:
```
if (count(\$this->jsAsMethods)): 
    	?><script><?php
    	foreach(\$this->jsAsMethods as \$jsSnip) 	
    		[JAVASCRIPT,\$jsSnip]();

    	?></script>
    <?php endif;
```
And in Class JScripts
```
	static function attachHashNumLinksOnReady() { 
    	global \$pe ?>
    	\$( function() {
    		attachHashNumLinks(<?="'\$pe[0]','\$pe[1]'"?>);
    	});
    <?php }
```
Notice how the path element - e.g [/docs](/docs) the of url becomes attachHashNumLinks('docs','index'). attachHashNumLinks(...) is defined in js/common.js.

EOMD, //4
	<<< EOMD

In some default mechanism the markdown snippets becomes a list of converted html snippets, each surrounded in an div. The class attribute depends on the class and method name and has list index starting with zero
```
<div class="mdsur-play-index-n"
... html
</div>
```
It is possible to style both individually and common because of this naming. eg.
- whole site
>div[class|=mdsur]
- class (set of pages)
>div[class|=mdsur-play]
- method (page)
>div[class|=mdsur-play-index]
- list element (section on page)
>e.g. .mdsur-play-index-0

The css technique is [attribute value selectors](https://developer.mozilla.org/en-US/docs/Learn/CSS/Building_blocks/Selectors/Attribute_selectors)  

There are several way of inclusions of css and javascript [&#129417;](#5 "opinion")

_css/play/hello.css_ 
EOMD, //5
	<<< EOMD
### Specialization of css and js

Two groups af css styling and javascript.
1. 'packages' made by others that forms a whole library. Google font, JQuery and other framworks
2. customisation and web designing by 'screwing the handles' the browsers's css and javascript capabilities offers

#### Group 1
is done on pages class level. What one pages class might make included in html head element dosn't affect other pages classes

#### Group 2
Possible levels are (e.g. with class Play and method foo)
- _css/common.css_ and _js/common.js_ (whole site)
- _css/play.css_ and _js/play.js_ (pages class level)
- _css/play/foo.css_ and  _js/play/foo.js_ (page level)
- \[JAVASCRIPT,'foobar'](); (javascript page level)

EOMD, //6
	<<< EOMD
```
div[class|=mdsur-play-index] { 
	width: 60%;
	margin: auto;
	border-bottom: 2px solid gray;
}

.mdsur-play-index-0 {
	background:  linear-gradient(to bottom, rgba(195, 195, 195, 1), rgba(255, 255, 255, 1));
}
```
 
 [![playScreen](/img/pages/docs/bws-play-hello.png)](/play/hello)

---

### Another example

 [![gravatat](/img/pages/docs/jes-play-gravatar.png)](/sitemap/mdsrc/play:gravatar-docs:default_pages)  
_pagessets/Play.php_
```
class Play extends PageAware {
	protected \$cssFiles=['https://fonts.googleapis.com/css?family=Rock+Salt'];
...
``` 
_css/play/gravatar.css_
```
.mdsur-play-gravatar-0 {
	width: 60%;
	margin: auto;
	font-family: 'Rock Salt';
}

img[alt=gravatar] {
	float: left;
	padding-right: 4px;
}
```

 [![gravatar](/img/pages/docs/bws-play-gravatar.png)](/play/gravatar)
 
Next page is [method_pages](/docs/method_pages) 
EOMD];