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
$vocab["menu_admin_zona_trabajo"]      = "Centro de trabajo";
$vocab["menu_admin_formulario"]        = "Formulario";
$vocab["menu_planes_emergencia"]       = "Plan de emergencia";
$vocab["menu_admin_sede"]              = "Sedes";

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


//**************** Modulo administración de matriz de riesgos *******************//
$vocab["isActivo"]                              = "Activo";
$vocab["isInactivo"]                             = "Inactivo";

$vocab["origen_amenaza_title"]                  = "Origen de la amenaza";
$vocab["list_origen_amenaza_title"]             = "Or&iacute;gen de la amenaza";
$vocab["list_origen_amenaza_id"]                = "Id";
$vocab["list_origen_amenaza_descripcion"]       = "Origen de la amenaza";
$vocab["list_origen_amenaza_isActivo"]          = "Activar origen de la amenaza";
$vocab["desc_origen_isActivo"]                  = "Active o desactive el origen";
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
$vocab["list_categoria_amenaza_descripcion"]    = "Informaci&oacute;n de la categoria";
$vocab["list_categoria_amenaza_isActivo"]          = "Activar categoria de amenaza";
$vocab["desc_categoria_isActivo"]                  = "Active o desactive la categoria de amenaza";
$vocab["nombre_categoria_amenaza"]                 = "Nombre de la categoria de amenaza";
$vocab["nombre_desc_categoria_amenaza"]            = "Escriba el nombre de la nueva categoria de amenaza";



//***************************** Modulo zona de trabajo******************************//
$vocab["zona_trabajo_title"]              = "Centro de trabajo";
$vocab["list_zona_trabajo_title"]         = "Centro de trabajo";
$vocab["list_zona_trabajo_id"]            = "Id";
$vocab["list_zona_trabajo_descripcion"]   = "Centro de trabajo";

$vocab["zona_trabajo_title_Desc"]        = "Titulo del centro de trabajo";
$vocab["zona_trabajo_id"]                = "Id";
$vocab["zona_trabajo_id_Desc"]           = "Id del capitulo";
$vocab["zona_trabajo_Descripcion"]       = "Descripción del centro de trabajo";
$vocab["zona_trabajo_activar"]           = "Activar centro de trabajo";
$vocab["desc_zona_trabajo_isActivo"]     = "Active o desactive el centro de trabajo";
$vocab["zona_trabajo_sede"]              = "Sede";
$vocab["zona_trabajo_sede_Desc"]         = "Sede a la que pertenece el centro";
$vocab["zona_trabajo_logo"]               = "Logo ";
$vocab["zona_trabajo_logo_desc"]           = "Cambiar Logo del centro";
$vocab["zona_trabajo_Ubicacion"]               = "Ubicacion ";
$vocab["zona_trabajo_Ubicacion_desc"]           = "Ubicación según google georeferenciada";
//***************************** Modulo Sedes******************************//
$vocab["sede_title"]               = "Sedes";
$vocab["list_sede_title"]          = "Sedes";
$vocab["list_sede_id"]             = "Id";
$vocab["list_sede_descripcion"]    = "Sedes";

$vocab["sede_title_Desc"]       = "Titulo de la sede";
$vocab["sede_id"]               = "Id";
$vocab["sede_id_Desc"]          = "Id de la sede";
$vocab["sede_Descripcion"]      = "Descripción de la sede";
$vocab["sede_activar"]      = "Activar sede";
$vocab["desc_sede_isActivo"]   = "Active o desactive la sede";
//***************************** Modulo administrar capitulos ******************************//
$vocab["list_capitulo"]             = "Lista de capitulos";
$vocab["add_capitulo"]              = "capitulos";
$vocab["list_capitulo_title"]       = "Titulo";
$vocab["list_capitulo_id"]          = "Id";
$vocab["list_capitulo_orden"]       = "orden";
$vocab["list_capitulo_ordenar"]       = "ordenar";

$vocab["capitulo_capitulo"]             = "Capitulo";
$vocab["capitulo_capitulo_Desc"]        = "Capitulos del reporte";
$vocab["capitulo_title"]                = "Titulo";
$vocab["capitulo_title_Desc"]           = "Titulo del capitulo";
$vocab["capitulo_id"]                   = "Id";
$vocab["capitulo_id_Desc"]              = "Id del capitulo";
$vocab["capitulo_Descripcion"]          = "Descripción del capitulo";
$vocab["capitulo_Descripcion_usuario"]  = "Descripción para el usuario";
$vocab["capitulo_Descripcion_usuario_desc"]  = "guia para el usuario";
$vocab["capitulo_requiere_Descripcion_usuario"]  = "Requiere descripción del usuario";
$vocab["capitulo_requiere_Descripcion_usuario_desc"]  = "permite al usuario agregar una descripción";

//***************************** Modulo administrar subcapitulos ******************************//
$vocab["list_subcapitulo"]                = "Lista de subcapitulos";
$vocab["add_subcapitulo"]                 = "subcapitulos";
$vocab["list_subcapitulo_title"]          = "Titulo";
$vocab["list_subcapitulo_id"]             = "Id";
$vocab["list_subcapitulo_orden"]          = "orden";
$vocab["list_subcapitulo_Descripcion"]    = "Descripcion";

$vocab["subcapitulo_subcapitulo"]         = "Subcapitulo";
$vocab["subcapitulo_subcapitulo_Desc"]    = "Subcapitulos pertenecientes a un capitulo del reporte";
$vocab["subcapitulo_title"]               = "Titulo";
$vocab["subcapitulo_title_Desc"]          = "Titulo del subcapitulo";
$vocab["subcapitulo_capitulo"]            = "Capitulo";
$vocab["subcapitulo_capitulo_Desc"]       = "Capitulo al que pertenece";
$vocab["subcapitulo_Descripcion"]         = "Descripción del subcapitulo";
$vocab["subcapitulo_Descripcion_usuario"]  = "Descripción para el usuario";
$vocab["subcapitulo_Descripcion_usuario_desc"]  = "guia para el usuario";
$vocab["subcapitulo_requiere_Descripcion_usuario"]  = "Requiere descripción del usuario";
$vocab["subcapitulo_requiere_Descripcion_usuario_desc"]  = "permite al usuario agregar una descripción";

//***************************** Modulo administrar formulario ******************************//
$vocab["formulario_admin"]             = "Administrar formularios";
$vocab["formulario_admin_Desc"]        = "Colocar la información de los formularios en un subcapitulo";
$vocab["list_formulario"]              = "Lista de formularios";
$vocab["formulario_id"]                = "id";
$vocab["formulario_formulario"]        = "Formulario";
$vocab["formulario_subcapitulo"]        = "subcapitulo(CAPITULO)";


//***********     Modulo Formulario matriz de riesgos    ***********************//
$vocab["matriz_title"]               = "Matriz de riesgos";
$vocab["td_origen"]                      = "Origen";
$vocab["td_tipo"]                        = "Tipo";
$vocab["td_categoria"]                   = "Categoria";
$vocab["td_fuente"]                      = "Fuente";
$vocab["td_probabilidad"]                = "Probabilidad";
$vocab["td_gravedad"]                    = "Gravedad";
$vocab["td_consecuencia_amenaza"]        = "Consecuencia de amenaza";
$vocab["td_tipo_alerta"]                 = "Tipo de alerta";
$vocab["td_valor"]                       = "Valor";
$vocab["td_criterio"]                    = "Criterio";

$vocab["criterio_ninguna"]               = "NINGUNA";
$vocab["criterio_verde"]                 = "VERDE";
$vocab["criterio_amarilla"]              = "AMARILLA";
$vocab["criterio_roja"]                  = "ROJA";
$vocab["graficar_matriz"]                = "Graficar";

//***********     Matriz cuadro resumen   ***********************//
$vocab["tipo_alerta_nombre"]               = "Tipo de alerta";
$vocab["tipo_alerta_cantidad"]               = "QTY";
$vocab["tipo_alerta_porcentaje"]               = "%";
$vocab["tipo_alerta_amenaza"]               = "Amenaza identificada";
$vocab["tipo_alerta_total"]               = "Amenaza identificada";



//***********    Incio plan de emergencia    ***********************//
$vocab["inicio_Bienvenido"]                  ="Bienvenido";
$vocab["inicio_Titulo"]                      = "SIGPE";
$vocab["inicio_Subtitulo"]                   = "CIEUNA";
$vocab["inicio_Titulo_Desc"]                 = "seleccione el plan de emergencia que desea trabajar";
$vocab["inicio_Empezar"]                     = "Empeza";
$vocab["inicio_Imprimir"]                    = "Imprimir";
$vocab["inicio_Imprimir"]                    = "Imprimir";
$vocab["incio_labe"]                         ="Plan de emergencia";

//***********    Menu plan de emergencia    ***********************//
$vocab["Menu_Datos_sin_guardar"]            ="Datos sin guardar";
$vocab["Menu_Datos_Plan"]                   ="Plan de emergencia:";

//***********     plan de emergencia  datos generales  ***********************//
$vocab["datos_generares_Titulo"]             ="Datos generales";
$vocab["datos_generares_Desc"]               ="Datos generales de la empresa";
$vocab["datos_generares_nombre"]             ="Nombre de la institución:";
$vocab["datos_generares_actividad"]          ="Actividad:";
$vocab["datos_generares_dirección"]          ="Dirección:";
$vocab["datos_generares_contacto"]           ="Persona de contacto general:";
$vocab["datos_generares_teléfono"]           ="Números de teléfono:";
$vocab["datos_generares_fax"]                ="Número de fax:";
$vocab["datos_generares_Correo"]             ="Correo electrónico para notificaciones:";
$vocab["datos_generares_NFPA"]               ="Categoría NFPA:";
$vocab["datos_generares_instalaciones"]      ="Uso principal de las instalaciones:";
$vocab["datos_generares_Horarios"]           ="Horarios o Jornadas:";
$vocab["datos_generares_Seguridad"]          ="Seguridad Insitucional:";
$vocab["datos_generares_Servicio"]           ="Servicio de Conserjería:";
$vocab["datos_generares_Administrativo"]     ="Personal Administrativo:";
$vocab["datos_generares_Académico"]          ="Personal Académico:";
$vocab["datos_generares_Estudiantil"]        ="Presencia Estudiantil:";
$vocab["datos_generares_siguente"]           ="y pasar el siguiente";
$vocab["datos_generares_datos"]              ="Datos";

//***********     plan de emergencia  datos generales  ***********************//
$vocab["actividades_Titulo"]             ="Tipo de población";
$vocab["actividades_Titulo_Desc"]        ="Tipo de poblacion en las actividades";
$vocab["actividades_Descripcion"]        ="Descripción";
$vocab["actividades_total"]              ="Total aproximado";
$vocab["actividades_Discapacidad"]        ="Representación de personas con discapacidad identificadas(detalle tipo de discapacidad)";
$vocab["actividades_administrativo"]     ="Personal administrativo";
$vocab["actividades_académico"]          ="Personal académico";
$vocab["actividades_Estudiantes"]        ="Estudiantes";
$vocab["actividades_Visitantes"]         ="Visitantes";


