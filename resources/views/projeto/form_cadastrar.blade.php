@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('mensagens-danger'))
  <div class="alert alert-success" role="alert">
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
                <div class="panel-heading">Registrar Novos Projetos</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('registrar_projeto') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label">Nome</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="nome" value="{{ old('nome') }}">

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
                                <textarea name="descricao" class="form-control">{{old('descricao')}}</textarea>

                                @if ($errors->has('descricao'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descricao') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tarefa') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <table class="table">
                                	<thead>
                                		<th>Desenvolvedor</th>
                                		<th>Tarefa</th>
                                		<th>Data Limite</th>
                                	</thead>
                                	<tbody id="dev">
                                		<td>
                                		<select class="form-control" name="id_user">
                                			@foreach($users as $u)
                                				<option value="{{$u->id_user}}">{{$u->name}}</option>
                                			@endforeach
                                		</select>
                                		</td>
                                		<td>
                                            <input type="text" name='tarefa' class="form-control">
                                        </td>
                                		<td class="col-lg-1"><input id="name" type="date" class="form-control" name="data_limite" value="{{ old('tarefa') }}"></td>
                                	</tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary">
                                    <strong>Continuar</strong>
                                </button>
                            </div>
                            <div class="col-lg-offset-1">
                                <a type="submit" class="btn btn-warning" href="{{url('listar_projetos')}}"><strong>Cancelar</strong></a>
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