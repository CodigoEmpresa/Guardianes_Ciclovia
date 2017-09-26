@extends('master')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.0.1/css/responsive.bootstrap.min.css">
    <script src=" https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
    <script src=" https://cdn.datatables.net/responsive/2.0.1/js/dataTables.responsive.min.js"></script>
    <script src=" https://cdn.datatables.net/responsive/2.0.1/js/responsive.bootstrap.min.js"></script>

    <div class="container-fluid">
        <form name="resultados" id="resultados">
            <div class="row">
                <div class="col-md-12" id="div-tabla" >




                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="public/Js/admin.js?n=1" ></script>

    <link rel="stylesheet" href="{{ asset('public/Css/admin.css') }}" media="screen">


@stop