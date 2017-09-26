<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pais;
use App\User;
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


}