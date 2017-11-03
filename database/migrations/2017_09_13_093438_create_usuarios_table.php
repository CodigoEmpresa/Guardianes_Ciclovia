<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

         Schema::create('usuario', function (Blueprint $table) {
             $table->increments('id');
             $table->string('cedula');
             $table->string('tipo_documento');
             $table->string('nombres');
             $table->string('apellidos');
             $table->string('mail');
             $table->string('fecha_nacimiento');
             $table->string('id_pais');
             $table->string('id_departamento');
             $table->string('id_ciudad');
             $table->string('id_localidad');
             $table->string('barrio');
             $table->string('direccion');
             $table->string('estado_civil');
             $table->string('sexo');
             $table->string('id_pais_nacimiento');
             $table->string('id_departamento_nacimiento');
             $table->string('id_ciudad_nacimiento');
             $table->string('otra_ciudad');
             $table->string('situacion_militar');
             $table->string('reconoce');
             $table->string('comunidades');
             $table->string('tipo_poblacion');
             $table->string('condicion');
             $table->string('nivel_educativo');
             $table->string('escolaridad');
             $table->string('fecha_estudio');
             $table->string('titulo_obtenido');
             $table->string('institucion_titulo_obtenido');
             $table->string('targeta_profesional');
             $table->string('practica_laboral_select');
             $table->string('practica_laboral');
             $table->string('nombre_empresa');
             $table->string('sector_empresa');
             $table->string('telefono_empresa');
             $table->string('fecha_inicio');
             $table->string('fecha_final');
             $table->string('cargo');
             $table->string('area_trabajo');
             $table->string('funciones');
             $table->string('conocimientos_habilidades');
             $table->string('tipo_certificacion');
             $table->string('nombre_certificacion');
             $table->string('estado_certificacion');
             $table->string('duracion_certificacion');
             $table->string('institucion_certificacion');
             $table->string('nombre_programa');
             $table->string('conocimientos_habilidades_certificacion');
             $table->string('perfil_laboral');
             $table->string('aspiracion_salarial');
             $table->string('posibilidad_viajar');
             $table->string('teletrabajo');
             $table->string('situacion_laboral');
             $table->string('propietario_transporte');
             $table->string('licencia_conducion');
             $table->string('categoria_licencia');
             $table->string('intereses_ocupacionales');
             $table->string('idioma');
             $table->string('idioma_nivel');
             $table->string('dispone_tiempo');
             $table->string('presentacion_personal');
             $table->string('comprende_acepta');
             $table->string('bicicleta_todoterreno');
             $table->string('afiliado');
             $table->string('seguridad_social_otro');
             $table->string('antecedente_salud');
             $table->string('opcional_antecedente');
             $table->string('acepto_terminos');
             $table->string('firma');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //  
        Schema::drop('usuario');
    }
}
