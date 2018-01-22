@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('mensagens-danger'))
  <div class="alert alert-danger" role="alert">
    <strong>{{Session::get('mensagens-danger')}}</strong>
  </div>
@endif
@if(Session::has('mensagens-sucesso'))
  <div class="alert alert-success" role="alert">
    <strong>{{Session::get('mensagens-sucesso')}}</strong>
  </div>
@endif
    <div class="col-md-12 row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Editando Projeto</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('salvar_projeto/'.$projeto->id_projeto) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label">Nome</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="nome" value="{{$projeto->nome}}">

                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-1 control-label">Descriçao</label>

                            <div class="col-md-12">
                                <textarea name="descricao" class="form-control">{{$projeto->descricao}}</textarea>

                                @if ($errors->has('descricao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    <strong>Salvar</strong>
                                </button>
                            </div>
                            <div class="col-md-1">
                                <a class="btn btn-danger" href="{{ url('listar_projetos') }}">
                                    <strong>Cancelar</strong>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('.add').click(function(){
		var info = $('#dev');
		//console.log(info);
		console.log($('#dev').last().append(info));
	});
});
</script>
@endsection