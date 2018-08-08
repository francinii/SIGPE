<?php
// -*-mode: PHP; coding:utf-8;-*-
// $Id: lang.es 08-Nov-2012
// Creado Aarón Castillo

// Este archivo contiene codigo php que especifica los strings de cada idioma
// El sistema oficialmente se diseña en español asi que este archivo
// contiene la estructura basica del arreglo de variables con su respectivo nombre

// Este archivo contiene el idioma español

// Este archivo contiene codigo php tratar igual

//***************************** Modulo login *********************************//
$vocab["login_title"]               = "Ingreso a sistema";
$vocab["login_title_desc"]          = "Complete la informaci&oacute;n para realizar su ingreso al sistema";
$vocab["login_user"]                = "Usuario";
$vocab["login_user_desc"]           = "Digite su identificaci&oacute;n";
$vocab["login_pass"]                = "Contraseña";
$vocab["login_pass_desc"]           = "Digite su contraseña";
$vocab["login_pass_conf"]           = "Confirme su contraseña";
$vocab["login_but_start"]           = "Iniciar Sesi&oacute;n";

//***************************** Menu *****************************************//
$vocab["menu_home"]                 = "Inicio";
$vocab["menu_admin"]                = "Administraci&oacute;n";
$vocab["menu_mod"]                  = "Modulos";
$vocab["menu_roll"]                 = "Roles";
$vocab["menu_user"]                 = "Usuarios";
$vocab["menu_list"]                 = "Listar";
$vocab["menu_add"]                  = "Agregar";
$vocab["menu_help"]                 = "Ayuda";
$vocab["menu_logout"]               = "Salir";
$vocab["menu_perfil"]               = "Perfil";
$vocab["menu_continue"]             = "Continuar";
$vocab["menu_pram"]                 = "Parametros";

$vocab["menu_admin_planes_emergencia"] = "Administraci&oacute;n planes de emergencia";
$vocab["menu_matriz_riesgos"]          = "Matriz de riesgos";
$vocab["menu_admin_origen_amenaza"]    = "Origen de la amenaza";
$vocab["menu_admin_tipo_amenaza"]      = "Tipo de amenaza";
$vocab["menu_admin_categoria_amenaza"] = "Categor&iacute;a de amenaza";
$vocab["menu_admin_capitulos"]         = "Cap&iacute;tulos";
$vocab["menu_admin_subcapitulos"]      = "Subcap&iacute;tulos";
$vocab["menu_admin_zona_trabajo"]      = "Zonas de trabajo";
$vocab["menu_admin_formulario"]        = "Formulario";

//***************************** Home *****************************************//
$vocab["home_title"]               = "Simbolog&iacute;a";
$vocab["home_title_desc"]          = "Simbolog&iacute;a del sistema";

//***************************** Simbología General ***************************//
$vocab["symbol_view"]              = "Ver";
$vocab["symbol_edit"]              = "Editar";
$vocab["symbol_delete"]            = "Eliminar";
$vocab["symbol_print"]             = "Imprimir";
$vocab["symbol_add"]               = "Agregar";
$vocab["symbol_name"]              = "Nombre";
$vocab["symbol_desc"]              = "Descripci&oacute;n";
$vocab["symbol_save"]              = "Guardar";
$vocab["symbol_update"]            = "Actualizar";
$vocab["symbol_return"]            = "Regresar";
$vocab["symbol_search"]            = "Buscar";
$vocab["symbol_show_search"]       = "Mostrar Busqueda";
$vocab["symbol_hide_search"]       = "Ocultar Busqueda";
$vocab["symbol_no_data"]           = "No Hay Datos que Mostrar";
$vocab["symbol_order_label"]       = "<strong>Nota: </strong>Para ordenar la lista dar click sobre los encabezados";
$vocab["symbol_page"]              = "P&aacute;gina";
$vocab["symbol_page_of"]           = "de";
$vocab["symbol_select"]            = "Seleccione";
$vocab["symbol_loading"]           = "Cargando";


//***************************** Modulo permits *******************************//
$vocab["permits_title"]            = "Modulo";
$vocab["permits_title_desc"]       = "Informaci&oacute;n general de un modulo";
$vocab["permits_name_desc"]        = "Nombre del modulo";
$vocab["permits_desc_desc"]        = "Descripci&oacute;n general de la función del modulo";
$vocab["permits_list_title"]       = "Lista de Modulos";
$vocab["permits_list_title_desc"]  = "Nombre del modulo a buscar";

//***************************** Modulo roles *********************************//
$vocab["rols"]                     = "Rol";
$vocab["rols_title"]               = "Roles";
$vocab["rols_title_desc"]          = "Permite administrar los roles y sus respectivos permisos";
$vocab["rols_name_desc"]           = "Nombre del rol";
$vocab["rols_desc_desc"]           = "Descripci&oacute;n general del rol";
$vocab["rols_action_desc"]         = "Opciones del modulo";
$vocab["rols_list_title"]          = "Lista de Roles";
$vocab["rols_list_title_desc"]     = "Nombre del rol a buscar";
$vocab["rols_for_user"]            = "Seleccione el rol del usuario";
$vocab["rols_level"]               = "Rol";//agregado

//***************************** Modulo usuarios ******************************//
$vocab["user_title"]            = "Usuarios";
$vocab["user_title_desc"]       = "Informaci&oacute;n de usuario del sistema";
$vocab["user_list_title"]       = "Lista de Usuarios";
$vocab["user_id"]               = "C&eacute;dula / ID";
$vocab["user_id_desc"]          = "Escriba la c&eacute;dula o id del usuario";
$vocab["user_name_desc"]        = "El nombre se obtiene del servidor LDAP";
$vocab["user_mail"]             = "Correo electr&oacutenico";
$vocab["user_mail_desc"]        = "El correo electr&oacute;nico se obtiene de LDAP";
$vocab["user_tel"]              = "Tel&eacute;fono de contacto";
$vocab["user_tel_desc"]         = "Ingese el numero de telefono";
$vocab["user_perfil_desc"]      = "Información de usuario personal";


