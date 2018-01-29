@extends('master')

@section('content')
    <link rel="stylesheet" type="text/css" href="public/Css/form.css">

    <div class="panel panel-default">
        <div class="panel-heading">Información personal</div>
        <div class="panel-body">
            <form action="logear" method="POST">
                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle" for="formGroupExampleInput">Usuario</label>
                    <input title="Se nesesita el codigo" required type="text" class="form-control" id="usuario"
                           name="usuario">
                </fieldset>

                <fieldset class="form-group">
                    <label class="freebirdFormviewerViewItemsItemItemTitle"
                           for="formGroupExampleInput">contraseña</label>
                    <input title="Se nesesita el codigo" required type="password" class="form-control" id="pass"
                           name="pass">
                </fieldset>

                <fieldset class="form-group">

                    <input type="submit" class="btn btn-success" value="Logear">
                </fieldset>
            </form>
        </div>
    </div>


@stop
