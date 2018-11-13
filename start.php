<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces and Routes
|--------------------------------------------------------------------------
|
| When your module starts, this file is executed automatically. By default
| it will only load the module's route file. However, you can expand on
| it to load anything else from the module, such as a class or view.
|
*/

if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}

/*
|--------------------------------------------------------------------------
| Instalador del módulo
|--------------------------------------------------------------------------
|
| Aquí se establecerán todas las reglas de instalación
| de tal forma que se pueda instalar automaticamente el módulo
| sin necesidad de instalarlo manualmente, ejecutar migraciones, 
| copiar assets, etc.
|
*/
if( sys_installed() ) {
	/* 
	| Instalador del módulo.
	|
	| module_install( function )->make(array());
	|
	| "function" puede ser una función anonima o 
	| un string con el controlador y la función.
	|
	*/
	module_install(__DIR__, function( $module ) {
		// Creamos los permisos necesarios para acceder.
		// Tengo que agregar también la posibilidad de 
		// Verificar que tenga los permisos necesarios el sidebar.
		// A demás tambíen de reformar la forma en la que se crean los menús.
		// Y por ejemplo si uno sidebar o un parent no está creado
		// Se debe crear automaticamente, evitando posibles bugs al momento de
		// Crear items en el sidebar.

		/* 
		| Creador del menú lateral izquierdo.
		| leftSidebar( $sidebar, $menu, $sub_menu )->make(array());
		|
		*/
		leftSidebar('sistema', 'configuracion')->make(array(
			['name' => [
				'es' => 'Monedas',
				'en' => 'Currencies'
			], 'route' => 'admin/settings/currencies']
		));

		/*
		| Ejecutamos las migraciones
		|
		*/
		module_migrate($module->name);

	});
}