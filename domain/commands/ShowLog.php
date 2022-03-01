<?php
namespace bvirk\commands;

class SHowLog extends CommandsBase {
    use CommandsFuncs;
        
    function run($args) { 
        p(readlog($args == "-c")); 
    }
}

