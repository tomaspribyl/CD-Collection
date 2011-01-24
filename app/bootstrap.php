<?php

use Nette\Debug,
	Nette\Environment,
	Nette\Application\Route,
	Nette\Application\SimpleRouter,
	Nette\Application\CliRouter;



// Step 1: Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require LIBS_DIR . '/Nette/loader.php';



// Step 2: Configure environment
// 2a) enable Nette\Debug for better exception and error visualisation
Debug::enable();

// 2b) load configuration from config.ini file
Environment::loadConfig();



// Step 3: Configure application
// 3a) get and setup a front controller
$application = Environment::getApplication();

// 3b) disable allow methods validation for console mode
if (Environment::isConsole()) {
	$application->allowedMethods = FALSE;
}


// Step 4: Setup application router
$router = $application->getRouter();

// 4a) setup cli

//$router[] = new CliRouter(array(
//	'presenter' => 'Cli',
//	'action' => 'createSchema'
//));

// 4b) mod_rewrite detection
if (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())) {
	$router[] = new Route('index.php', array(
		'presenter' => 'Dashboard',
		'action' => 'default',
	), Route::ONE_WAY);

	$router[] = new Route('<presenter>/<action>/<id>', array(
		'presenter' => 'Dashboard',
		'action' => 'default',
		'id' => NULL,
	));

} else {
	$router[] = new SimpleRouter('Dashboard:default');
}



// Step 5: Run the application!
$application->run();