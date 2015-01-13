<?php
function autoloader($class) {
    include 'app/' . $class . '.php';
}