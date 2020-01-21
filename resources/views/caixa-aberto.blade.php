@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <p>
                            Caixa <b>{{$caixa[0]->caixaDescription}}</b> aberto as <b>{{$caixa[0]->aberturaCaixaTime}}</b> por <b>{{$caixa[0]->userName}}</b> - Lançamentos
                        </p>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#add{{$caixa[0]->caixaId}}">
                                    Adicionar Dinheiro
                                </button>
                                <div class="modal fade" id="add{{$caixa[0]->caixaId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Caixa <b>{{$caixa[0]->caixaDescription}} - Adicionar Dinheiro</b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/adicionar-dinheiro/{{$caixa[0]->caixaId}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="type">Tipo de Pagamento</label>
                                                        <select class="form-control" id="type" name="type" required>
                                                            <option value="cash">Dinheiro</option>
                                                            <option value="credit">Credito</option>
                                                            <option value="debit">Debito</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="value">Valor</label>
                                                        <input type="number" step="0.01" class="form-control cash-mask" id="value" name="value" placeholder="R$ 00,00" required>
                                                    </div>
                                                    <input type="hidden" value="{{$caixa[0]->caixaDescription}}" name="caixaDescription">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Adicionar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rem{{$caixa[0]->caixaId}}">
                                    Remover Dinheiro
                                </button>
                                <div class="modal fade" id="rem{{$caixa[0]->caixaId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Caixa <b>{{$caixa[0]->caixaDescription}} - Remover Dinheiro</b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/remover-dinheiro/{{$caixa[0]->caixaId}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="type">Tipo de Pagamento</label>
                                                        <select class="form-control" id="type" name="type" required>
                                                            <option value="cash">Dinheiro</option>
                                                            <option value="credit">Credito</option>
                                                            <option value="debit">Debito</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="value">Valor</label>
                                                        <input type="number" step="0.01" class="form-control" id="value" name="value" placeholder="R$ 00,00" required>
                                                        <input type="hidden" value="{{$caixa[0]->caixaDescription}}" name="caixaDescription">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Remover</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-6 ">
                                <form action="/caixa-fechado/{{$caixa[0]->caixaId}}" method="post">
                                    @csrf
                                    <button class="btn btn-primary float-right" type="submit">Fechar Caixa</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <div style="text-align:center;" class="row">
                    <div class="col">
                        <b><u>Extrato</u></b>
                    </div>
                    <div class="col">
                        <a href="/transacoes/{{$caixa[0]->caixaId}}">Transações</a>
                    </div>
                    <div class="col">
                        <a href="/resumo-financeiro/{{$caixa[0]->caixaId}}">Resumo Financeiro</a>
                    </div>
                </div>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @elseif ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    @if(count($fCaixa) == 0)
                    <h4 style="text-align:center;">Sem registros no momento.</h4 style="text-align:center;">
                    @else
                    <div class="table-responsive-sm">
                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">
                                        <img src="{{ URL::asset('/icons/money.svg') }}" alt="money" width="15px">
                                        Dinheiro</th>
                                    <th scope="col">
                                        <img src="{{ URL::asset('/icons/master-card.svg') }}" alt="money" width="15px">
                                        Crédito</th>
                                    <th scope="col">
                                        <img src="{{ URL::asset('/icons/master-card-back.svg') }}" alt="money" width="15px">
                                        Débito</th>
                                    <th scope="col">Saldo do Caixa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fCaixa as $c)
                                <tr>
                                    <td>
                                        {{ $c->time->format('H:i') }}
                                    </td>
                                    <td>
                                        {{$c->description}}
                                    </td>
                                    <td>
                                        @if($c->cash > 0)
                                        @if($c->action == 'rem')
                                        <b style="color:red;">-{{round($c->cash, 2)}}</b>
                                        @else
                                        {{round($c->cash, 2)}}
                                        @endif
                                        @endif

                                    </td>
                                    <td>
                                        @if($c->credit > 0)
                                        @if($c->action == 'rem')
                                        <b style="color:red;">-{{round($c->credit, 2)}}
                                        </b>
                                        @else
                                        {{round($c->credit, 2)}}
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($c->debit > 0)
                                        @if($c->action == 'rem')
                                        <b style="color:red;">-{{round($c->debit, 2)}}
                                        </b>
                                        @else
                                        {{round($c->debit, 2)}}
                                        @endif
                                        @endif
                                    </td>
                                    <td class="table-active">
                                        @if($c->balance < 0) <b style="color:red;"> R${{round($c->balance, 2)}}</b>
                                            @else
                                            <b>R$ {{round($c->balance, 2)}}</b>
                                            @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $fCaixa->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ícones feitos por <a href="https://www.flaticon.com/authors/pause08" title="Pause08">Pause08</a> from <a href="https://www.flaticon.com/br/" title="Flaticon"> www.flaticon.com</a> 
Ícones feitos por <a href="https://www.flaticon.com/br/autores/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/br/" title="Flaticon"> www.flaticon.com</a>-->
@endsection