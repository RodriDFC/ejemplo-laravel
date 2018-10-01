
<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Route::get('/','inicioController@inicio')->name('inicio');//->middleware('example')

//users
Route::get('/usuarios','usuarioController@usuario')->name('usuarios');

Route::get('/usuarios/{user}','usuarioController@detalle')->name('detalle')
->where('user','[0-9]+');

Route::get('usuarios/nuevo','usuarioController@createUser')->name('crear');

Route::put('/usuarios/{user}','usuarioController@update')->name('actualizar');//put metodo para actualizar

Route::get('/usuarios/{user}/editar','usuarioController@edit')->name('editar');

Route::post('/usuarios/guardar','usuarioController@store')->name('guardar');

Route::delete('/usuarios/{user}/eliminar','usuarioController@destroy')->name('eliminar');


//login
Route::get('login','Auth\LoginController@showLoginForm')->name('login');

Route::post('login','Auth\LoginController@login')->name('loginPost');

Route::get('logout','Auth\LoginController@logout')->name('logout');

//registro
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register','Auth\RegisterController@register')->name('registerPost');

//client
Route::get('/clientes','ClienteController@index')->name('cliente');

//producto
Route::get('/productos','ProductoController@index')->name('producto');

//
Route::get('/facturas','FacturaController@index')->name('facturas');
Route::get('/facturas/{factura}','FacturaController@show')->name('detalleFactura')
    ->where('factura','[0-9]+');
Route::get('facturas/crear','FacturaController@create')->name('crearFactura');
Route::post('facturas/guardar','FacturaController@store')->name('guardarFactura');

// E-mail verification
Route::get('/register/verify/{code}', 'Auth\RegisterController@verify');