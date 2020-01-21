@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <p>
                            Caixa <b>{{$fCaixa[0]->description}}</b> aberto as <b>{{ $cCaixa->time->format('d/m/Y - H:i') }}</b> por <b>{{$userName}}</b> - Transações
                        </p>
                        <div class="row">
                            <div class="col-6">
                                <button disabled class="btn btn-secondary" type="button">
                                    Adicionar Dinheiro
                                </button>
                                <button disabled type="button" class="btn btn-dark">
                                    Remover Dinheiro
                                </button>

                            </div>

                            <div class="col-6 ">
                                <form action="/caixa-fechado/{{$cCaixa->id}}" method="post">
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
                        <a href="/caixa-aberto/{{$cCaixa->id}}">Extrato</a>
                    </div>
                    <div class="col">
                        <b><u>Transações</u></b>
                    </div>
                    <div class="col">
                        <a href="/resumo-financeiro/{{$cCaixa->id}}">Resumo Financeiro</a>
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
                    @if($tDeb == 0)
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
                                        Credito</th>
                                    <th scope="col">
                                        <img src="{{ URL::asset('/icons/master-card-back.svg') }}" alt="money" width="15px">
                                        Debito</th>
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

                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    @if($tDeb == 0)
                    @else
                    <hr>
                    <div class="row">
                        <div class="col">
                            {{ $fCaixa->links() }}
                        </div>
                        <div class="col">

                            <h4 class="float-right" style="margin-right: 15px;">
                                Total: <b style="color:red;">-{{$tDeb}}</b>
                            </h4>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ícones feitos por <a href="https://www.flaticon.com/authors/pause08" title="Pause08">Pause08</a> from <a href="https://www.flaticon.com/br/" title="Flaticon"> www.flaticon.com</a> 
Ícones feitos por <a href="https://www.flaticon.com/br/autores/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/br/" title="Flaticon"> www.flaticon.com</a>-->
@endsection