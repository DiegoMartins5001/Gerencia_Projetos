@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('mensagens-sucesso'))
    <div class="alert alert-success" role="alert">
        <strong>{{Session::get('mensagens-sucesso')}}</strong>
    </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar novos Usuários </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('registrar') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">CPF</label>

                            <div class="col-md-6">
                                <input id="password" type="numeric" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('data_nasc') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Data de Nascimento</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="data_nasc">

                                @if ($errors->has('data_nasc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('data_nasc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('data_admi') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Data de Admissão</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="data_admi">

                                @if ($errors->has('data_admi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('data_admi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Endereço</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="endereco">

                                @if ($errors->has('endereco'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endereco') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Telefone</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="fone">

                                @if ($errors->has('fone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cel') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Celular</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="cel">

                                @if ($errors->has('cel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Tipo de Usuário</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role" >
                                    <option value="dev" >Desenvolvedor</option>
                                    <option value="ges" >Gestor</option>
                                </select>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
