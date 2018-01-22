@extends('layouts.app')

@section('content')
	<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet">
	<div class="container">
		<div class="panel panel-danger">
			<div class="panel-heading">  
				<h2>Deseja Realmente <strong>Excluir</strong> o Projeto <strong>{!! $projeto->nome !!}</strong> ?</h2>
			</div>
		</div>
		{{ csrf_field() }}
		{!! Form::open(['method'=>'DELETE', 'url'=>'excluir_projeto/'.$projeto->id_projeto, 'style'=>'display: inline;']) !!}
		 	
		 	<div class="col-lg-2 col-lg-offset-4">
		 		<button type="submit" class="btn btn-danger btn-lg"><span aria-hidden="true"></span> <strong>Excluir Projeto</strong></button>
		 	</div>
		 	<div class="col-lg-4">	
		 		<a href="{{url('listar_projetos')}}"><div class="btn btn-success btn-lg"> <strong>Cancelar</strong> </div></a>
		 	</div>
		{!! Form::close() !!}
	</div>
@stop
