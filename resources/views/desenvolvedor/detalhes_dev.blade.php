@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-12 row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Desenvolvedores</strong></div>
                <div class="panel-body">
                   <div class="col-md-12">
                   	<table class="table">
                   		<thead>
                   			<th>Nome</th>
                   			<th>Tarefa</th>
                   			<th>Prazo</th>
                   			<th>Estado</th>
                        <th><button class="btn-sm btn-primary" type="submit" name="Concluir">Add Devs</button></th>
                   		</thead>
                   		@foreach($lista as $l)
                      <tbody>
                   			<tr>
                   				<td>{{$l->name}}</td>
                   				<td>{{$l->tarefa}}</td>
                   				<td>{{$l->data_limite}}</td>
                   				@if($l->estado_tarefa == false)
                            <td>Pendente
                              <a style="margin-left: 15px;" class="btn btn-primary" name="{{$l->id_projeto}}" href="{{url('concluir/'.$l->id_projeto)}}">Concluir</a>
                            </td>
                          @else
                            <td>Concluída</td>
                          @endif
                   			</tr>
                   		</tbody>
                      @endforeach
                   	</table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection