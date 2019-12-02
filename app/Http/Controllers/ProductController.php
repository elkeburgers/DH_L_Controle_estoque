<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Auth;
// para importar a classe user, product e auth para poder usar nas funcoes abaixo

class ProductController extends Controller {
    public $nome;



    public function create(Request $request){
    // dd($request->nameProduct); = teste se retorna o nome do produto cadastrado
    
    // fica responsavel por cadastrar um produto:
    $product = new Product();
    $product->name = $request->nameProduct;
    //name eh o atributo do objeto (tabela do BD) que estou buscando no formulario, e nameProduct veio do name que coloquei no formulario do formRegister.blade
    $product->description = $request->descriptionProduct;
    $product->quantity = $request->quantityProduct;
    $product->price = $request->priceProduct;
    $product->user_id = Auth::user()->id;
    //auth eh uma classe global que possui um metodo proprio chamado user que me retorna os atributos dele, por isso posso apenas solicitar o id direto.
    //agora precisa salvar este objeto que geramos:
    $result = $product->save();
    // if($result){
    //     echo "Deu certo sem query!";
    // }else{
    //     echo "vai ter que criar uma query!";
    // } = teste para saber se funciona, deu ok.
        return view('products.formRegister', ["result"=>$result]);
    }


    public function viewForm(Request $request){
        return view('products.formRegister');
    }




    // funcao para acessar formulario de atualizacao de produto, com id
    // para atualizar devemos buscar um objeto ao inves de criar, usando o metodo global find
    // eh necessario usar rotas com parametros (em routes)
    // '$id=0' para retornar este valor caso a rota nao receba nenhum id, e if para validacao para barrar a execucao em caso de codigo falso (completa com else no final da view)
    // para mandar as informacoes para a view, faz o array associativo (primeira linha do if) com a  variavel product que jah busca o objeto completo da tabela.
    public function viewFormUpdate(Request $request, $id=0){
        $product = Product::find($id);
        if($product){
            return view('products.formUpdate', ["product"=>$product]);
        }else{
            return view('products.formUpdate');
        }
    }


    // funcao para atualizar dados, botao salvar da view (copiada da original create e adaptada)
    // para atualizar devemos buscar um objeto ao inves de criar, usando o metodo global find
    // eh necessario usar rotas com parametros (em routes)
    // find para recuperar todas as informacoes, e depois so alterar o dado antigo com o novo sobreposto.
    public function update(Request $request){
        $product = Product::find($request->idProduct);
        $product->name = $request->nameProduct;
        $product->description = $request->descriptionProduct;
        $product->quantity = $request->quantityProduct;
        $product->price = $request->priceProduct;
        // apagada a linha de id usuario porque nao posso alterar essa informacao original
        //auth eh uma classe global que possui um metodo proprio chamado user que me retorna os atributos dele, por isso posso apenas solicitar o id direto.
        //agora precisa salvar este objeto que geramos:
        $result = $product->save();
            return view('products.formUpdate', ["result"=>$result]);
    }    


    // para ver todos os produtos, usa global ::all
    public function viewAllProducts (Request $request){
        $listProduct =  Product::all();
        return view('products.products', ['listProduct'=>$listProduct]);
    }


    // para deletar um produto, usa global destroy
    public function delete (Request $request, $id=0){
        $result = Product::destroy($id);
        if($result){
            // redirect substitui header/location
            return redirect('/produtos');
        }
    }




    
    // para ver um produto
    //  public function oneProducts (Request $request){
    // vai precisar de Product::find($idProduct)
    // }

    
}
