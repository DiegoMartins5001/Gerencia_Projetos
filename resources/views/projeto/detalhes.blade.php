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
                <div class="panel-heading">
                  <strong>
                      <h4>{!!$nome->nome!!}</h4>
                  </strong>
                </div>
                <div class="panel-body">
                   <div class="col-md-12">
                   		<h3><strong> Descrição:</strong></h3>
                      <strong>
                        {!!$nome->descricao!!}
                      </strong>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-12 row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Desenvolvedores</strong></div>
                <div class="panel-body">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   	<table style="display: block !important;" class="table table-responsive">
                   		<thead>
                   			<th class="col-lg-1 col-md-1 col-sm-1">Nome</th>
                   			<th class="col-lg-1 col-md-1 col-sm-1">Tarefa</th>
                   			<th class="col-lg-1 col-md-1 col-sm-1">Prazo</th>
                   			<th class="col-lg-2 col-md-2 col-sm-2">Estado</th>
                        <th class="col-lg-1 col-md-1 col-sm-1"><a type="submit" class="btn btn-primary btn-sm" href="{{url('cadastrar_devs/'.$id_projeto)}}"><strong>Add Devs</strong></a></th>
                        <th class="col-lg-1 col-md-1 col-sm-1"><a type="submit" class="btn btn-warning btn-sm" href="{{url('listar_projetos')}}"><strong>Lista de Projeto (s)</strong></a></th>
                   		</thead>
                   		@foreach($lista as $l)
                      <tbody>
                   			<tr>
                   				<td readonly="readonly" id="{{$l->id_user}}" class="col-lg-1">{{$l->name}}</td>
                   				<td class="col-lg-1" name="{{$l->id_lista}}">{{$l->tarefa}}</td>
                   				<td class="col-lg-1">{{$l->data_limite}}</td>
                   				@if($l->estado_tarefa == false)
                            <td class="col-lg-2 col-md-3 col-sm-3 col-xs-3">Pendente
                              <a style="margin-left: 15px;" class="btn btn-primary" name="estado_tarefa" href="{{url('concluir/'.$l->id_lista)}}">Concluir</a>
                            </td>
                          @else
                            <td class="col-lg-2 col-md-3 col-sm-3 col-xs-3">Concluída</td>
                            @if ($errors->has('estado_tarefa'))
                            <span class="text-danger">{{ $errors->first('estado_tarefa') }}</span>
                            @endif
                          @endif
                   			</tr>
                   		</tbody>
                      @endforeach
                   	</table>
                    {{ $lista->links() }}
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection