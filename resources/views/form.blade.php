@extends('master')

@section('content')

    <?php


    preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
    if (count($matches) < 2) {
        preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
    }

    if (count($matches) > 1) {
        //Then we're using IE
        $version = $matches[1];

        switch (true) {
            case ($version <= 8):
                echo ':( Tu navegador IE no es compatible por favor utiliza firefox o chrome';
                exit();
                break;

            case ($version == 9 || $version == 10):
                //IE9 & IE10!
                echo ':( Tu navegador IE no es compatible por favor utiliza firefox o chrome';
                exit();
                break;

            case ($version == 11):
                //Version 11!
                echo ':( Tu navegador IE no es compatible por favor utiliza firefox o chrome';
                exit();
                break;

            default:
                //You get the idea
        }
    }

    ?>

    <style>
        .ficheros {
            background: rgb(48, 164, 231);
            padding: 10px;
            border-radius: 29px;
            font-weight: bolder;
            color: white;
            box-shadow: 4px 7px 31px rgba(136, 136, 136, 0.6);
        }

        .freebirdFormviewerViewItemsPagebreakDescriptionText {
            font-size: 10px !important;
            color: gray;
        }
    </style>
    <?php

    date_default_timezone_set('America/Bogota');
    $today = date("Y-m-d H:i:s");
    $date = "2017-09-31 23:59:00";

    if ( $today > $date && empty($usuario) ) {


    ?>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

    <h1 style="font-family: 'Noto Sans', sans-serif;">Inscripción cerrada</h1>

    <?php

    }else{
    ?>
    <input type="hidden" name="url" value="{{url('/')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('public/Css/form.css?n=10')}}">

    <form method="POST" action="{{route('insertar')}}" id="form_gen" enctype="multipart/form-data">
        <input type="hidden" id="editar" name="editar"
               value={{(!empty($usuario)?url_segura('encapsular',$usuario->id):'')}} >
        <div class="panel panel-default">
            <div class="panel-heading"> {{(!empty($usuario)?'Bienvenido de nuevo usuario : '.$usuario->nombres.' '.$usuario->apellido:'Datos Básicos y de contacto')}}</div>
            <div class="panel-body">

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Documento de
                        identidad <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <input title="Se necesita una cedula" required type="number" class="form-control" id="cedula"
                           name="cedula" value={{(!empty($usuario)?$usuario->cedula:'')}} >

                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Tipo de
                        documento <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione de acuerdo a su documento
                    </label>
                    <select name="tipo_documento" id="tipo_documento" class="form-control">
                        <option value="1" {{(!empty($usuario)?($usuario->tipo_documento == 1 ? 'selected' : ''):'')}}>
                            Cédula de Ciudadania
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->tipo_documento == 2 ? 'selected' : ''):'')}}>
                            Cédula de Extranjeria
                        </option>
                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Nombres <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligenciar en MAYÚSCULA y tal cual como aparece en el documento de identidad
                    </label>
                    <input required type="text" class="form-control" id="nombres" name="nombres"
                           value={{(!empty($usuario)?$usuario->nombres:'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Apellidos <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligenciar en MAYÚSCULA y tal cual como aparece en el documento de identidad
                    </label>
                    <input required type="text" class="form-control" id="apellidos" name="apellidos"
                           value={{(!empty($usuario)?$usuario->apellidos:'')}} >
                </fieldset>


                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">CorreoElectrónico</label><span
                            style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligencie la información del correo es necesario que sea gmail
                    </label>
                    <input required type="email" class="form-control" id="mail" name="mail"
                           value={{(!empty($usuario)?($usuario->mail):'')}}>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        FECHA DE NACIMIENTO <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione de acuerdo a la fecha de nacimiento en su cedula
                    </label>
                    <input required type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                           value={{(!empty($usuario)?($usuario->fecha_nacimiento):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Selecciona
                        Pais</label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione Tu pais de Residencia <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <select name="id_pais" id="id_pais" class="form-control">
                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Selecciona
                        Departamento</label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione Tu Departamento de Residencia <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <select name="id_departamento" id="id_departamento" class="form-control">

                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Selecciona
                        Ciudad/municipio</label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione Tu Ciudad de Residencia <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <select name="id_ciudad" id="id_ciudad" class="form-control">

                    </select>
                </fieldset>


                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">
                        Localidad <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione la localidad de residencia a la cual corresponde la dirección digitada
                    </label>
                    <select name="id_localidad" id="id_localidad" class="form-control">

                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">
                        Barrio de Residencia <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label><br>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Por favor escribir el barrio de la dirección digitada anteriormente
                    </label>
                    <input required type="text" class="form-control" id="barrio" name="barrio" id="barrio"
                           value={{(!empty($usuario)?($usuario->barrio):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Direccion <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Colocar la información correspondiente y completa a su sitio de residencia actual (ser lo más
                        exactos - Interior, Bloque, Apartamento, Torre, etc)
                    </label>
                    <input required type="text" class="form-control" id="direccion" name="direccion"
                           value={{(!empty($usuario)?($usuario->direccion):'')}} >
                </fieldset>

            </div>
        </div>
        </section>


        <div class="panel panel-default">
            <div class="panel-heading">Datos personales</div>
            <div class="panel-body">

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Estado
                        civil<span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <select required name="estado_civil" id="estado_civil" class="form-control">
                        <option value="">Elige</option>
                        <option value="1" {{(!empty($usuario)?($usuario->genero == 'Soltero' ? 'selected' : ''):'')}}>
                            Soltero
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->genero == 'Casado' ? 'selected' : ''):'')}}>
                            Casado
                        </option>
                        <option value="3" {{(!empty($usuario)?($usuario->genero == 'Separado' ? 'selected' : ''):'')}}>
                            Separado
                        </option>
                        <option value="4" {{(!empty($usuario)?($usuario->genero == 'Divorciado' ? 'selected' : ''):'')}}>
                            Divorciado
                        </option>
                        <option value="5" {{(!empty($usuario)?($usuario->genero == 'Unión libre' ? 'selected' : ''):'')}}>
                            Unión libre
                        </option>
                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Sexo <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione su género
                    </label>
                    <select required name="sexo" id="sexo" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->genero == 'Masculino' ? 'selected' : ''):'')}}>
                            Masculino
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->genero == 'Femenino' ? 'selected' : ''):'')}}>
                            Femenino
                        </option>
                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">País de
                        nacimient<span style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <select name="id_pais_nacimiento" id="id_pais_nacimiento" class="form-control">
                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Departamento de
                        nacimiento<span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <select name="id_departamento_nacimiento" id="id_departamento_nacimiento" class="form-control">

                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Selecciona
                        Ciudad/municipio <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <input type="text" name="otra_ciudad" id="otra_ciudad" class="form-control">
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Selecciona
                        Si eligió otra ciudad o municipio, por favor escribir cual
                        <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <select name="id_ciudad_nacimiento" id="id_ciudad_nacimiento" class="form-control">

                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6" id="datos-militar">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Tiene situación
                        Militar definida? <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Por favor seleccionar SI (tiene la tarjeta militar) y No (si esta en proceso por algún motivo)
                    </label>
                    <select name="situacion_militar" id="situacion_militar" class="form-control">

                        <option value="1" {{(!empty($usuario)?($usuario->genero == 'Si' ? 'selected' : ''):'')}}>Si
                        </option>
                        <option value="2" selected>No</option>
                    </select>

                </fieldset>


                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Se reconoce como parte de una población focalizada <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Grupo Étnico; Personas con discapacidad; Víctimas del conflicto armado; Personas en proceso de
                        reintegración, entre otros
                    </label>
                    <select required name="reconoce" id="reconoce" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->reconoce == 'Si' ? 'selected' : ''):'')}} >
                            Si
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->reconoce == 'No' ? 'selected' : ''):'')}}>
                            No
                        </option>

                    </select>
                </fieldset>


                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Grupo étnico <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>

                    <select required name="comunidades" id="comunidades" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->comunidades == 'Ninguna' ? 'selected' : ''):'')}} >
                            Ninguna
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->comunidades == 'Afrocolombiano' ? 'selected' : ''):'')}}>
                            Afrocolombiano
                        </option>
                        <option value="3" {{(!empty($usuario)?($usuario->comunidades == 'LGBTI' ? 'selected' : ''):'')}}>
                            Indigenas
                        </option>
                        <option value="4" {{(!empty($usuario)?($usuario->comunidades == 'Indígena' ? 'selected' : ''):'')}}>
                            Negros
                        </option>
                        <option value="5" {{(!empty($usuario)?($usuario->comunidades == 'Indígena' ? 'selected' : ''):'')}}>
                            Palenqueros
                        </option>
                        <option value="6" {{(!empty($usuario)?($usuario->comunidades == 'Indígena' ? 'selected' : ''):'')}}>
                            Raizales
                        </option>
                        <option value="6" {{(!empty($usuario)?($usuario->comunidades == 'Indígena' ? 'selected' : ''):'')}}>
                            Rrom
                        </option>
                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6" id="datos-militar">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Tipo población
                        focalizada <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                    </label>
                    <select required name="tipo_poblacion" id="tipo_poblacion" class="form-control">
                        option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->tipo_poblacion == 'Ninguna' ? 'selected' : ''):'')}} >
                            Ninguna
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->tipo_poblacion == 'Personas en proceso de reintegración' ? 'selected' : ''):'')}}>
                            Personas en proceso de reintegración
                        </option>
                        <option value="3" {{(!empty($usuario)?($usuario->tipo_poblacion == 'LGBTI' ? 'Personas en discapacidad' : ''):'')}}>
                            Personas en discapacidad
                        </option>
                    </select>
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Condición de discapacidad<span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>

                    <select required name="condicion" id="condicion" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->condicion == 'Ninguna' ? 'selected' : ''):'')}} >
                            Ninguna
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->condicion == 'Auditiva' ? 'selected' : ''):'')}}>
                            Auditiva
                        </option>
                        <option value="3" {{(!empty($usuario)?($usuario->condicion == 'Cognitiva o intelectual' ? 'selected' : ''):'')}}>
                            Cognitiva o intelectual
                        </option>
                        <option value="4" {{(!empty($usuario)?($usuario->condicion == 'Fisica' ? 'selected' : ''):'')}}>
                            Fisica
                        </option>
                        <option value="5" {{(!empty($usuario)?($usuario->condicion == 'Fisica' ? 'selected' : ''):'')}}>
                            Mental
                        </option>
                        <option value="6" {{(!empty($usuario)?($usuario->condicion == 'Psicosocial' ? 'selected' : ''):'')}}>
                            Psicosocial
                        </option>
                        <option value="7" {{(!empty($usuario)?($usuario->condicion == 'Sordoceguera' ? 'selected' : ''):'')}}>
                            Sordoceguera
                        </option>
                        <option value="8" {{(!empty($usuario)?($usuario->condicion == 'Visual' ? 'selected' : ''):'')}}>
                            Visual
                        </option>
                        <option value="8" {{(!empty($usuario)?($usuario->condicion == 'Múltiple' ? 'selected' : ''):'')}}>
                            Múltiple
                        </option>
                    </select>
                </fieldset>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">NIVEL EDUCATIVO</div>
            <div class="panel-body">
                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Condición de discapacidad <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <select required name="nivel_educativo" id="nivel_educativo" class="form-control">
                        <option value="1" {{(!empty($usuario)?($usuario->condicion == 'Elige' ? 'selected' : ''):'')}}>
                            Elige
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->condicion == 'Ninguno' ? 'selected' : ''):'')}}>
                            Ninguno
                        </option>
                        <option value="3" {{(!empty($usuario)?($usuario->condicion == 'Preescolar' ? 'selected' : ''):'')}}>
                            Preescolar
                        </option>
                        <option value="4" {{(!empty($usuario)?($usuario->condicion == 'Básica primaria (2-4)' ? 'selected' : ''):'')}}>
                            Básica primaria (2-4)
                        </option>
                        <option value="5" {{(!empty($usuario)?($usuario->condicion == 'Básica secundaria (7-8)' ? 'selected' : ''):'')}}>
                            Básica secundaria (7-8)
                        </option>
                        <option value="6" {{(!empty($usuario)?($usuario->condicion == 'Media (11-12)' ? 'selected' : ''):'')}}>
                            Media (11-12)
                        </option>
                        <option value="7" {{(!empty($usuario)?($usuario->condicion == 'Técnica laboral' ? 'selected' : ''):'')}}>
                            Técnica laboral
                        </option>
                        <option value="8" {{(!empty($usuario)?($usuario->condicion == 'Técnica profesional' ? 'selected' : ''):'')}}>
                            Técnica profesional
                        </option>
                        <option value="9" {{(!empty($usuario)?($usuario->condicion == 'Tecnológica' ? 'selected' : ''):'')}}>
                            Tecnológica
                        </option>
                        <option value="10" {{(!empty($usuario)?($usuario->condicion == 'Universitaria' ? 'selected' : ''):'')}}>
                            Universitaria
                        </option>
                        <option value="11" {{(!empty($usuario)?($usuario->condicion == 'Especialización' ? 'selected' : ''):'')}}>
                            Especialización
                        </option>
                        <option value="12" {{(!empty($usuario)?($usuario->condicion == 'Maestría' ? 'selected' : ''):'')}}>
                            Maestría
                        </option>
                        <option value="13" {{(!empty($usuario)?($usuario->condicion == 'Doctorado' ? 'selected' : ''):'')}}>
                            Doctorado
                        </option>
                    </select>
                </fieldset>
                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Estado de escolaridad <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <select required name="escolaridad" id="escolaridad" class="form-control">
                        <option {{(!empty($usuario)?($usuario->condicion == 'Elige' ? 'selected' : ''):'')}} value="1">
                            Elige
                        </option>
                        <option {{(!empty($usuario)?($usuario->condicion == 'Ninguno' ? 'selected' : ''):'')}} value="2">
                            Ninguno
                        </option>
                        <option {{(!empty($usuario)?($usuario->condicion == 'En curso' ? 'selected' : ''):'')}} value="3">
                            En curso
                        </option>
                        <option {{(!empty($usuario)?($usuario->condicion == 'Incompleto' ? 'selected' : ''):'')}} value="4">
                            Incompleto
                        </option>
                        <option {{(!empty($usuario)?($usuario->condicion == 'Graduado' ? 'selected' : ''):'')}} value="5">
                            Graduado
                        </option>
                    </select>
                </fieldset>
                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Fecha de culminación de estudio más alto <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        En caso de no tener la fecha dejar en blanco
                    </label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                           value={{(!empty($usuario)?($usuario->fecha_estudio):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Titulo
                        obtenido </label>
                    <input type="text" class="form-control" id="titulo_obtenido" name="titulo_obtenido"
                           value={{(!empty($usuario)?($usuario->titulo_obtenido):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Institución
                        <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span></label>
                    <input type="text" class="form-control" id="institucion_titulo_obtenido"
                           name="institucion_titulo_obtenido"
                           value={{(!empty($usuario)?($usuario->institucion_titulo_obtenido):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Número de
                        tarjeta profesional </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        En caso de no tener tarjeta profesional, dejar el campo vacío
                    </label>
                    <input type="text" class="form-control" id="targeta_profesional" name="targeta_profesional"
                           value={{(!empty($usuario)?($usuario->targeta_profesional):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Tiene practica
                        laboral <span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span</label>
                    <select name="practica_laboral" id="practica_laboral" class="form-control">

                        <option value="1" {{(!empty($usuario)?($usuario->practica_laboral == 'Si' ? 'selected' : ''):'')}}>
                            Si
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->practica_laboral == 'No' ? 'selected' : ''):'')}}>
                            No
                        </option>
                    </select>
                </fieldset>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">EXPERIENCIAS LABORALES</div>
            <div class="panel-body">
                <fieldset class="form-group col-sm-12">
                    EXPERIENCIA LABORAL 1
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Tipo de
                        experiencia laboral 1<span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span</label>
                    <select name="practica_laboral[0]" id="practica_laboral" class="form-control">
                        <option value="" {{(!empty($usuario)?($usuario->practica_laboral[0] == 'Elige' ? 'selected' : ''):'')}} >
                            Elige
                        </option>
                        <option value="" {{(!empty($usuario)?($usuario->practica_laboral[0] == 'Asalariado' ? 'selected' : ''):'')}} >
                            Asalariado
                        </option>
                        <option value="" {{(!empty($usuario)?($usuario->practica_laboral[0] == 'Independiente' ? 'selected' : ''):'')}} >
                            Independiente
                        </option>
                        <option value="" {{(!empty($usuario)?($usuario->practica_laboral[0] == 'Pasantía o práctica laboral' ? 'selected' : ''):'')}} >
                            Pasantía o práctica laboral
                        </option>
                    </select>
                </fieldset>


                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Nombre de la
                        empresa 1 </label>
                    <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa[0]"
                           value={{(!empty($usuario)?($usuario->nombre_empresa[0]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Sector 1</label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">Actividad
                        de la empresa</label>
                    <input type="text" class="form-control" id="sector_empresa" name="sector_empresa[0]"
                           value={{(!empty($usuario)?($usuario->sector_empresa[0]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Teléfono de la
                        empresa 1</label>
                    <input type="text" class="form-control" id="telefono_empresa" name="telefono_empresa[0]"
                           value={{(!empty($usuario)?($usuario->telefono_empresa[0]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Fecha de inicio
                        1</label><label class="freebirdFormviewerViewItemsPagebreakDescriptionText"
                                        style="font-size:15px">Fecha
                    </label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio[0]"
                           value={{(!empty($usuario)?($usuario->fecha_inicio[0]):'')}} >
                </fieldset>


                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Fecha de
                        finalización 1</label><label class="freebirdFormviewerViewItemsPagebreakDescriptionText"
                                                     style="font-size:15px">Fecha
                    </label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_final[0]"
                           value={{(!empty($usuario)?($usuario->fecha_final[0]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Cargo 1</label>
                    <input type="text" class="form-control" id="cargo" name="cargo[0]"
                           value={{(!empty($usuario)?($usuario->fecha_final[0]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Área de trabajo
                        1</label>
                    <input type="text" class="form-control" id="area_trabajo" name="area_trabajo[0]"
                           value={{(!empty($usuario)?($usuario->area_trabajo[0]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Funciones y logros
                    1</label>
                <input type="text" class="form-control" id="funciones" name="funciones[0]"
                       value={{(!empty($usuario)?($usuario->funciones[0]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-12">
                    EXPERIENCIA LABORAL 2
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Tipo de
                        experiencia laboral 2<span
                                style="color: red;font-size: 13px;text-transform: capitalize;color:red">*</span</label>
                    <select name="practica_laboral[1]" id="practica_laboral" class="form-control">
                        <option value="1" {{(!empty($usuario)?($usuario->practica_laboral[1] == 'Elige' ? 'selected' : ''):'')}} >
                            Elige
                        </option>
                        <option value="2" {{(!empty($usuario)?($usuario->practica_laboral[1] == 'Asalariado' ? 'selected' : ''):'')}} >
                            Asalariado
                        </option>
                        <option value="3" {{(!empty($usuario)?($usuario->practica_laboral[1] == 'Independiente' ? 'selected' : ''):'')}} >
                            Independiente
                        </option>
                        <option value="4" {{(!empty($usuario)?($usuario->practica_laboral[1] == 'Pasantía o práctica laboral' ? 'selected' : ''):'')}} >
                            Pasantía o práctica laboral
                        </option>
                    </select>
                </fieldset>


                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Nombre de la
                        empresa 2 </label>
                    <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa[1]"
                           value={{(!empty($usuario)?($usuario->nombre_empresa[1]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Sector 2</label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">Actividad
                        de la empresa</label>
                    <input type="text" class="form-control" id="sector_empresa" name="sector_empresa[1]"
                           value={{(!empty($usuario)?($usuario->sector_empresa[1]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Teléfono de la
                        empresa 2</label>
                    <input type="text" class="form-control" id="telefono_empresa" name="telefono_empresa[1]"
                           value={{(!empty($usuario)?($usuario->telefono_empresa[1]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Fecha de inicio
                        2</label><label class="freebirdFormviewerViewItemsPagebreakDescriptionText"
                                        style="font-size:15px">Fecha
                    </label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio[1]"
                           value={{(!empty($usuario)?($usuario->fecha_inicio[1]):'')}} >
                </fieldset>


                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Fecha de
                        finalización 2</label><label class="freebirdFormviewerViewItemsPagebreakDescriptionText"
                                                     style="font-size:15px">Fecha
                    </label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_final[1]"
                           value={{(!empty($usuario)?($usuario->fecha_final[1]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Cargo 2</label>
                    <input type="text" class="form-control" id="cargo" name="cargo[1]"
                           value={{(!empty($usuario)?($usuario->fecha_final[1]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Área de trabajo
                        2</label>
                    <input type="text" class="form-control" id="area_trabajo" name="area_trabajo[1]"
                           value={{(!empty($usuario)?($usuario->area_trabajo[1]):'')}} >
                </fieldset>

                <fieldset class="form-group col-sm-6">
                <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Funciones y logros
                    2</label>
                <input type="text" class="form-control" id="funciones" name="funciones[1]"
                       value={{(!empty($usuario)?($usuario->funciones[1]):'')}} >
                </fieldset>
                <fieldset class="form-group col-sm-12">
                    OTROS CONOCIMIENTOS Y HABILIDADES
                </fieldset>

                <fieldset class="form-group col-sm-6">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Mencione brevemente conocimientos o habilidades que tiene.</label>
                    <textarea  class="form-control" id="conocimientos_habilidades" name="conocimientos_habilidades">
                        {{(!empty($usuario)?($usuario->conocimientos_habilidades):'')}} </textarea>
                </fieldset>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">EDUCACIÓN INFORMAL</div>
            <div class="panel-body">

            <div class="freebirdFormviewerViewItemsPagebreakDescriptionText">Referenciar las dos últimas o más
                representativas capacitaciones o certificaciones, en dado caso de no contar con ellas, dejar los campos
                en blanco.
            </div>
            <div role="heading" jsname="bLLMxc"
                 class="freebirdMaterialHeaderbannerLabelContainer freebirdFormviewerViewItemsSectionheaderBanner">
                <div class="freebirdMaterialHeaderbannerLabelTextContainer freebirdSolidBackground">
                    <div class="freebirdMaterialHeaderbannerSectionText freebirdFormviewerViewItemsSectionheaderBannerText">
                        EDUCACIÓN INFORMAL
                    </div>
                </div>

            </div>
            <div class="freebirdMaterialHeaderbannerLabelTextContainer freebirdSolidBackground"><div class="freebirdMaterialHeaderbannerSectionText freebirdFormviewerViewItemsSectionheaderBannerText">CAPACITACIÓN O CERTIFICACIÓN No 1</div></div>
            </div>


            <fieldset class="form-group col-sm-6">
                <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Tipo de capacitación o certificación 1</label>
                <select name="tipo_certificacion[1]" id="tipo_certificacion" class="form-control">
                    <option value="1" {{(!empty($usuario)?($usuario->tipo_certificacion[1] == 'Elige' ? 'selected' : ''):'')}}>Elige</option>
                    <option value="2" {{(!empty($usuario)?($usuario->tipo_certificacion[1] == 'Curso' ? 'selected' : ''):'')}}>Curso</option>
                    <option value="3" {{(!empty($usuario)?($usuario->tipo_certificacion[1] == 'Taller' ? 'selected' : ''):'')}}>Taller</option>
                    <option value="4" {{(!empty($usuario)?($usuario->tipo_certificacion[1] == 'Diplomado' ? 'selected' : ''):'')}}>Diplomado</option>
                    <option value="5" {{(!empty($usuario)?($usuario->tipo_certificacion[1] == 'Seminario' ? 'selected' : ''):'')}}>Seminario</option>
                    <option value="6" {{(!empty($usuario)?($usuario->tipo_certificacion[1] == 'Certificación de competencias' ? 'selected' : ''):'')}}>Certificación de competencias</option>
                </select>
            </fieldset>

            <fieldset class="form-group col-sm-6">
                <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Nombre del programa 1</label>
                <input type="text" class="form-control" id="nombre_programa[1]" name="nombre_programa"
                       value={{(!empty($usuario)?($usuario->nombre_programa[1]):'')}} >
            </fieldset>


        </div>


    </form>
    <?php } ?>
    <script type="text/javascript" src="{{asset('public/Js/form.js')}}"></script>

    @if(!empty($usuario))
        <script>

            setTimeout(function () {

                $('select[name=id_pais]').val('{{$usuario->id_pais}}');
                $('select[name=id_departamento]').val('{{$usuario->id_departamento}}');
                $('select[name=id_ciudad]').val('{{$usuario->id_ciudad}}');

            }, 3000);
        </script>

    @endif
@stop

