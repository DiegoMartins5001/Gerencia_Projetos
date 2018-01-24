@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12 row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <strong><h3>Projetos</h3></strong>
                </div>
                <div class="panel-body">
                  @if($projeto[0] == '') 
                    <div class="panel-body">
                      <div class="panel-body text-center">
                        <h1 class="text-info">
                          Nenhum Projeto Cadastrado
                        </h1>
                      </div>
                    </div>
                  @else
                  <table style="display: block !important;" class="table table-responsive">
                   	<thead>
                   		<th>Nome</th>
                   		<th>Descrição do Projeto</th>
                      <th class="text-center text-primary">Mais Detalhes</th>
                      <th class="text-center text-info">Editar</th>
                      <th class="text-center text-danger">Excluir</th>
                   	</thead>
                  @foreach($projeto as $p)
                    <tbody>
                     	<tr>
                     	  <td id="{{$p->id_projeto}}"><strong>{{$p->nome}}</strong></td>
                     		<td class="col-md-5">{{$p->descricao}}</td>
                     		<td><a class="btn btn-primary btn-sm" href="{{url('detalhes_projeto/'.$p->id_projeto)}}"><strong>Mais Detalhes</strong></a></td>
                        <td><a class="btn btn-info btn-sm" href="{{url('editar_projeto/'.$p->id_projeto)}}"><strong>Editar Projeto</strong></a></td>
                        <td><a class="btn btn-danger btn-sm" href="{{url('deletar_projeto/'.$p->id_projeto)}}"><strong>Excluir Projeto</strong></a></td>
                     	</tr>
                     </tbody>
                    @endforeach
                  </table>
                  {{ $projeto->render() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection