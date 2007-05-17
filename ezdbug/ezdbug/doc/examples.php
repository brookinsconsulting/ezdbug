<?php

// Simple PHP Example

// if EZDBUG is false, no debug stuff will show up
define('EZDBUG', true);
define('EZDBUG_LOG_DIR', 'logs');
require("extension/ezdbug/classes/ezdebug.php");

$string = "Foo, bar, I'm a string.";

$array = array(
    "first"=>"1",
    "second",
    "third"=>array(
        "inner third 1",
        "inner third 2"=>"yeah"),
    "fourth");

class Vegetable {

   var $edible;
   var $color;

   function Vegetable($edible, $color="green") {
       $this->edible = $edible;
       $this->color = $color;
   }

   function is_edible() {
       return $this->edible;
   }

   function what_color() {
       return $this->color;
   }

}
$class=new Vegetable("spinach");

// skipping mysql resource
$xml = "http://www.brics.dk/~amoeller/XML/xml/recipes.xml";

// array to log
$dump_array = array(
    "dumping"=>"to",
    "a debug",
    "html"=>array(
        "file can be",
        "very useful"=>"when"),
    "debugging some things.");
// actual dumps and stuff
ezDbug::LogDump($dump_array);
ezDbug::LogHTML('Sometimes we need to just log a string to the html, or <b>something like that</b>.');
ezDbug::LogHTML('Remember to delete me, or each example will just keep appending stuff.');
ezDbug::LogString('And sometimes we just want to log a normal string to a non-html log file.');

ezDbug::Dump($string);
ezDbug::Dump($array);
ezDbug::Dump($class);
ezDbug::Dump($xml, 'xml');
