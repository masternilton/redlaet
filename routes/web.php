<?php /** @noinspection SpellCheckingInspection */
/** @noinspection PhpUndefinedClassInspection */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('listado_usuarios_publico', 'PublicoController@listado_usuarios_publico');
Route::get('listado_publico_suramerica', 'PublicoController@listado_publico_suramerica');
Route::get('listado_publico_norteamerica', 'PublicoController@listado_publico_norteamerica');
Route::get('listado_publico_europa', 'PublicoController@listado_publico_europa');
Route::get('listado_publico_pais/{pais}', 'PublicoController@listado_publico_pais');
Route::post('buscar_usuario_publico', 'PublicoController@buscar_usuario_publico');
Route::get('informacion_usuario_publico/{id}', 'PublicoController@informacion_usuario_publico');

Route::get('enviar_cola_noticias', 'CorreoController@enviar_cola_noticias');



Route::post('/registro_usuario', 'AccesoController@registro_usuario');
Route::get('/form_reset_password', 'AccesoController@form_reset_password');
Route::post('/recuperar_password', 'AccesoController@recuperar_password');
Route::post('/login_externo', 'AccesoController@login_externo');

Route::get('/solicitudred/{key}', 'UsuariosController@aprobar_solicitud_desde_correo');

Route::get('enviar_prueba_correo', 'CorreoController@enviar_correo_solicitud');

Route::get('desbloquear_correo', 'CorreoController@desbloquear_email');

//Route::get('pasar_usuarios_viejos', 'UsuariosController@pasar_usuarios_viejos');
//Route::get('pasar_claves_viejas', 'UsuariosController@pasar_claves_viejas');

Auth::routes();



