<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crud List</title>
    <!--made by edn9-->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #F8F9FA;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .form-inline {
            display: flex;
            justify-content: center;
            align-items: horizontal;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="card" style="width:800px;height:auto">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-10">
                            <h2>
                                Crud
                            </h2>
                        </div>
                        <div class="col-2">
                            <form action="/criar" method="get">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Criar
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    @if(count($usuarios)>0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Idade</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $u)
                            <tr>
                                <th scope="row">{{$u->id}}</th>
                                <td>{{$u->name}}</td>
                                <td>{{$u->age}}</td>
                                <td>
                                    <div class="form-inline">
                                        <!--Visualizar Button-->
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#view{{$u->id}}">
                                            <i class="far fa-eye"></i>
                                            Visualizar
                                        </button>
                                        <!--Visualizar Modal-->
                                        <div class="modal fade" id="view{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detalhes da Conta <b>#{{$u->id}}</b></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <i class="fas fa-user">
                                                                        <b>{{$u->name}}</b>
                                                                    </i>
                                                                </div>
                                                                <div class="col-4">
                                                                    <i class="fas fa-id-card">
                                                                        <b>{{$u->age}}</b>
                                                                    </i>
                                                                </div>
                                                                <div class="col-4">
                                                                    <i class="fas fa-mobile-alt">
                                                                        <b>{{$u->phone}}</b>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <i class="fas fa-envelope">
                                                                        <b>{{$u->email}}</b>
                                                                    </i>
                                                                </div>
                                                                <div class="col-6">
                                                                    <i class="fas fa-home">
                                                                        <b>{{$u->address}}</b>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <i class="fas fa-calendar-alt">
                                                                    <b>{{$u->created_at}}</b> -
                                                                    <b>{{$u->updated_at}}</b>
                                                                </i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            Fechar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Editar Button-->
                                        <form action="/editar" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$u->id}}">
                                            <button class="btn btn-warning">
                                                <i class="fas fa-pencil-alt"></i>
                                                Editar
                                            </button>
                                        </form>

                                        <!--Excluir Button-->
                                        <form action="/excluir{{$u->id}}" method="get">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @else
                    <h1>Sem contatos no momento...</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>