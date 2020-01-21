@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <form action="{{route('cadastro_caixa')}}" method="get">
                        <span>Controle Caixa
                            <button class="btn btn-success float-right" type="submit">Cadastrar Novo Caixa</button>
                        </span>
                    </form>
                </div>

                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if(count($caixa) == 0)
                    <h3 style="text-align:center;">Sem registro de caixas no momento.</h3 style="text-align:center;">
                    @else
                    <div class="table-responsive-sm">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Cod.</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($caixa as $c)
                                <tr>
                                    <th scope="row">
                                        {{$c->cod}}
                                    </th>
                                    <td>
                                        {{$c->description}}
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="md-sm">
                                                <form action="/caixa-aberto/{{$c->id}}" method="get">
                                                    <button class="btn btn-primary">Abrir</button>
                                                </form>
                                            </div>
                                            <div class="md-sm">
                                                <form action="/cadastro-editar/{{$c->id}}" method="get">
                                                    <button class="btn btn-warning" type="submit">Editar</button>
                                                </form>
                                            </div>
                                            <div class="md-sm">

                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#excluir{{$c->cod}}">
                                                    Excluir
                                                </button>
                                                <!-- Excluir Caixa Modal -->
                                                <div class="modal fade" id="excluir{{$c->cod}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">ATENÇÃO <b>{{\Auth::user()->name}}</b>!</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-center">
                                                                    Tem certeza que deseja <b>excluir</b> o caixa <b>{{$c->description}}</b>? Esta ação não poderá ser desfeita e todo conteudo sera deletado!
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form class="form-inline" action="/deletar-caixa/{{$c->id}}" method="post">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input style="width:380px; margin-right:10px;" type="password" class="form-control" name="password" id="password" placeholder="Necessário senha para confirmar exclusão de caixa..." required>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                    </div>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>

@endsection