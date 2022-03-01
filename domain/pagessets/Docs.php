<?php
namespace bvirk\pagessets;
use bvirk\utilclasses\JScripts;

class Docs extends PageAware {
    //protected $cssFiles=	['https://fonts.googleapis.com/css?family=Fira+Mono'];
	protected $jsFiles= [	
		"https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"];
	protected $jsAsMethods = ["attachHashNumLinksOnReady"];
}