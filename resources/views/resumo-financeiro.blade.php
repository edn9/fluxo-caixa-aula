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
                        <a href="/transacoes/{{$cCaixa->id}}">Transações</a>
                    </div>
                    <div class="col">
                        <b><u>Resumo Financeiro</u></b>
                    </div>
                </div>
                <hr style="margin-top:21px">

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
                    <div class="box-container">
                        <div class="box-pie">
                            <div class="pie"></div>
                        </div>
                        <div class="box-info">
                            <div class="info">
                                <b>Valor Total</b> - Receitas: <b style="color:#AACC00;">{{$tRec}} / {{$r}}</b>.
                                Despesas: <b style="color:#DD4444;">{{$tDesp}} / {{$d}}</b>.
                                <div class="table-responsive-sm">
                                    <table class="table table-hover">

                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <img src="{{ URL::asset('/icons/money.svg') }}" alt="money" width="15px">
                                                    Dinheiro</th>
                                                <th scope="col">
                                                    <img src="{{ URL::asset('/icons/master-card.svg') }}" alt="money" width="15px">
                                                    Crédito</th>
                                                <th scope="col">
                                                    <img src="{{ URL::asset('/icons/master-card-back.svg') }}" alt="money" width="15px">
                                                    Débito</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{array_sum($tCash)}}
                                                </td>
                                                <td>
                                                    {{array_sum($tCredit)}}
                                                </td>
                                                <td>
                                                    {{array_sum($tDebit)}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        //pie
        var ctxP = document.getElementById("pieChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
                datasets: [{
                    data: [300, 50, 100, 40, 120],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
    <!-- Ícones feitos por <a href="https://www.flaticon.com/authors/pause08" title="Pause08">Pause08</a> from <a href="https://www.flaticon.com/br/" title="Flaticon"> www.flaticon.com</a> 
Ícones feitos por <a href="https://www.flaticon.com/br/autores/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/br/" title="Flaticon"> www.flaticon.com</a>-->
    @endsection