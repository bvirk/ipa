<?php
namespace bvirk\pagessets;
use bvirk\utilclasses\JScripts;

class Docs extends PageAware {
    protected $cssFiles=	['https://fonts.googleapis.com/css?family=Fira+Mono'];
	protected $jsFiles= [	
		"/js/jquery-3.6.0.min.js"];
	protected $jsAsMethods = ["attachHashNumLinksOnReady"];
}