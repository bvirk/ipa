<?php
namespace bvirk\commands;

class Cmds extends CommandsBase {
    use CommandsFuncs;
    function run($args) {
        $pdir = dir(COMMANDDIR);
        while (false !== ($entry = $pdir->read())) {
            if (!in_array($entry,$this->excludes))
                echo lcfirst(substr($entry,0,-4))."\n";
        }
        $pdir->close();
    }
}