//***********     plan de emergencia  instalaciones ***********************//
$vocab["instalaciones_Titulo"]              ="Instalaciones";
$vocab["instalaciones_Titulo_Desc"]         ="características propias de la edificación:";
$vocab["instalaciones_subTitulo1"]          ="Características de las Instalaciones";
$vocab["instalaciones_Densidad"]            ="Densidad de ocupación:";
$vocab["instalaciones_Area"]                ="Área de construcción:";
$vocab["instalaciones_Instalaciones"]       ="Instalaciones:";
$vocab["instalaciones_zona"]                ="Características de la zona:";
$vocab["instalaciones_topografica"]         ="Topografía:";
$vocab["instalaciones_terreno"]             ="Nivel del terreno:";
$vocab["instalaciones_Colindantes"]         ="Colindantes:";
$vocab["instalaciones_subTitulo2"]          ="Elementos constructivos";
$vocab["instalaciones_Tipo"]                ="Tipo de construcción:";
$vocab["instalaciones_Antiguedad"]          ="Antigûedad:";
$vocab["instalaciones_Cimientos"]           ="Cimientos:";
$vocab["instalaciones_Estructura"]          ="Estructura:";
$vocab["instalaciones_Paredes"]             ="Paredes:";
$vocab["instalaciones_Entrepiso"]         ="Entrepiso:";
$vocab["instalaciones_Techo"]             ="Techo:";
$vocab["instalaciones_Cielos"]            ="Cielos:";
$vocab["instalaciones_Pisos"]             ="Pisos:";
$vocab["instalaciones_parqueo"]           ="Área de parqueo:";
$vocab["instalaciones_aguapotable"]       ="Sistema de agua potable:";
$vocab["instalaciones_sanitario"]         ="Sistema de alcantarillado sanitario:";
$vocab["instalaciones_pluvial"]           ="Sistema de alcantarillado pluvial:";
$vocab["instalaciones_electrico"]         ="Sistema electrico:";
$vocab["instalaciones_telefónico"]        ="Sistema telefónico:";
$vocab["instalaciones_Otros"]             ="Otros:";

//***********     plan de emergencia  equipos moviles  ***********************//
$vocab["equipo_moviles_titulo"]             ="Recurso equipo móvil";
$vocab["equipo_moviles_tipo"]               ="Tipo de equipo";
$vocab["equipo_moviles_cantidad"]           ="Cantidad";
$vocab["equipo_moviles_capacidad"]          ="Capacidad";
$vocab["equipo_moviles_caracteristicas"]    ="Características";
$vocab["equipo_moviles_contacto"]           ="Contacto";
$vocab["equipo_moviles_ubicacion"]          ="Ubicación";
$vocab["equipo_moviles_categoria"]          ="Categoría";
$vocab["equipo_moviles_terrestre"]          ="Terrestre";
$vocab["equipo_moviles_titulo_desc"]        ="Equipo móvil terrestres: jeep,camión,tractor,otros. <br>Equipo móvil acuático: Lancha,bote,Panga,otros. <br>Equipo móvil aereo: avioneta,helicoptero,otros.";
$vocab["equipo_moviles_Acuático"]           ="Acuático";
$vocab["equipo_moviles_Aereo"]              ="Aereo";

//***********     plan de emergencia  identificacion de peligros  ***********************//
$vocab["identifica_peligro_Titulo"] = "Identificacion de peligros";
$vocab["identifica_peligro_Titulo_Desc"] = "Identificacion de peligros";
$vocab["identifica_peligro_lugar"]         = "Peligro identificado";
$vocab["identifica_peligro_aula"]          = "Peligro en el aula oficina o laboratorio";
$vocab["identifica_peligro_edificio"]      = "Peligro en el edificio";
$vocab["identifica_peligro_electrica"]     = "Peligro en instalaciones eléctricas";
$vocab["identifica_peligro_agua"]          = "Peligro en instalaciones de agua";
$vocab["identifica_peligro_gas"]          = "Peligro en instalaciones de gas";
$vocab["identifica_peligro_adicionales"]          = "Peligro adicionales identificados";
$vocab["identifica_peligro_presente"]      = "Presente";
$vocab["identifica_peligro_ubicacion"]     = "Ubicación";
$vocab["identifica_peligro_presente"]      = "Presente";
$vocab["identifica_peligro_recomendacion"] = "Recomendacion de solución";
$vocab["identifica_peligro_fecha"]         = "Fecha de ejecución";
$vocab["identifica_peligro_responsable"]   = "Responsable";
$vocab["identifica_peligro_priorizacion"]  = "Priorización";



//***********     plan de emergencia  identificacion de peligros primera columna  ***********************//
$vocab["peligro_1"] = "Existen gabinetes, libros y estantes de pared sin asegurarse o con un débil apoyo estructural.";
$vocab["peligro_2"] = "Hay objetos pesados en los estantes que sobrepasan la altura de la cabeza de las y los funcionarios o estudiantes cuando están sentados.";
$vocab["peligro_3"] = "Hay peceras de vidrio u otras exhibiciones que pueden resultar peligrosas en caso de terremoto.";
$vocab["peligro_4"] = "Hay objetos en las paredes (macetas, jarrones, cuadros) sin asegurar, que pueden balancearse o ser lanzados durante un terremoto.";
$vocab["peligro_6"] = "Las puertas abren hacia adentro.";
$vocab["peligro_7"] = "Hay acumulaciones de basura o papel.";
$vocab["peligro_8"] = "Existen cilindros de gas.";
$vocab["peligro_9"] = "Hay escritorios o pupitres cerca de las ventanas de vidrio obstruyendo posibles salidas.";
$vocab["peligro_10"] = "Las paredes presentan reventaduras o desprendimientos de repello.";
$vocab["peligro_11"] = "Hay almacenamiento innecesario de material (combustible, papel, químicos, madera, etc.).";
$vocab["peligro_5"] = "Existe en su laboratorio cañería expuesta.";
$vocab["peligro_12"] = "Existen los pasillos en su oficina con el espacio cerrado.";
$vocab["peligro_13"] = "Hay basura que obstruye el paso en pasillos o rutas de salida.";
$vocab["peligro_14"] = "Hay huecos o zanjas descubiertas.";
$vocab["peligro_15"] = "Las puertas o portones de salida del edificio abren hacia atrás. Tienen llavines antipánico.";
$vocab["peligro_16"] = "Hay  puertas y portones con llave.";
$vocab["peligro_17"] = "Hay tendido eléctrico peligroso por los alrededores.";
$vocab["peligro_18"] = "Hay hundimiento en los pisos.";
$vocab["peligro_19"] = "Existe filtración de agua pluvial en el edificio.";
$vocab["peligro_20"] = "En la cubierta existen láminas sueltas, de zinc u otro material.";
$vocab["peligro_21"] = "Hay archivos o mobiliarios en desorden obstaculizan la salida.";
$vocab["peligro_22"] = "Las escaleras carecen de pasamanos o cinta antideslizante.";
$vocab["peligro_23"] = "Hay puertas obstruidas por desuso o falta de mantenimiento.";
$vocab["peligro_24"] = "Presenta cables sueltos.";
$vocab["peligro_25"] = "Tomacorrientes en mal estado.";
$vocab["peligro_26"] = "Lámparas colgantes sin incluir, fluorescentes sin protector.";
$vocab["peligro_27"] = "Cables parchados.";
$vocab["peligro_28"] = "Apagadores en mal estado.";
$vocab["peligro_29"] = "Faroles eléctricos en mal estado.";
$vocab["peligro_30"] = "Existe percolador, plantilla, microondas u otros electrodomésticos.";
$vocab["peligro_31"] = "Hay tanques sépticos deteriorados.";
$vocab["peligro_32"] = "Existen tanques sépticos debajo del piso o áreas de seguridad. ";
$vocab["peligro_33"] = "Hay tanques de agua en alto. ";
$vocab["peligro_34"] = "Existe señalización de cañerías. ";
$vocab["peligro_35"] = "Disponibilidad de bombas de agua.";
$vocab["peligro_36"] = "Existen cilindros de gas. ¿Qué tipo?";
$vocab["peligro_37"] = "Hay cilindros de gas vacíos, tirados o sin proteger.";

//***********     plan de emergencia formulario plan de accion ***********************//
$vocab["zona_seguridad"]                    = "zona de seguridad";
$vocab["zona_seguridad_title"]              = "";
$vocab["zona_seguridad_nombre"]             ="Nombre";  
$vocab["zona_seguridad_ubicacion"]          ="Ubicacion";  
$vocab["zona_seguridad_capacidad"]          ="Capacidad";  
$vocab["zona_seguridad_observaciones"]      ="Observaciones";  
$vocab["zona_seguridad_sector"]             ="Sector(es) que descargan a esa zona de seguidad";  
//$vocab["zona_seguridad_responsable"]      ="Responsable";  

//$vocab["plan_de_accion_interior"]      ="Interior";  
//$vocab["plan_de_accion_exterior"]      ="Exterior";  
//$vocab["plan_de_accion_anclar"]      ="Anclar";  
//$vocab["plan_de_accion_reparar"]      ="Reparar";  
//$vocab["plan_de_accion_remover"]      ="Remover";  


//***********     plan de emergencia formulario rutas de evacuación ***********************//
$vocab["rutas_evacuacion"]            = "Rutas de evacuación";
$vocab["rutas_evacuacion_nombre"]            = "Nombre de área";
$vocab["rutas_evacuacion_personas_permanentes"]            = "Personas permanentes";
$vocab["rutas_evacuacion_personas_flotantes"]            = "Personas flotantes";
$vocab["rutas_evacuacion_ruta1"]            = "Ruta ev 1.(Nombre salida)";
$vocab["rutas_evacuacion_distancia1"]            = "Distancia R1 (m) Se mide con cronograma a velocidad de caminado normal";
$vocab["rutas_evacuacion_tiempo1"]            = "Tiempo R1 (min)";
$vocab["rutas_evacuacion_ruta2"]            = "Ruta ev 2.(Nombre salida)";
$vocab["rutas_evacuacion_distancia2"]            = "Distancia R2 (m) Se mide en los planitos por medio de las cotas";
$vocab["rutas_evacuacion_tiempo2"]            = "Tiempo R2 (min)";

//***********     plan de emergencia formulario brigadistas ***********************// 
$vocab["brigadista_title"]            = "Brigadistas";
$vocab["brigadista_nombre"]            = "brigadistas/número";
$vocab["brigadista_punto_partida"]            = "Punto de  partida (zona habitual)";
$vocab["brigadista_zona_asignada"]            = "Zona asignada a evacuar";
$vocab["brigadista_numero_personas"]            = "Número de personas a evacuar";
$vocab["brigadista_distancia_total"]            = "Distancia total a recorrer (m)";
$vocab["brigadista_tiempo_evacuacion"]            = "Tiempo de evacuación (min)";


//***********     plan de emergencia  recurso humano ***********************//
$vocab["recurso_humano_titulo"]             ="Recurso Humano";                
$vocab["recurso_humano_titulo_desc"]        ="Profesíon u oficio: Ingeniero, arquitecto, enfermera, medico, otros";    
$vocab["recurso_humano_Cantidad"]           ="Cantidad"; 
$vocab["recurso_humano_Profesion"]          ="Profesión";
$vocab["recurso_humano_categoria"]          ="Categoria";
$vocab["recurso_humano_Localizacion"]       ="Localización";       
$vocab["recurso_humano_Contacto"]           ="Contacto";       
        
//***********     plan de emergencia  Inventario ***********************//
$vocab["inventario_fila"]           ="fila";    
$vocab["inventario_sector"]           ="sector";
$vocab["inventario_Datos"]           ="Datos";

//***********     plan de emergencia  instalaciones ***********************//
$vocab["instalaciones_titulo"]        ="Recurso de instalaciones";
$vocab["instalaciones_titulo_desc"]   ="Espacios físicos, bodegas, infraestructua";  
$vocab["instalaciones_tipo"]           ="Tipo de costrucción";    
$vocab["instalaciones_cantida"]        ="Cantidad";  
$vocab["instalaciones_tamaño"]         ="Tamaño M2";
$vocab["instalaciones_distribucion"]   ="Distribución interna y externa";
$vocab["instalaciones_encargada"]      ="Contacto y localización de la(s) persona(s) encargada(s) del lugar"; 
$vocab["instalaciones_ubicacion"]      ="Ubicación exacta"; 


//***********     plan de emergencia  otros invetarios ***********************//
$vocab["otros_recursos_Telecomunicacion"]             ="Recurso Telecomunicaciones";
$vocab["otros_recursos_Telecomunicacion_desc"]        ="Equipo: fax, télefono, celular, telex, internet, estación de radio, equipo de radio, repetidoras, etc.<br>"
                                                      ."Características: portátil, fijo, frecuencia, longitud de ondas, marca, serie, número, otras.";
$vocab["otros_recursos_equipo_repuestos"]             ="Recurso equipo para repuestos";
$vocab["otros_recursos_equipo_repuestos_desc"]        ="Plantas eléctricas, motosierras, bombas para agua, equipo de rescate, cocinas de gas de más de cuatro quemadores, utensilios de cocina, motores fuera<br>"
                                                      . "de borda, computadoras, impresoras, instrumentos de posicionamiento, atención prehospitalaria, búsqueda y rescate, tiendas de campaña, palas, picos,<br>"
                                                      . "machetes, cascos, guantes, etc.";
$vocab["otros_recursos_equipo_repuestosAgua"]         ="Recurso equipo para repuestos: servicios ccapacidades de almacenameinto de agua";
$vocab["otros_recursos_equipo_repuestosAgua_desc"]    ="Tanques, reservorios, cisternas, piscinas, edificaciones vitales, plantas potabilizadoras, bombas de achique, otros sistemas.";
$vocab["otros_recursos_equipo_repuestosEnergia"]       ="Recurso equipo para repuestos:Energia";
$vocab["otros_recursos_equipo_repuestosEnergia_desc"]  ="Generadores eléctricos, plantas eléctricas portátiles, instalaciones vitales, otros sistemas";
$vocab["otros_recursos_sistemas_insendios"]            ="sistemas fijos contra incendio,deteccion , alarmas y extintores";
$vocab["otros_recursos_sistemas_insendios_desc"]       ="Sistema fijo contra incendio, gabinetes del SFCI, extintores, detectores de humo, otros.";
$vocab["otros_recursos_Equipo_primeraRespuesta"]       ="Equipo de primera respuesta";
$vocab["otros_recursos_Equipo_primeraRespuesta_desc"]  ="cuarto de primeros auxilios, botiquines, ferula de espalda/araña/extremidades/cuello/sujetador de cabeza, otros.";
$vocab["otros_recursos_Señalizacion"]                  ="Señalización";
$vocab["otros_recursos_Señalizacion_desc"]             ="Evacuación, salvamneto, combate de incendios, accesibilidad universal, prohibición, otros.";
$vocab["otros_recursos_tipo"]                          ="Tipo de equipo";
$vocab["otros_recursos_cantidad"]                      ="Cantidad";
$vocab["otros_recursos_caracteristicas"]               ="Características";
$vocab["otros_recursos_contacto"]                      ="Contacto";
$vocab["otros_recursos_ubicacion"]                     ="Ubicación";
$vocab["otros_recursos_categoria"]                     ="Categoría";
$vocab["otros_recursos_observaciones"]                 ="Detalles/ Observacion";

//***********     plan de emergencia  poblacion ***********************//
$vocab["poblacion_titulo"]                             ="Conformación de comité y brigadas de emergencia por oficinas, ubicación por sectores.";
$vocab["poblacion_titulo_desc"]                        ="INSTRUCCIONES: Completar el cuadro con el nombre completo de los funcionarios que pertenecerán al comité de emergencia, brigadistas de primeros auxilios capacitados anteriormente, e interesados en llevar el curso(poner un asterisco * en interesados que no hayan llevado el curso de primeros auxilios), brigadistas para la brigada efectiva(evacuación, vigilancia, extinción), contactos en caso de emergencia.";
$vocab["poblacion_oficina"]                            ="Nombre de oficina";
$vocab["poblacion_ocuapcional"]                        ="Capacidad ocupacional permanente";
$vocab["poblacion_temporal"]                           ="Capacidad ocupacional temporal ";
$vocab["poblacion_representante_comite"]               ="Representante del comité de emergencias ";
$vocab["poblacion_representante_brigada"]              ="Representante de brigada efectiva (vigilancia, evacuación, extinción)";
$vocab["poblacion_representante_primerosAuxilios"]     ="Representante brigada primeros auxilios";
$vocab["poblacion_telefono_oficina"]                   ="Teléfonos de la oficina";
$vocab["poblacion_contactoEmergencia"]                 ="Persona contacto en caso de emergencia";
$vocab["poblacion_telefono_personal"]                  ="Teléfono personal en caso de emergencia";
$vocab["poblacion_correo"]                             ="Correo electrónico en caso de emergencia";
$vocab["poblacion_sectorNuevo"]                             ="Sector nuevo";