Route::group(['middleware' => 'auth'], function () {
	
	Route::get('/home', 'HomeController@index');
    Route::get('/listado_usuarios', 'UsuariosController@listado_usuarios');
    Route::post('crear_usuario', 'UsuariosController@crear_usuario');
    Route::post('crear_usuario_pais', 'UsuariosController@crear_usuario_pais');
    Route::post('editar_usuario', 'UsuariosController@editar_usuario');
   
    Route::post('buscar_usuario', 'UsuariosController@buscar_usuario');
    Route::post('borrar_usuario', 'UsuariosController@borrar_usuario');

    Route::post('borrar_usuario_final', 'UsuariosController@borrar_usuario_final');
    Route::post('editar_acceso', 'UsuariosController@editar_acceso');

    Route::get('/listado_usuarios_filtro', 'UsuariosController@listado_usuarios');
    Route::post('/listado_usuarios_filtro', 'UsuariosController@listado_usuarios_filtro');



    
  

    Route::post('crear_rol', 'UsuariosController@crear_rol');
    Route::post('crear_permiso', 'UsuariosController@crear_permiso');
    Route::post('asignar_permiso', 'UsuariosController@asignar_permiso');
    Route::get('quitar_permiso/{idrol}/{idper}', 'UsuariosController@quitar_permiso');
    Route::get('form_editar_rol/{id}', 'UsuariosController@form_editar_rol');

    Route::get('/listado_coordinadores', 'UsuariosController@listado_coordinadores');
    Route::post('actualizar_usuario_rol', 'UsuariosController@actualizar_usuario_rol');
    Route::get('/listado_coordinadores_zona', 'UsuariosController@listado_coordinadores_zona');
    Route::get('/listado_usuarios_pais', 'UsuariosController@listado_usuarios_pais');

     Route::get('/listado_usuariospais_filtro', 'UsuariosController@listado_usuarios_pais');
     Route::post('/listado_usuariospais_filtro', 'UsuariosController@listado_usuariospais_filtro');
    
    Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
    Route::get('form_nuevo_rol', 'UsuariosController@form_nuevo_rol');
    Route::get('form_nuevo_permiso', 'UsuariosController@form_nuevo_permiso');
    Route::get('form_editar_usuario/{id}', 'UsuariosController@form_editar_usuario');
    Route::get('confirmacion_borrado_usuario/{idusuario}', 'UsuariosController@confirmacion_borrado_usuario');
    Route::get('asignar_rol/{idusu}/{idrol}', 'UsuariosController@asignar_rol');
    Route::get('quitar_rol/{idusu}/{idrol}', 'UsuariosController@quitar_rol');
    Route::get('form_borrado_usuario/{idusu}', 'UsuariosController@form_borrado_usuario');
    Route::get('borrar_rol/{idrol}', 'UsuariosController@borrar_rol');
    Route::post('editar_imagen', 'UsuariosController@editar_imagen');
    Route::get('form_editar_mi_perfil/{id}', 'UsuariosController@form_editar_mi_perfil');

    Route::get('form_nuevo_usuariopais', 'UsuariosController@form_nuevo_usuariopais');

    Route::post('crear_estudio', 'EstudiosController@crear_estudio');
    Route::post('borrar_estudio', 'EstudiosController@borrar_estudio');
    Route::post('buscar_usuario_pais', 'UsuariosController@buscar_usuario_pais');
   
    
    
    


       //Route::get('cargar_directorio', 'HomeController@cargar_directorio');

     //ruta para el datatable del directorio

    Route::post('buscar_persona', 'DirectorioController@buscar_persona');
    Route::get('listado_personas/{filtro?}/{orden?}', 'DirectorioController@listado_personas');
    Route::any('buscar_persona', 'DirectorioController@buscar_persona');

    Route::resource('listado_empresas', 'DirectorioController@listado_empresas');
    Route::resource('listado_empresas_data', 'DirectorioController@data_empresas');


    Route::get('form_correo', 'CorreoController@form_correo');
    Route::get('seccion_correo', 'CorreoController@seccion_correo');
    Route::resource('listado_usuarios_correo', 'CorreoController@data_usuarios_correo');
    Route::post('enviar_correo', 'CorreoController@enviar_correo');
    Route::resource('listado_grupos_correo', 'CorreoController@data_grupos_correo');
    Route::post('enviar_correo_grupo', 'CorreoController@enviar_correo_grupos');
     Route::post('enviar_correo_region', 'CorreoController@enviar_correo_region');


    Route::get('listado_entradaswp', 'EntradaswpController@listado_entradaswp');
    Route::get('solicitudes_registro', 'UsuariosController@solicitudes_registro');
    Route::get('solicitud_informacion/{id}', 'UsuariosController@solicitud_informacion');
    Route::get('aprobar_solicitud/{key}', 'UsuariosController@aprobar_solicitud');
    Route::get('archivar_solicitud/{key}', 'UsuariosController@archivar_solicitud');

    Route::post('enviar_correo_noticias', 'CorreoController@enviar_correo_noticias');
    Route::post('enviar_correo_grupos_noticia', 'CorreoController@enviar_correo_grupos_noticia');

    Route::post('enviar_correo_region_noticia', 'CorreoController@enviar_correo_region_noticia');

    Route::get('listado_usuarios_red', 'RedController@listado_usuarios_red');
    Route::get('listado_noticias_red', 'RedController@listado_noticias_red');


    Route::get('/listado_usuarios_coordinadores', 'UsuariosController@listado_usuarios_coordinadores');
    Route::get('/listado_usuarios_coordinadores_pais', 'UsuariosController@listado_usuarios_coordinadores_pais');
    Route::get('/listado_usuarios_coordinadores_region', 'UsuariosController@listado_usuarios_coordinadores_region');
    Route::get('/listado_usuarios_coordinadores_zona', 'UsuariosController@listado_usuarios_coordinadores_zona');
    
    Route::get('/listado_certificado', 'CertificadosController@listado_certificado');
    Route::get('/generar_certificado', 'CertificadosController@generar_certificado');
     Route::get('/generar_certificado_coordinador', 'CertificadosController@generar_certificado_coordinador');
    Route::get('/listado_notificaciones', 'NotificacionesController@listado_notificaciones');
    Route::get('/ver_info_mensaje/{id}', 'NotificacionesController@ver_info_mensaje');


     Route::post('crear_mensaje', 'MensajesController@crear_mensaje');
     Route::post('responder_mensaje', 'MensajesController@responder_mensaje');
     Route::post('archivar_mensaje', 'MensajesController@archivar_mensaje');
     Route::get('/cargar_numero_notificaciones', 'NotificacionesController@cargar_numero_notificaciones');


     Route::post('buscar_entrada', 'EntradaswpController@buscar_entrada');
     Route::get('buscar_entrada', 'EntradaswpController@listado_entradaswp');
     Route::get('registrar_fecha_noticias', 'NotificacionesController@registrar_fecha_noticias');
     Route::get('registrar_cuenta', 'UsuariosController@registrar_cuenta');

     Route::get('listado_usuarios_region', 'CoordinadorController@listado_usuarios_region');
     Route::get('listado_coordinadores_pais_region', 'CoordinadorController@listado_coordinadores_pais_region');
     Route::get('listado_coordinadores_zona_region', 'CoordinadorController@listado_coordinadores_zona_region');
      Route::get('solicitudes_registro_region', 'CoordinadorController@solicitudes_registro_region');


     Route::get('listado_usuariosregion_filtro', 'CoordinadorController@listado_usuarios_region');

     Route::post('listado_usuariosregion_filtro', 'CoordinadorController@listado_usuariosregion_filtro');
       
     Route::post('buscar_usuario_region', 'CoordinadorController@buscar_usuario_region');
     Route::post('buscar_usuario_mired', 'RedController@buscar_usuario_mired');

     Route::post('reporte_pdf_usuarios', 'pdfController@reporte_pdf_usuarios');
     Route::post('reporte_pdf_usuarios_pais', 'pdfController@reporte_pdf_usuarios_pais');
     Route::post('reporte_pdf_usuarios_region', 'pdfController@reporte_pdf_usuarios_region');
     Route::post('reporte_pdf_coordinadoresGlobal', 'pdfController@reporte_pdf_coordinadoresGlobal');
     Route::post('reporte_pdf_coordinadoresRegGlobal', 'pdfController@reporte_pdf_coordinadoresRegGlobal');

     Route::post('reporte_pdf_coordinadoresPaisGlobal', 'pdfController@reporte_pdf_coordinadoresPaisGlobal');

      Route::post('reporte_pdf_coordinadoresZonaGlobal', 'pdfController@reporte_pdf_coordinadoresZonaGlobal');

    
      Route::get('listado_usuarios_coorgeneral', 'CoordinadorController@listado_usuarios_coorgeneral');

      Route::get('listado_borrados', 'CoordinadorController@listado_borrados');
      Route::get('solicitudes_registro_coor', 'CoordinadorController@solicitudes_registro_coor');

      
      Route::get('listado_coordinadoreszona_coor', 'CoordinadorController@listado_coordinadoreszona_coor');

      Route::get('listado_coordinadorespais_coor', 'CoordinadorController@listado_coordinadorespais_coor');

       Route::get('listado_coordinadoresregion_coor', 'CoordinadorController@listado_coordinadoresregion_coor');

       Route::post('listado_usuarioscoor_filtro', 'CoordinadorController@listado_usuarioscoor_filtro');

        Route::post('recuperarle_password_usuario', 'UsuariosController@recuperarle_password_usuario');


   
      

});

