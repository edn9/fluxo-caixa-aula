@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@if($caixa ?? '' ) Editar Caixa @else Cadastro Caixa @endif</div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    @if($caixa ?? '')
                    <form action="/cadastro-alterado" method="POST">
                        @csrf
                        <input name="id" type="hidden" value="{{$caixa[0]->id}}">
                        @else
                        <form action="/cadastro-salvar" method="POST">
                            @csrf

                            @endif

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Cod. Caixa</span>
                                </div>
                                <input type="number" name="cod" class="form-control" aria-label="Default" @if($caixa ?? '' ) value="{{$caixa[0]->cod}}" @endif aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Descrição</span>
                                </div>
                                <input type="text" name="description" class="form-control" aria-label="Default" @if($caixa ?? '' ) value="{{$caixa[0]->description}}" @endif aria-describedby="inputGroup-sizing-default">
                            </div>
                            @if($caixa ?? '')
                            <button class="btn btn-success float-right" type="submit">Salvar</button>
                            @else
                            <button class="btn btn-success float-right" type="submit">Cadastrar</button>
                            @endif
                        </form>
                        <a href="/home"><button class="btn btn-light" type="submit">Voltar</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection