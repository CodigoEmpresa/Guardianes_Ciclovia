<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pais;
use App\User;
use App\Acceso;
use Idrd\Usuarios\Repo\Departamento;
use Idrd\Usuarios\Repo\Localidad;
use Idrd\Usuarios\Repo\PersonaInterface;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function insertar(Request $request)
    {
        //dd($request);

        $actual = User::where('cedula', $request->cedula)->first();
        if ($actual) {
            $request->flush();
            return redirect('/')->with(['error'=>"El documento ya se encuentra registrado"])
                                    ->withInput();
        }


            $usuario = new User;


            $usuario->cedula = $request->cedula;
            $usuario->tipo_documento = $request->tipo_documento;
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->mail = $request->mail;
            $usuario->fecha_nacimiento = $request->fecha_nacimiento;
            $usuario->id_pais = $request->id_pais;
            $usuario->id_departamento = $request->id_departamento;
            $usuario->id_ciudad = $request->id_ciudad;
            $usuario->id_localidad = $request->id_localidad;
            $usuario->barrio = $request->barrio;
            $usuario->direccion = $request->direccion;
            $usuario->telefono = $request->telefono;
            $usuario->estado_civil = $request->estado_civil;
            $usuario->sexo = $request->sexo;
            $usuario->id_pais_nacimiento = $request->id_pais_nacimiento;
            $usuario->id_departamento_nacimiento = $request->id_departamento_nacimiento;
            $usuario->id_ciudad_nacimiento = $request->id_ciudad_nacimiento;
            $usuario->otra_ciudad = $request->otra_ciudad;
            $usuario->situacion_militar = $request->situacion_militar;
            $usuario->reconoce = $request->reconoce;
            $usuario->comunidades = $request->comunidades;
            $usuario->tipo_poblacion = $request->tipo_poblacion;
            $usuario->condicion = $request->condicion;
            $usuario->nivel_educativo = $request->nivel_educativo;
            $usuario->escolaridad = $request->escolaridad;
            $usuario->fecha_estudio = $request->fecha_estudio;
            $usuario->titulo_obtenido = $request->titulo_obtenido;
            $usuario->institucion_titulo_obtenido = $request->institucion_titulo_obtenido;
            $usuario->targeta_profesional = $request->targeta_profesional;
            $usuario->practica_laboral_select = $request->practica_laboral_select;
            $usuario->practica_laboral = json_encode($request->practica_laboral);
            $usuario->nombre_empresa = json_encode($request->nombre_empresa);
            $usuario->sector_empresa = json_encode($request->sector_empresa);
            $usuario->telefono_empresa = json_encode($request->telefono_empresa);
            $usuario->fecha_inicio = json_encode($request->fecha_inicio);
            $usuario->fecha_final = json_encode($request->fecha_final);
            $usuario->cargo = json_encode($request->cargo);
            $usuario->area_trabajo = json_encode($request->area_trabajo);
            $usuario->funciones = json_encode($request->funciones);
            $usuario->conocimientos_habilidades = $request->conocimientos_habilidades;
            $usuario->tipo_certificacion = json_encode($request->tipo_certificacion);
            $usuario->nombre_certificacion = json_encode($request->nombre_certificacion);
            $usuario->estado_certificacion = json_encode($request->estado_certificacion);
            $usuario->duracion_certificacion = json_encode($request->duracion_certificacion);
            $usuario->institucion_certificacion = json_encode($request->institucion_certificacion);
            $usuario->nombre_programa = json_encode($request->nombre_programa);
            $usuario->conocimientos_habilidades_certificacion = $request->conocimientos_habilidades_certificacion;
            $usuario->perfil_laboral = $request->perfil_laboral;
            $usuario->aspiracion_salarial = $request->aspiracion_salarial;
            $usuario->posibilidad_viajar = $request->posibilidad_viajar;
            $usuario->teletrabajo = $request->teletrabajo;
            $usuario->situacion_laboral = $request->situacion_laboral;
            $usuario->propietario_transporte = $request->propietario_transporte;
            $usuario->licencia_conducion = $request->licencia_conducion;
            $usuario->categoria_licencia = $request->categoria_licencia;
            $usuario->intereses_ocupacionales = $request->intereses_ocupacionales;
            $usuario->idioma = json_encode($request->idioma);
            $usuario->idioma_nivel = json_encode($request->idioma_nivel);
            $usuario->dispone_tiempo = $request->dispone_tiempo;
            $usuario->presentacion_personal = $request->presentacion_personal;
            $usuario->comprende_acepta = $request->comprende_acepta;
            $usuario->bicicleta_todoterreno = $request->bicicleta_todoterreno;
            $usuario->afiliado = $request->afiliado;
            $usuario->seguridad_social_otro = $request->seguridad_social_otro;
            $usuario->antecedente_salud = $request->antecedente_salud;
            $usuario->opcional_antecedente = $request->opcional_antecedente;
            $usuario->acepto_terminos = $request->acepto_terminos;
            $usuario->firma = $request->firma;
            $usuario->save();

            return view('notificacion', ['datos' => 'Registro completo']);

    }


    private function cifrar($M)

    {   
      $C="";

        $k = 18; 

      for($i=0; $i<strlen($M); $i++)$C.=chr((ord($M[$i])+$k)%255);

      return $C;

    }



    private function decifrar($C)

    {   

      $M="";

      $k = 18;

      for($i=0; $i<strlen($C); $i++)$M.=chr((ord($C[$i])-$k+255)%255);

      return $M;

    }

    public function listar_datos(){

    $acceso = User::whereYear('created_at', '=', date('Y'))->get(); 

    $tabla='<table id="lista">
            <thead>
              <tr>
                      <th>Marca temporal</th>
                      <th>Tipo de documento </th>
                      <th>Número de documento</th>
                      <th>Apellidos y nombres </th>
                      <th>Correo electrónico </th>
                      <th>Fecha de nacimiento </th>
                      <th>País de residencia </th>
                      <th>Departamento de residencia </th>
                      <th>Ciudad/municipio de residencia </th>
                      <th>Si eligió otra ciudad o municipio, por favor escribir cual </th>
                      <th>Localidad de residencia </th>
                      <th>Barrio</th>
                      <th>Dirección de residencia </th>
                      <th>Teléfono de contacto </th>
                      <th>Estado civil </th>
                      <th>Sexo</th>
                      <th>País de nacimiento </th>
                      <th>Departamento de nacimiento </th>
                      <th>Ciudad/municipio de nacimiento </th>
                      <th>Si eligió otra ciudad o municipio, por favor escribir cual </th>
                      <th>Situación militar</th>
                      <th>Se reconoce como parte de una población focalizada</th>
                      <th>Grupo étnico</th>
                      <th>Tipo de población focalizada </th>
                      <th>Condición de discapacidad </th>
                      <th>Grado más alto de escolaridad</th>
                      <th>Estado de escolaridad </th>
                      <th>Fecha de culminación de estudio más alto </th>
                      <th>Titulo obtenido </th>
                      <th>Institución</th>
                      <th>Número de tarjeta profesional </th>
                      <th>Tiene practica laboral </th>
                      <th>Tipo de experiencia laboral 1</th>
                      <th>Nombre de la empresa 1</th>
                      <th>Sector 1</th>
                      <th>Teléfono de la empresa 1 </th>
                      <th>Fecha de inicio 1 </th>
                      <th>Fecha de finalización 1</th>
                      <th>Cargo 1</th>
                      <th>Área de trabajo 1</th>
                      <th>Funciones y logros 1</th>
                      <th>Tipo de experiencia laboral 2</th>
                      <th>Nombre de la empresa 2 </th>
                      <th>Sector 2</th>
                      <th>Teléfono de la empresa 2</th>
                      <th>Fecha de inicio 2</th>
                      <th>Fecha de finalización 2</th>
                      <th>Cargo 2</th>
                      <th>Área de trabajo 2 </th>
                      <th>Funciones y logros 2</th>
                      <th>Tipo de capacitación o certificación 1</th>
                      <th>Nombre del programa 1</th>
                      <th>Estado 1</th>
                      <th>Duración en horas 1</th>
                      <th>Nombre de la Institución 1</th>
                      <th>Tipo de capacitación o certificación 2</th>
                      <th>Nombre del programa 2</th>
                      <th>Estado 2</th>
                      <th>Duración en horas 2</th>
                      <th>Nombre de la Institución 2</th>
                      <th>Mencione brevemente conocimientos o habilidades que tiene.</th>
                      <th>Mencione su perfil laboral</th>
                      <th>Aspiración Salarial</th>
                      <th>Posibilidad de viajar</th>
                      <th>Interés en ofertas de teletrabajo</th>
                      <th>Situación laboral actual</th>
                      <th>Propiedad de medio de transporte</th>
                      <th>Licencia de conducción</th>
                      <th>Categoría de la licencia de conducción</th>
                      <th>Intereses ocupacionales</th>
                      <th>Idiomas y dialectos No 1</th>
                      <th>Nivel de idioma No 1</th>
                      <th>Idiomas y dialectos No 2</th>
                      <th>Nivel idioma No 2</th>
                      <th>Dispone de tiempo los días domingos y festivos entre las 6:00 am y las 4:00 pm </th>
                      <th>Esta dispuesto a cumplir con una presentación personal acorde a las directrices del IDRD</th>
                      <th>Comprende y acepta que inasistir reiteradamente a jornadas durante la etapa de preparación y acondicionamiento (justificadas e injustificadas), generan la exclusión del proceso</th>
                      <th>Cuenta con bicicleta todo terreno</th>
                      <th>Se encuentra actualmente afiliado a un prestador del servicio del sistema de seguridad social en salud (Cotizante, beneficiario o dependiente).</th>
                      <th>Tiene algún antecedente de salud, física y/o psicológica que le impida realizar alguna actividad  </th>
                      <th>Si su respuesta es afirmativa, indique el antecedente </th>
                      <th>Acepto términos y condiciones</th>
                      <th>Acepto tratamiento de datos personales</th>
                      <th>FIRMA</th>
                  </tr>
                </thead>
        <tbody id="tabla">';

          foreach ($acceso as $key => $value) {
            $tabla.='<tr>';
            $tabla.='<td>'.$value->created_at.'</td>';
            $tabla.='<td>'.$value->tipo_documento.'</td>';
            $tabla.='<td>'.$value->cedula.'</td>';
            $tabla.='<td>'.$value->nombres.' '.$value->apellidos.'</td>';
            $tabla.='<td>'.$value->mail.'</td>';
            $tabla.='<td>'.$value->fecha_nacimiento.'</td>';
            $tabla.='<td>'.$value->id_pais.'</td>';
            $tabla.='<td>'.$value->id_departamento.'</td>';
            $tabla.='<td>'.$value->id_ciudad.'</td>';
            $tabla.='<td></td>';
            $tabla.='<td>'.$value->id_localidad.'</td>';
            $tabla.='<td>'.$value->barrio.'</td>';
            $tabla.='<td>'.$value->direccion.'</td>';
            $tabla.='<td>'.$value->telefono.'</td>';
            $tabla.='<td>'.$value->estado_civil.'</td>';
            $tabla.='<td>'.$value->sexo.'</td>';
            $tabla.='<td>'.$value->id_pais_nacimiento.'</td>';
            $tabla.='<td>'.$value->id_departamento_nacimiento.'</td>';
            $tabla.='<td>'.$value->id_ciudad_nacimiento.'</td>';
            $tabla.='<td>'.$value->otra_ciudad.'</td>';
            $tabla.='<td>'.$value->situacion_militar.'</td>';
            $tabla.='<td>'.$value->reconoce.'</td>';
            $tabla.='<td>'.$value->comunidades.'</td>';
            $tabla.='<td>'.$value->tipo_poblacion.'</td>';
            $tabla.='<td>'.$value->condicion.'</td>';
            $tabla.='<td>'.$value->nivel_educativo.'</td>';
            $tabla.='<td>'.$value->escolaridad.'</td>';
            $tabla.='<td>'.$value->fecha_estudio.'</td>';
            $tabla.='<td>'.$value->titulo_obtenido.'</td>';
            $tabla.='<td>'.$value->institucion_titulo_obtenido.'</td>';
            $tabla.='<td>'.$value->targeta_profesional.'</td>';
            $tabla.='<td>'.$value->practica_laboral_select.'</td>';
            $tabla.='<td>'.json_decode($value->practica_laboral)[0].'</td>';
            $tabla.='<td>'.json_decode($value->nombre_empresa)[0].'</td>';
            $tabla.='<td>'.json_decode($value->sector_empresa)[0].'</td>';
            $tabla.='<td>'.json_decode($value->telefono_empresa)[0].'</td>';
            $tabla.='<td>'.json_decode($value->fecha_inicio)[0].'</td>';
            $tabla.='<td>'.json_decode($value->fecha_final)[0].'</td>';
            $tabla.='<td>'.json_decode($value->cargo)[0].'</td>';
            $tabla.='<td>'.json_decode($value->area_trabajo)[0].'</td>';
            $tabla.='<td>'.json_decode($value->funciones)[0].'</td>';
            $tabla.='<td>'.json_decode($value->practica_laboral)[1].'</td>';
            $tabla.='<td>'.json_decode($value->nombre_empresa)[1].'</td>';
            $tabla.='<td>'.json_decode($value->sector_empresa)[1].'</td>';
            $tabla.='<td>'.json_decode($value->telefono_empresa)[1].'</td>';
            $tabla.='<td>'.json_decode($value->fecha_inicio)[1].'</td>';
            $tabla.='<td>'.json_decode($value->fecha_final)[1].'</td>';
            $tabla.='<td>'.json_decode($value->cargo)[1].'</td>';
            $tabla.='<td>'.json_decode($value->area_trabajo)[1].'</td>';
            $tabla.='<td>'.json_decode($value->funciones)[1].'</td>';
            $tabla.='<td>'.json_decode($value->tipo_certificacion)[0].'</td>';
            $tabla.='<td>'.json_decode($value->nombre_certificacion)[0].'</td>';
            $tabla.='<td>'.json_decode($value->estado_certificacion)[0].'</td>';
            $tabla.='<td>'.json_decode($value->duracion_certificacion)[0].'</td>';
            $tabla.='<td>'.json_decode($value->institucion_certificacion)[0].'</td>';
            $tabla.='<td>'.json_decode($value->tipo_certificacion)[1].'</td>';
            $tabla.='<td>'.json_decode($value->nombre_certificacion)[1].'</td>';
            $tabla.='<td>'.json_decode($value->estado_certificacion)[1].'</td>';
            $tabla.='<td>'.json_decode($value->duracion_certificacion)[1].'</td>';
            $tabla.='<td>'.json_decode($value->institucion_certificacion)[1].'</td>';
            $tabla.='<td>'.$value->conocimientos_habilidades.'</td>';
           // $tabla.='<td>$value->conocimientos_habilidades_certificacion'.$value->conocimientos_habilidades_certificacion.'</td>';
            $tabla.='<td>'.$value->perfil_laboral.'</td>';
            $tabla.='<td>'.$value->aspiracion_salarial.'</td>';
            $tabla.='<td>'.$value->posibilidad_viajar.'</td>';
            $tabla.='<td>'.$value->teletrabajo.'</td>';
            $tabla.='<td>'.$value->situacion_laboral.'</td>';
            $tabla.='<td>'.$value->propietario_transporte.'</td>';
            $tabla.='<td>'.$value->licencia_conducion.'</td>';
            $tabla.='<td>'.$value->categoria_licencia.'</td>';
            $tabla.='<td>'.$value->intereses_ocupacionales.'</td>';
            $tabla.='<td>'.json_decode($value->idioma)[0].'</td>';
            $tabla.='<td>'.json_decode($value->idioma_nivel)[0].'</td>';
            $tabla.='<td>'.json_decode($value->idioma)[1].'</td>';
            $tabla.='<td>'.json_decode($value->idioma_nivel)[1].'</td>';
            $tabla.='<td>'.$value->dispone_tiempo.'</td>';
            $tabla.='<td>'.$value->presentacion_personal.'</td>';
            $tabla.='<td>'.$value->comprende_acepta.'</td>';
            $tabla.='<td>'.$value->bicicleta_todoterreno.'</td>';
            $tabla.='<td>'.$value->afiliado.'</td>';
            //$tabla.='<td>$value->seguridad_social_otro'.$value->seguridad_social_otro.'</td>';
            $tabla.='<td>'.$value->antecedente_salud.'</td>';
            $tabla.='<td>'.$value->opcional_antecedente.'</td>';
            $tabla.='<td>'.$value->acepto_terminos.'</td>';
            $tabla.='<td>si</td>';
            $tabla.='<td>'.$value->firma.'</td>';
            $tabla.='</tr>';
      }
      $tabla.='</tbody></table>';

      echo $tabla;

    }

     public function logear(Request $request){

      $usuario = $request->input('usuario');

      $pass = $request->input('pass');

      $acceso = Acceso::where('Usuario',$usuario)->where('Contrasena', sha1($this->cifrar($pass)) )->first();

      if (empty($acceso)) { return view('error',['error' => 'Usuario o contraseña invalida!'] ); exit(); }
       
      $_SESSION['id_usuario'] = json_encode($acceso);
      
      return view('admin'); exit(); 

      
    }

    private function obtener_edad($date) {

     list($Y,$m,$d) = explode("-",$date);

     return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );

    }


}