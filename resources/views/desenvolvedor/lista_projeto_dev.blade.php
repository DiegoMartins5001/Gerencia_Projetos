@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12 row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Projetos</div>
                @if($projeto == '')
                  <div class="panel-body">
                    <div class="panel-body text-center">
                      <h1 class="text-info">
                        Não está Participando de Nenhum <strong>Projeto</strong> no Momento
                      </h1>
                    </div>
                  </div>
                @else
                <div class="panel-body">
                  <table class="table">
                   	<thead>
                   		<th>Nome</th>
                   		<th>Tarefa</th>
                   		<th>Status da Tarefa</th>
                      <th></th>
                   	</thead>
                  @foreach($projeto as $p)
                    <tbody>
                     	<tr>
                     	  <td id="{{$p->id_projeto}}">{{$p->nome}}</td>
                     		<td class="col-md-5">{{$p->tarefa}}</td>
                     		@if($p->estado_tarefa == false)
                        <td>Pendente</td>
                        @else
                        <td class="text-success"><strong><p>Concluído</p></strong</td>
                        @endif
                     	</tr>
                     </tbody>
                    @endforeach
                  </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
