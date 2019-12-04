<!-- 'extends' puxando o template 'layouts' para esta pagina -->
@extends('layouts.app');
<!-- 'content' para definir qual o conteudo que sera inserido dentro do template -->
@section('content')

    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Produtos</h1>
            </div>

            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome Produto</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Criado em</th>
                            <th scope="col">Última atualização</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- para cada produto, tenho uma estrutura igual a essa, precisando de um looping para trazer todos: -->
                    <!-- forelse para poder dar um retorno no caso de falta de produtos cadastrados, indo para o empty -->
                    @forelse($listProduct as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>R$ {{$product->price}}</td>
                            <!-- funciona o user porque no model Product tem um belong que retorna as informacoes de usuarios -->
                            <td>{{$product->user->name}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->updated_at}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/produtos/atualizar/{{$product->id}}">Atualizar</a>
                                <a class="btn btn-danger btn-sm" href="/produtos/deletar/{{$product->id}}">Deletar</a>
                            </td>
                        </tr>
                    @empty 
                        <h1>Não tem produtos cadastrados.</h1>
                    @endforelse
                    </tbody>
                </table>
            
            </div>
        </div>
    </section>

<!-- fim da section 'content' -->
@endsection

