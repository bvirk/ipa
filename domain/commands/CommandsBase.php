<?php
namespace bvirk\commands;

/**
 * Common funtionality for commands
 */
class CommandsBase {
    protected $args;
    protected $excludes = [".","..","CommandsFuncs.php","CommandsBase.php","Cmds.php","MyClass.php"];
    protected $excludePages = ["PageAware.php","PageFuncs.php"];
    
    /**
     * if there isn't compile time error this will start making the remote bash script
     * runtime errors can still make output non bashish - cat recieving script if the 
     * there made attemps to auto cat not works.
     */  
    function __construct() {
         header("Content-Type: text/plain;charset=UTF-8");
         // echo "#!/bin/bash\n";
    }
    
    /**
     * default to show help for none parameters to commands that must have minimum one argument
     * override in class for commands being valid without parameters
     */ 
    function run($args) {
    	p(static::class." ".$args);	
    }
    
    
    /**
     * Returns true on empty args if second argument isn't applied as false
     */
    //function isHelpReq($args,$nothingIsHelpRequest=true) {
    //    return substr($args,0,2) === "-h" || (!$args && $nothingIsHelpRequest) ;
    //}
    
    
    /**
    | args            | return value
    |-----------------|-------------
    | w               | [w,"index",  null]
    | w1/w2           | [w1,w2,null ]
    | w1/w2 w3 w4 ... | [w1,w2,w3,w4, ...]
    | w1 w2 w3 ...    | [w1,"index",w2,w3, ...]
    
     */    
    function argsSplit($args) {
        $argsArr = explode(" ",$args);
        return strpos($argsArr[0],"/") 
            ? (array_merge(explode("/",$argsArr[0]),array_merge(array_slice($argsArr,1),[null]))) 
            : array_merge([$argsArr[0],"index"],array_merge(array_slice($argsArr,1),[null]));
    }
}
