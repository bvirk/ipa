<?php return [ //0 >>>
	<<<EOMD
# IPA, a microframework
### method pages
this is about laying out the body element of generated html document in a method.

It is done, e.g., in method foo() of the class Play if the address is [/play/foo](/play/foo). Two methods in base class PageAware exposes access to the list of snippets

- nextHtml()
- nextDiv()

They both works the the forward iterator way - one snippet is outputted after each call to nextHtml() or nextDiv() in 'index order' from 0 to numbers of snippets minus 1. It is the same underlying object, \$htmlGenObj, they both work on.

\$htmlGenObj is a php Generator object - it means availability to loop

```
while (\$this->htmlGenObj->valid())
	\$this->nextDiv();
```
nextDiv() actual means output next as div surrounded. It is contrary nextHtml() which just outputs the converted markdown snippet.

nextDiv() is defined as:
```
nextDiv(int \$num=1, \$divClassAttStartIndex=null)
```
Num is the number of snippet to output and \$divClassAttStartIndex is the trailing number in value of the class attribute of the surrounding div element.

In other words, \$divClassAttStartIndex has nothing to do with index of snippets - it is present as argument for reuse of styling selectors. Html source of [/play/nextdiv_args](/play/nextdiv_args) shows an example.
 
In the simplest way, where nextDiv() is used with parameters, trailing num value of div class attribute follows the index of snippets. 

### Pages methods without snippet
Is desireable for pages without much textual content. An example is [/play/web_directory](/play/web_directory) - nice to get pictures references right in clipboard.

Pages with methods but without .md files opens some addressing issues.

Php methods is not case sentitive so [/play/web_directory](/play/web_directory) and [/play/WEB_directory](/play/WEB_directory) both invoke method web_directory().   

Underscores is used to make nice menu names - they becomes spaces.

 [/sitemap](/sitemap) makes a menu on base of .md files __AND__ a property in a every pages class that lists the non .md files methods - e.g. for Play
```
static \$methods = ['web_directory','my_pie','slider','pie_art'];
```
But every public method of a pages class is addressable - even if it not on the sitemap menu.

Next page is [/docs/todoc_list](/docs/todoc_list)


EOMD];