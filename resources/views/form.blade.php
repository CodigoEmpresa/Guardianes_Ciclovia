@extends('master')

@section('content')

    <?php


    preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
    if(count($matches)<2){
        preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
    }

    if (count($matches)>1){
        //Then we're using IE
        $version = $matches[1];

        switch(true){
            case ($version<=8):
                echo ':( Tu navegador IE no es compatible por favor utiliza firefox o chrome';
                exit();
                break;

            case ($version==9 || $version==10):
                //IE9 & IE10!
                echo ':( Tu navegador IE no es compatible por favor utiliza firefox o chrome';
                exit();
                break;

            case ($version==11):
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
    </style>
    <?php

    date_default_timezone_set('America/Bogota');
    $today = date("Y-m-d H:i:s");
    $date = "2017-07-31 23:59:00";

    if ( $today > $date  && empty($usuario) ) {


    ?>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

    <h1 style="font-family: 'Noto Sans', sans-serif;" >Inscripción cerrada</h1>

    <?php

    }else{
    ?>
    <input type="hidden" name="url" value="{{url('/')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('public/Css/form.css?n=10')}}">

    <form method="POST" action="{{route('insertar')}}" id="form_gen" enctype="multipart/form-data">
        <input  type="hidden"  id="editar" name="editar" value={{(!empty($usuario)?url_segura('encapsular',$usuario->id):'')}} >
        <div class="panel panel-default">
            <div class="panel-heading"> {{(!empty($usuario)?'Bienvenido de nuevo usuario : '.$usuario->nombres.' '.$usuario->apellido:'Información personal')}}</div>
            <div class="panel-body">

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Documento de identidad <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                    <input title="Se necesita una cedula" required type="number" class="form-control" id="cedula" name="cedula" value={{(!empty($usuario)?$usuario->cedula:'')}} >
                    @if(!empty($usuario) && !empty($usuario->file_cedula))
                        <a class="ficheros" data-toggle="tooltip" title="Ver actual"  href="{{asset('public/Ficheros/'.$usuario->file_cedula)}}" target="_blank" >Ver documento actual
                            <img style="margin: 12px;" src="https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Download-Computer-512.png" height="50" width="50">
                        </a>
                        <textarea type="hidden" style="background: transparent;color: white;resize: none;border: 0 none;height: 0px;" class="form-control" id="actual_file_cedula" name="actual_file_cedula">{{(!empty($usuario)?!empty($usuario->file_cedula)?$usuario->file_cedula:'':'')}}</textarea>
                    @endif
                    <input title="Se necesita una cedula" {{(!empty($usuario)?((!empty($usuario->file_cedula))? '' : ''):'required')}}  type="file" class="form-control" id="file_cedula" name="file_cedula" accept="image/*" >
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Tipo de documento <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione de acuerdo a su documento
                    </label>
                    <select name="tipo_documento" id="tipo_documento" class="form-control" >
                        <option value="1" {{(!empty($usuario)?($usuario->tipo_documento == 1 ? 'selected' : ''):'')}}>Cédula de Ciudadania</option>
                        <option value="2" {{(!empty($usuario)?($usuario->tipo_documento == 2 ? 'selected' : ''):'')}}>Cédula de Extranjeria</option>
                    </select>
                </fieldset>

                <fieldset class="form-group" >
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Apellidos <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligenciar en MAYÚSCULA y tal cual como aparece en el documento de identidad
                    </label>
                    <input required type="text" class="form-control" id="apellidos" name="apellidos"  value={{(!empty($usuario)?$usuario->apellidos:'')}} >
                </fieldset>

                <fieldset class="form-group" >
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Nombres <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligenciar en MAYÚSCULA y tal cual como aparece en el documento de identidad
                    </label>
                    <input required type="text" class="form-control" id="nombres" name="nombres" value={{(!empty($usuario)?$usuario->nombres:'')}}  >
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Fotografia <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                    @if(!empty($usuario) && !empty($usuario->foto))
                        <a class="ficheros" data-toggle="tooltip" title="Ver actual"  href="{{asset('public/uploads/'.$usuario->foto)}}" target="_blank" >Ver documento actual
                            <img style="margin: 12px;" src="https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Download-Computer-512.png" height="50" width="50">
                        </a>
                        <textarea type="hidden" style="background: transparent;color: white;resize: none;border: 0 none;height: 0px;" class="form-control" id="actual_file_foto" name="actual_file_foto" >{{(!empty($usuario)?!empty($usuario->foto)?$usuario->foto:'':'')}}</textarea>
                    @endif
                    <input  {{(!empty($usuario)?((!empty($usuario->foto))? '' : ''):'required')}} type="file" class="file-loading" id="foto" name="foto" accept="image/*">
                </fieldset>
                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        GÉNERO <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione su género
                    </label>
                    <select  required name="genero" id="genero" class="form-control" >
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->genero == 'Masculino' ? 'selected' : ''):'')}}>Masculino</option>
                        <option value="2" {{(!empty($usuario)?($usuario->genero == 'Femenino' ? 'selected' : ''):'')}}>Femenino</option>
                    </select>
                </fieldset>



                <fieldset class="form-group" id="datos-militar">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Tiene situación Militar definida? <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Por favor seleccionar SI (tiene la tarjeta militar) y No (si esta en proceso por algún motivo)
                    </label>
                    <select  name="situacion_militar" id="situacion_militar" class="form-control" >

                        <option value="1" {{(!empty($usuario)?($usuario->genero == 'Si' ? 'selected' : ''):'')}}>Si</option>
                        <option value="2" selected>No</option>
                    </select>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Por favor suba el documento libreta escaneado si aplica.
                    </label>
                    @if(!empty($usuario) && !empty($usuario->file_militar))
                        <a class="ficheros" data-toggle="tooltip" title="Ver actual"  href="{{asset('public/Ficheros/'.$usuario->file_militar)}}" target="_blank" >Ver documento actual
                            <img style="margin: 12px;" src="https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Download-Computer-512.png" height="50" width="50">
                        </a>
                        <textarea type="hidden" style="background: transparent;color: white;resize: none;border: 0 none;height: 0px;" class="form-control" id="actual_file_militar" name="actual_file_militar" >{{(!empty($usuario)?!empty($usuario->file_militar)?$usuario->file_militar:'':'')}}</textarea>
                    @endif
                    <input title="Se necesita una libreta"  type="file" class="form-control" id="file_militar" name="file_militar" accept="image/*">
                </fieldset>
                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        FECHA DE NACIMIENTO  <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione de acuerdo a la fecha de su nacimiento
                    </label>
                    <input required type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value={{(!empty($usuario)?($usuario->fecha_nacimiento):'')}} >
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Selecciona Pais</label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione Tu pais de origen <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <select name="id_pais" id="id_pais" class="form-control" >

                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Selecciona Departamento</label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione Tu Departamento de origen <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <select name="id_departamento" id="id_departamento" class="form-control" >

                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Selecciona Ciudad</label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione Tu Ciudad de origen <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <select name="id_ciudad" id="id_ciudad" class="form-control" >

                    </select>
                </fieldset>


            </div></div>
        </section>



        <div class="panel panel-default">
            <div class="panel-heading">Informacion de contacto</div>
            <div class="panel-body">


                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Direccion <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Colocar la información correspondiente y completa a su sitio de residencia actual (ser lo más exactos - Interior, Bloque, Apartamento, Torre, etc)
                    </label>
                    <input required type="text" class="form-control" id="direccion" name="direccion"  value={{(!empty($usuario)?($usuario->direccion):'')}} >
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">
                        Barrio de Residencia  <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label><br>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Por favor escribir el barrio de la dirección digitada anteriormente
                    </label>
                    <input required type="text" class="form-control" id="barrio" name="barrio" id="barrio" value={{(!empty($usuario)?($usuario->barrio):'')}} >
                </fieldset>

                <fieldset class="form-group">
                    <label  class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">
                        Localidad <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label><br>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione la localidad de residencia a la cual corresponde la dirección digitada
                    </label>
                    <select name="id_localidad" id="id_localidad" class="form-control" >

                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Estrato socioeconomico</label><br>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione de acuerdo a los recibos de servicio de su actual residencia <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <input required type="number" class="form-control" id="estrato" name="estrato"  value={{(!empty($usuario)?($usuario->estrato):'')}}>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Teléfono(s) Fijo(s)</label><br>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligencie el (los) número(s) correspondiente(s) <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <input required type="text" class="form-control" id="tel_fijo" name="tel_fijo"  value={{(!empty($usuario)?($usuario->tel_fijo):'')}} >
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Celular(es) </label>
                    <br><label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Coloque los números correspondientes para tener contacto de manera rápida y oportuna <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <input required type="text" class="form-control" id="celular" name="celular"  value={{(!empty($usuario)?($usuario->celular):'')}}>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">CorreoElectrónico01  </label><br>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligencie la información del correo es necesario que sea gmail <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <input required type="email" class="form-control" id="mail" name="mail"   value={{(!empty($usuario)?($usuario->mail):'')}}>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">CorreoElectrónico02 </label><br>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligencie el correo que desea que le llegue copia de los comunicados
                    </label>
                    <input  type="email" class="form-control" id="mail2" name="mail2" value={{(!empty($usuario)?($usuario->mail2):'')}}  >
                </fieldset>



            </div></div>


        </section>




        <div class="panel panel-default">
            <div class="panel-heading">Educación</div>
            <div class="panel-body"  id="buildyourform">


                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Por favor añada una a una las certificaciones de estudio incluyendo tanto bachiller como tecnicas y/o profesionales
                    </label>
                    <button class="add_field_button ">Agregar<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                </fieldset>

                <div class="input_fields_wrap">
                @if(!empty($usuario) && !empty($usuario->estudios))
                    <?php $estudios_array=json_decode($usuario->estudios); ?>
                    @foreach($estudios_array as $estudio)

                        <!--carrera,estado,institucion,certificado	:-->

                            <div class="row cajas">
                                <fieldset class="form-group col-sm-6"><label for="formGroupExampleInput">Nombre de la Carrera o estudio realizado <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                                    <input required="" type="text" class="form-control" id="carrera[]" name="carrera[]" value={{(!empty($estudio)?($estudio->carrera):'')}} ></fieldset>
                                <fieldset class="form-group col-sm-6">
                                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Estado <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                                    <select required="" name="estado_educativo[]" id="estado_educativo[]" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="1" {{(!empty($estudio)?($estudio->estado =='1' ? 'selected' : ''):'')}}>Actualmente estudiando</option>
                                        <option value="2" {{(!empty($estudio)?($estudio->estado =='2' ? 'selected' : ''):'')}}>Terminacion de materias</option>
                                        <option value="3" {{(!empty($estudio)?($estudio->estado =='3' ? 'selected' : ''):'')}}>Pendiente de grado</option>
                                        <option value="4" {{(!empty($estudio)?($estudio->estado =='4' ? 'selected' : ''):'')}}>Graduado</option>
                                    </select>
                                </fieldset>
                                <fieldset class="form-group col-sm-6"><label for="formGroupExampleInput">Institución educativa <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label>
                                    <input required="" type="text" class="form-control" id="intitucion[]" name="intitucion[]" value={{(!empty($estudio)?($estudio->institucion):'')}}></fieldset>
                                <fieldset class="form-group col-sm-6"> <label for="formGroupExampleInput"> Adjunta certificado  <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span> </label>
                                    <input type="file"  class="form-control" id="certificado[]" name="certificado[]" >
                                    @if(!empty($estudio) && !empty($estudio->certificado))
                                        <a class="ficheros" data-toggle="tooltip" title="Ver actual"  href="{{asset('public/Ficheros/'.$estudio->certificado)}}" target="_blank" >Ver documento actual
                                            <img style="margin: 12px;" src="https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Download-Computer-512.png" height="50" width="50">
                                        </a>
                                        <textarea type="hidden" style="background: transparent;color: white;resize: none;border: 0 none;height: 0px;" class="form-control" id="actual_file_estudio[]" name="actual_file_estudio[]">{{(!empty($estudio)?!empty($estudio->certificado)?$estudio->certificado:'':'')}}</textarea>
                                    @endif
                                </fieldset>
                                <a class="remove_field col-sm-12"><button class="btn btn-danger">Remover</button></a>
                            </div>

                        @endforeach
                    @endif


                </div>




            </div>
        </div>
        </section>




        <div class="panel panel-default">
            <div class="panel-heading">Información Laboral.</div>
            <div class="panel-body">

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Por favor añada una a una las experiencias laborales
                    </label>
                    <button class="add_field_button1 ">Agregar<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                </fieldset>

                <div class="input_fields_wrap1">

                    <!--

                     ultimo_cargo	:	D

                      ultima_empresa	:	Colegio Parroquial Santa Cruz

                      tipo_contrato	:	3

                      fecha_inicio	:	1 de febrero 2016

                      jefe	:	FRAY LUCAS GAMBOA TABORDA

                      tel_jefe	:	4

                      certificado_laboral	:

                    -->

                    @if(!empty($usuario) && !empty($usuario->experiencia))
                        <?php $experiencia_array=json_decode($usuario->experiencia); ?>
                        @foreach($experiencia_array as $experiencia)


                            <div class="row cajas">
                                <fieldset class="form-group col-sm-6"> <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Nombre cargo u objeto <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span> </label> <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">Diligencie la información del cargo u objeto tal cual como aparece en la certificación laboral expedida por la entidad o empresa respectiva.</label>
                                    <input required="" type="text" class="form-control" id="ultimo_cargo[]" name="ultimo_cargo[]"  value={{(!empty($experiencia)?($experiencia->ultimo_cargo):'')}} ></fieldset>
                                <fieldset class="form-group col-sm-6"> <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Nombre empresa <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label> <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">Diligencie el nombre el nombre tal cual como aparece en la certificación laboral expedida.</label>
                                    <input required="" type="text" class="form-control" id="ultima_empresa[]" name="ultima_empresa[]" value={{(!empty($experiencia)?($experiencia->ultima_empresa):'')}}></fieldset>
                                <fieldset class="form-group col-sm-6">
                                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Tipo de contrato <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label> <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">Seleccione el ítem correspondiente</label>
                                    <select required="" name="tipo_contrato[]" id="tipo_contrato[]" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="1" {{(!empty($experiencia)?($experiencia->tipo_contrato =='1' ? 'selected' : ''):'')}}>Contrato de Prestación de Servicio</option>
                                        <option value="2" {{(!empty($experiencia)?($experiencia->tipo_contrato =='2' ? 'selected' : ''):'')}}>Pasantia</option>
                                        <option value="3" {{(!empty($experiencia)?($experiencia->tipo_contrato =='3' ? 'selected' : ''):'')}}>Contrato a Termino fijo</option>
                                        <option value="4" {{(!empty($experiencia)?($experiencia->tipo_contrato =='4' ? 'selected' : ''):'')}}>Contrato a Termino Indefinido</option>
                                        <option value="5" {{(!empty($experiencia)?($experiencia->tipo_contrato =='5' ? 'selected' : ''):'')}}>Contrato por Hojas o Jornadas</option>
                                    </select>
                                </fieldset>
                                <fieldset class="form-group col-sm-6"> <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Fecha de Inicio del contrato <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label> <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">De acuerdo a la certificación expedida por la empresa</label>
                                    <input required="" type="date" class="form-control" id="fecha_inicio[]" name="fecha_inicio[]" value={{(!empty($experiencia)?!empty($experiencia->fecha_inicio)?$experiencia->fecha_inicio:'':'')}} ></fieldset>
                                <fieldset class="form-group col-sm-6"> <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Fecha de Terminacion del contrato <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label> <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">De acuerdo a la certificación expedida por la empresa</label>
                                    <input required="" type="date" class="form-control" id="fecha_final[]" name="fecha_final[]" value={{(!empty($experiencia)?!empty($experiencia->fecha_final)?$experiencia->fecha_final:'':'')}} ></fieldset>
                                <fieldset class="form-group col-sm-6"> <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Nombre del jefe o supervisor inmediato trabajo <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label> <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">Diligenciar el nombre completo en MAYÚSCULA</label>
                                    <input required="" type="text" class="form-control" id="jefe[]" name="jefe[]" value={{(!empty($experiencia)?!empty($experiencia->jefe)?$experiencia->jefe:'':'')}}></fieldset>
                                <fieldset class="form-group col-sm-6"> <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">Teléfono(s) y Celular(es) de contacto del jefe o supervisor de contrato <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span></label> <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">Teléfono(s) y Celular(es) de contacto del jefe o supervisor de contrato</label>
                                    <input required="" type="text" class="form-control" id="tel_jefe[]" name="tel_jefe[]" value={{(!empty($experiencia)?!empty($experiencia->tel_jefe)?$experiencia->tel_jefe:'':'')}}></fieldset>
                                <fieldset class="form-group col-sm-6"> <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2"> Certificacion laboral <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span> </label>
                                    <input  type="file" class="form-control" id="certificado_laboral[]" name="certificado_laboral[]">
                                    @if(!empty($experiencia) && !empty($experiencia->certificado_laboral))
                                        <a class="ficheros" data-toggle="tooltip" title="Ver actual" href="{{asset('public/Ficheros/'.$experiencia->certificado_laboral)}}" target="_blank" >Ver documento actual
                                            <img  style="margin: 12px;" src="https://cdn0.iconfinder.com/data/icons/kameleon-free-pack-rounded/110/Download-Computer-512.png" height="50" width="50">
                                        </a>
                                        <textarea type="hidden" style="background: transparent;color: white;resize: none;border: 0 none;height: 0px;" class="form-control" id="actual_file_experiencia[]" name="actual_file_experiencia[]" >{{(!empty($experiencia)?!empty($experiencia->certificado_laboral)?$experiencia->certificado_laboral:'':'')}}</textarea></fieldset>
                                @endif
                                </fieldset>
                                <a class="remove_field col-sm-12"><button class="btn btn-danger">Remover</button></a>
                            </div>


                        @endforeach
                    @endif

                </div>



            </div>
        </div>
        </section>



        <div class="panel panel-default">
            <div class="panel-heading">Panel Heading</div>
            <div class="panel-body">

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Grupo Sangüineo <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligencie la información correspondiente a la información que aparece en su documento de identidad
                    </label>
                    <select required name="grupo_sanguineo" id="grupo_sanguineo" class="form-control" >
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->grupo_sanguineo == 'A' ? 'selected' : ''):'')}} >A</option>
                        <option value="2" {{(!empty($usuario)?($usuario->grupo_sanguineo == 'B' ? 'selected' : ''):'')}} >B</option>
                        <option value="3" {{(!empty($usuario)?($usuario->grupo_sanguineo == 'AB' ? 'selected' : ''):'')}}>AB</option>
                        <option value="4" {{(!empty($usuario)?($usuario->grupo_sanguineo == 'O' ? 'selected' : ''):'')}}>O</option>
                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        RH <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione de acuerdo al documento de identidad
                    </label>
                    <select required name="rh" id="rh" class="form-control" >}
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->rh == '+' ? 'selected' : ''):'')}}>+</option>
                        <option value="2" {{(!empty($usuario)?($usuario->rh == '-' ? 'selected' : ''):'')}}>-</option>

                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        EPS
                        <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligencie en MAYÚSCULA el nombre de la EPS o Sistema de Salud a la cual se encuentra afiliado(a)
                    </label>
                    <input required type="text" class="form-control" id="eps" name="eps" value={{(!empty($usuario)?($usuario->eps):'')}}  >

                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Enfermedades de base o traumas que presenta a la fecha de inscripción <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligencie este espacio de acuerdo a las patologías, enfermedades o traumas que padece de manera permanente, al momento de la inscripción <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <input required type="text" class="form-control" id="enfermedades" name="enfermedades" value={{(!empty($usuario)?($usuario->enfermedades):'')}}  >

                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Indique si se encuentra en alguna de las siguientes condiciones: <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione a la condición acorde
                    </label>
                    <select required name="condicion" id="condicion" class="form-control" >
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->condicion == 'Ninguna' ? 'selected' : ''):'')}} >Ninguna</option>
                        <option value="2" {{(!empty($usuario)?($usuario->condicion == 'Padre o madre cabeza de hogar' ? 'selected' : ''):'')}}>Padre o madre cabeza de hogar</option>
                        <option value="3" {{(!empty($usuario)?($usuario->condicion == 'Desplazado o Víctima del conflicto armado' ? 'selected' : ''):'')}}>Desplazado o Víctima del conflicto armado</option>
                    </select>
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Indique si pertenece a alguna de las siguientes comunidades: <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione a la condición acorde
                    </label>
                    <select required name="comunidades" id="comunidades" class="form-control" >
                        <option value="">Seleccione</option>
                        <option value="1" {{(!empty($usuario)?($usuario->comunidades == 'Ninguna' ? 'selected' : ''):'')}} >Ninguna</option>
                        <option value="2" {{(!empty($usuario)?($usuario->comunidades == 'Afrocolombiano' ? 'selected' : ''):'')}}>Afrocolombiano</option>
                        <option value="3" {{(!empty($usuario)?($usuario->comunidades == 'LGBTI' ? 'selected' : ''):'')}}>LGBTI</option>
                        <option value="4" {{(!empty($usuario)?($usuario->comunidades == 'Indígena' ? 'selected' : ''):'')}}>Indígena</option>

                    </select>
                </fieldset>


                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Acudiente <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Digite Nombre Acudiente
                    </label>
                    <input required type="text" class="form-control" id="acudiente" name="acudiente" value={{(!empty($usuario)?($usuario->acudiente):'')}} >

                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Parentesco <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Seleccione de acuerdo al nombre
                    </label>
                    <select required name="parentesco" id="parentesco" class="form-control" >
                        <option value="">Seleccione</option>
                        <option value="1"  {{(!empty($usuario)?($usuario->parentesco == 'Padre o Madre' ? 'selected' : ''):'')}} >Padre o Madre</option>
                        <option value="2"  {{(!empty($usuario)?($usuario->parentesco == 'Esposo(a)' ? 'selected' : ''):'')}}>Esposo(a)</option>
                        <option value="3"  {{(!empty($usuario)?($usuario->parentesco == 'Hermano(a)' ? 'selected' : ''):'')}}>Hermano(a)</option>
                        <option value="4"  {{(!empty($usuario)?($usuario->parentesco == 'Abuelo(a)' ? 'selected' : ''):'')}}>Abuelo(a)</option>
                        <option value="5"  {{(!empty($usuario)?($usuario->parentesco == 'Tío(a)' ? 'selected' : ''):'')}}>Tío(a)</option>
                        <option value="6"  {{(!empty($usuario)?($usuario->parentesco == 'Amigo(a)' ? 'selected' : ''):'')}}>Amigo(a)</option>
                    </select>
                </fieldset>


                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput2">
                        Teléfono(s) de Contacto <span style="color: red;font-size: 13px;text-transform: capitalize;color:red">(CAMPO OBLIGATORIO)</span>
                    </label>
                    <label class="freebirdFormviewerViewItemsPagebreakDescriptionText" style="font-size:15px">
                        Diligencie al información acorde
                    </label>
                    <input required type="text" class="form-control" id="tel_contacto" name="tel_contacto" value={{(!empty($usuario)?($usuario->tel_contacto):'')}}  >

                </fieldset>




            </div>
        </div>
        </section>




        <div class="panel panel-default">
            <div class="panel-heading">Panel Heading</div>
            <div class="panel-body">


                <div class="freebirdFormviewerViewFormContent ">
                    <div class="freebirdFormviewerViewHeaderHeader">
                        <div class="freebirdFormviewerViewHeaderTitleRow">
                            <div class="freebirdFormviewerViewHeaderTitle" dir="auto" role="heading" aria-level="1">ESCUELA DE PROFESORES DE ACTIVIDAD FÍSICA EPAF - IDRD {{date('Y')}} </div></div><div class="freebirdFormviewerViewHeaderRequiredLegend" aria-hidden="true" dir="auto">*Obligatorio</div></div><div class="freebirdFormviewerViewItemList" role="list"><div class="freebirdMaterialHeaderbannerLabelContainer freebirdFormviewerViewItemsPagebreakBanner" jsname="bLLMxc" role="heading"><div class="freebirdMaterialHeaderbannerLabelTextContainer freebirdSolidBackground freebirdMaterialHeaderbannerPagebreakBanner"><div class="freebirdMaterialHeaderbannerPagebreakText freebirdFormviewerViewItemsPagebreakBannerText"></div></div></div><div class="freebirdFormviewerViewItemsPagebreakDescriptionText">Certifico que los datos aquí consignados son verdaderos y en caso de verificar dichos datos no son cierto, se anula la respectiva inscripción</div><div role="listitem" class="freebirdFormviewerViewItemsItemItem" jsname="ibnC6b" jscontroller="hIYTQc" jsaction="JIbuQc:qzJD1c;sPvj8e:e4JwSe" data-required="true" data-other-input="qSV85" data-other-hidden="MfYA1e" data-item-id="131124881"><div class="freebirdFormviewerViewItemsItemItemheader"><div class="freebirdFormviewerViewItemsItemItemTitleContainer"><div class="freebirdFormviewerViewItemsItemItemTitle" dir="auto" id="i1" role="heading" aria-level="2" aria-describedby="i.desc.131124881">Términos de inscripción <span class="freebirdFormviewerViewItemsItemRequiredAsterisk" aria-hidden="true">*</span></div><div class="freebirdFormviewerViewItemsItemItemHelpText" id="i.desc.131124881" dir="auto">Usted acepta y cumple con los requisitos exigidos en la presente Resolución</div></div></div><div jsname="JNdkSc" role="group" aria-labelledby="i1" aria-describedby="i.desc.131124881 i.err.131124881 i.req.131124881" class=""><div class="" jsname="MPu53c" jscontroller="GJQA8b" jsaction="JIbuQc:aj0Jcf" data-value="Acepto"><div class="freebirdFormviewerViewItemsCheckboxChoice"><label class="docssharedWizToggleLabeledContainer freebirdFormviewerViewItemsCheckboxContainer"><div class="exportLabelWrapper"><input required type="checkbox"  style="float: left;
margin: 0px;" name="acepto" id="acepto"><div class="docssharedWizToggleLabeledContent"><div class="docssharedWizToggleLabeledPrimaryText"><span dir="auto" class="docssharedWizToggleLabeledLabelText freebirdFormviewerViewItemsCheckboxLabel">Acepto</span></div></div></div></label></div><input name="entry.1642827248" jsname="ekGZBc" disabled="" type="hidden"></div></div><div id="i.req.131124881" class="screenreaderOnly">Obligatorio</div><div jsname="XbIQze" class="freebirdFormviewerViewItemsItemErrorMessage" id="i.err.131124881" role="alert"></div></div></div>
                    <div class="freebirdFormviewerViewNavigationNavControls" jscontroller="lSvzH" jsaction="rcuQ6b:npT2md;JIbuQc:V3upec(GeGHKb),HiUbje(M2UYVd),NPBnCf(OCpkoe)" data-shuffle-seed="-2327421662174229681"><div class="freebirdFormviewerViewNavigationButtonsAndProgress"><div class="freebirdFormviewerViewNavigationButtons"><div role="button" data-id="7" id="atras" class="quantumWizButtonPaperbuttonEl quantumWizButtonPaperbuttonFlat quantumWizButtonPaperbutton2El2 freebirdFormviewerViewNavigationNoSubmitButton" jscontroller="VXdfxd" jsaction="click:cOuCgd; mousedown:UX7yZ; mouseup:lbsD7e; mouseenter:tfO1Yc; mouseleave:JywGue;touchstart:p6p2H; touchmove:FwuNnf; touchend:yfqBxc(preventMouseEvents=true|preventDefault=true); touchcancel:JMtRjd;focus:AHmuwe; blur:O22p3e; contextmenu:mg9Pef;" jsshadow="" jsname="GeGHKb" aria-disabled="false" tabindex="0"><div class="quantumWizButtonPaperbuttonRipple exportInk" jsname="ksKsZd"></div><div class="quantumWizButtonPaperbuttonFocusOverlay exportOverlay"></div><content class="quantumWizButtonPaperbuttonContent"><span class="quantumWizButtonPaperbuttonLabel">Atrás</span></content></div> </div><input class="enviar" type="submit" value="Enviar"></div>


                    </div>
                </div>

            </div>
        </div>
    </form>
    <?php } ?>
    <script type="text/javascript" src="{{asset('public/Js/form.js?n=50')}}" ></script>

    @if(!empty($usuario))
        <script>

            setTimeout(function(){

                $('select[name=id_pais]').val('{{$usuario->id_pais}}');
                $('select[name=id_departamento]').val('{{$usuario->id_departamento}}');
                $('select[name=id_ciudad]').val('{{$usuario->id_ciudad}}');

            }, 3000);
        </script>

    @endif
@stop

