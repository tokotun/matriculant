<?php
function autoloader($class) {
	if (file_exists('app/' . $class . '.php'))
	{
		include 'app/' . $class . '.php';
	}
}