//***************************** Modulo matriz de riesgos******************************//
$vocab["isActivo"]          = "Activo";
$vocab["isInactivo"]          = "Inactivo";

$vocab["origen_amenaza_title"]                  = "Origen de la amenaza";
$vocab["list_origen_amenaza_title"]             = "Or&iacute;gen de la amenaza";
$vocab["list_origen_amenaza_id"]                = "Id";
$vocab["list_origen_amenaza_descripcion"]       = "Origen de la amenaza";
$vocab["list_origen_amenaza_isActivo"]          = "Activar origen de la amenaza";
$vocab["desc_origen_isActivo"]                 = "Active o desactive el origen";
$vocab["nombre_origen_amenaza"]                 = "Nombre del origen de la amenaza";
$vocab["nombre_desc_origen_amenaza"]            = "Escriba el nombre de la nueva amenaza";

$vocab["tipo_amenaza_title"]                    = "Tipo de la amenaza";
$vocab["list_tipo_amenaza_title"]               = "Tipo de amenaza";
$vocab["list_tipo_amenaza_id"]                  = "Id";
$vocab["list_tipo_amenaza_descripcion"]         = "Tipo de amenaza";
$vocab["list_tipo_amenaza_isActivo"]          = "Activar tipo de amenaza";
$vocab["desc_tipo_isActivo"]                  = "Active o desactive el tipo de amenaza";
$vocab["nombre_tipo_amenaza"]                 = "Nombre del tipo de amenaza";
$vocab["nombre_desc_tipo_amenaza"]            = "Escriba el nombre del nuevo tipo de amenaza";



$vocab["categoria_amenaza_title"]               = "Categoria";
$vocab["list_categoria_amenaza_title"]          = "Categor&iacute;a de amenaza";
$vocab["list_categoria_amenaza_id"]             = "Id";
$vocab["list_categoria_amenaza_descripcion"]    = "Informaci&iacute; de la categoria de amenaza";
$vocab["list_categoria_amenaza_isActivo"]          = "Activar categoria de amenaza";
$vocab["desc_categoria_isActivo"]                  = "Active o desactive la categoria de amenaza";
$vocab["nombre_categoria_amenaza"]                 = "Nombre de la categoria de amenaza";
$vocab["nombre_desc_categoria_amenaza"]            = "Escriba el nombre de la nueva categoria de amenaza";
//***************************** Modulo zona de trabajo******************************//
$vocab["zona_trabajo_title"]               = "Zona de trabajo";
$vocab["list_zona_trabajo_title"]          = "Zona de trabajo";
$vocab["list_zona_trabajo_id"]             = "Id";
$vocab["list_zona_trabajo_descripcion"]    = "Zona de trabajo";

$vocab["zona_trabajo_title_Desc"]       = "Titulo de la zona de trabajo";
$vocab["zona_trabajo_id"]               = "Id";
$vocab["zona_trabajo_id_Desc"]          = "Id del capitulo";
$vocab["zona_trabajo_Descripcion"]      = "Descripción del capitulo";

//***************************** Modulo administrar capitulos ******************************//
$vocab["list_capitulo"]             = "Lista de capitulos";
$vocab["add_capitulo"]              = "capitulos";
$vocab["list_capitulo_title"]       = "Titulo";
$vocab["list_capitulo_id"]          = "Id";
$vocab["list_capitulo_order"]       = "orden";
$vocab["list_capitulo_ordenar"]       = "ordenar";

$vocab["capitulo_capitulo"]         = "Capitulo";
$vocab["capitulo_capitulo_Desc"]    = "Capitulos del reporte";
$vocab["capitulo_title"]            = "Titulo";
$vocab["capitulo_title_Desc"]       = "Titulo del capitulo";
$vocab["capitulo_id"]               = "Id";
$vocab["capitulo_id_Desc"]          = "Id del capitulo";
$vocab["capitulo_Descripcion"]      = "Descripción del capitulo";

//***************************** Modulo administrar subcapitulos ******************************//
$vocab["list_subcapitulo"]                = "Lista de subcapitulos";
$vocab["add_subcapitulo"]                 = "subcapitulos";
$vocab["list_subcapitulo_title"]          = "Titulo";
$vocab["list_subcapitulo_id"]             = "Id";
$vocab["list_subcapitulo_order"]          = "orden";
$vocab["list_subcapitulo_Descripcion"]    = "Descripcion";

$vocab["subcapitulo_subcapitulo"]         = "Subcapitulo";
$vocab["subcapitulo_subcapitulo_Desc"]    = "Subcapitulos pertenecientes a un capitulo del reporte";
$vocab["subcapitulo_title"]               = "Titulo";
$vocab["subcapitulo_title_Desc"]          = "Titulo del subcapitulo";
$vocab["subcapitulo_capitulo"]            = "Capitulo";
$vocab["subcapitulo_capitulo_Desc"]       = "Capitulo al que pertenece";
$vocab["subcapitulo_Descripcion"]         = "Descripción del subcapitulo";

//***************************** Modulo administrar formulario ******************************//
$vocab["formulario_admin"]             = "Administrar formularios";
$vocab["formulario_admin_Desc"]        = "Colocar la información de los formularios en un subcapitulo";
$vocab["list_formulario"]              = "Lista de formularios";
$vocab["formulario_id"]                = "id";
$vocab["formulario_formulario"]        = "Formulario";
$vocab["formulario_subcapitulo"]        = "subcapitulo";
?>