//***********     plan de emergencia  Ingresos ***********************//
$vocab["ingreso_titulo"]                               ="Análisis de tiempo de respuesta de cuerpos de atención de emergencias";

$vocab["ingreso_cuerpoRespuesta"]                      ="Cuerpo de respuesta";
$vocab["ingreso_ubicación"]                            ="Ubicación";
$vocab["ingreso_recorrido"]                            ="Distancia de recorrido";
$vocab["ingreso_ubicación"]                            ="Ubicación";
$vocab["ingreso_tiempoRespuesta"]                      ="Tiempo de respuesta";
$vocab["ingreso_cruzRoja"]                      ="Cruz Roja";
$vocab["ingreso_Bomberos"]                      ="Benemérito cuerpo de bomberos";
$vocab["ingreso_transito"]                      ="Tránsito";



$vocab["ingreso_subtitulo"]                      ="Descripción de ingreso de los cuerpos de socorro";
$vocab["ingreso_Condiciones"]                    ="Condiciones de análisis";
$vocab["ingreso_dimensiones"]                    ="Dimensiones de áreas de acceso:";
$vocab["ingreso_radio"]                          ="Radios de giro:";
$vocab["ingreso_caseta"]                         ="Casetas:";
$vocab["ingreso_plumas"]                         ="Plumas:";
$vocab["ingreso_ancho"]                          ="Ancho libre:";
$vocab["ingreso_protocolo"]                      ="Protocolos de coordinación con seguridad institucional";


//***********     plan de emergencia  puestos de la brigada ***********************//
$vocab["puestos_brigada_title"]                       ="Puestos de la brigada";
$vocab["puestos_brigada_puesto"]                      ="Puesto";
$vocab["puestos_brigada_funciones"]                   ="Funciones";
$vocab["puestos_brigada_plazos_ejecución"]            ="Plazos de ejecución";
$vocab["puestos_brigada_ejemplo1"]               ="Autoridades Universitarias";
$vocab["puestos_brigada_ejemplo2"]               ="Comité emergencias";
$vocab["puestos_brigada_ejemplo3"]               ="Brigada de primeros auxilios";
$vocab["puestos_brigada_ejemplo4"]               ="Brigada de evacuación";
$vocab["puestos_brigada_ejemplo5"]               ="Brigada de extinción";
$vocab["puestos_brigada_ejemplo6"]               ="Brigada de vigilancia";
$vocab["puestos_brigada_ejemplo7"]               ="Brigada de efectiva";
$vocab["puestos_brigada_puestoNuevo"]               ="Puesto nuevo";

//***********     plan de emergencia  capitulos y subcapitulos ***********************//
$vocab["capitulos_subcapitulos_title"]                       ="Informacion extra capitulos y subcapitulos";
$vocab["capitulos_subcapitulos_title_desc"]                       ="Informacion extra requedia en los capitulos y subcapitulos. El usuario debe escribir redaccion";
$vocab["capitulos_subcapitulos_capitulo"]                    = "Capitulo:";
$vocab["capitulos_subcapitulos_subcapitulo"]                 = "Subcapitulo:";
$vocab["capitulos_subcapitulos_info_admin"]                  = "Informacion del admin:";
$vocab["capitulos_subcapitulos_indicaciones"]                  = "Indicaciones:";
$vocab["capitulos_subcapitulos_info_usuario"]                  = "Redaccion del usuario:";
$vocab["capitulos_subcapitulos_formularios"]                  = "Formularios asociados:";
?>
