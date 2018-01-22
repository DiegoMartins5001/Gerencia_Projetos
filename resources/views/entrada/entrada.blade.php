@extends('layouts.app')

@section('content')

<h3 class="container">Bem Vindo {{\Session::get('nome')}}</h3>

@endsection