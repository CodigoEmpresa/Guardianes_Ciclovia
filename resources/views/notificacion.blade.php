@extends('master')

@section('content')
    <h1> {!! $datos !!} </h1>
    <a href="{{route('/')}}">Volver a inicio</a>
@stop
