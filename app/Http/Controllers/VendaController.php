<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Cliente;
use App\Models\Doador;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class VendaController extends Controller
{
    public function index()
    {
        return view('venda.index');
    }

    public function create()
    {
        $user = Auth::user();
        $id = $user->funcionario->loja->id;

        $produtos = Produto::whereHas('loja', function ($query) use($id) {
            $query->where('loja_id','=', $id);
        })->where('qtd', '!=', 0)->get();

        $clientes = Cliente::whereHas('loja', function ($query) use($id) {
            $query->where('loja_id','=', $id);
        })->get();
        return view('venda.create', [
            'produtos' => $produtos,
            'clientes' => $clientes]);
    }
    function gerarCodigoVenda($prefix = '') {
        return $prefix . uniqid();
    }
    public function store(Request $request)
    {

        // Crie uma nova instância de venda
        $venda = new Venda();
        $venda->funcionario_id = auth()->user()->id;
        $venda->valor_total = 0;
        $venda->data_venda = now();
        $venda->codigo_venda = 0; // Gere um código de venda exclusivo

        $venda->save();
        // Processar os itens da venda
        foreach ($request->produtoId as $index => $produtoId) {
            // Crie uma nova instância de item de venda
            $itemVenda = new ItemVenda();
            $itemVenda->produto_id = $produtoId;
            $itemVenda->venda_id = $venda->id; // Associe o item à venda criada
            $itemVenda->qtd_vendida = $request->quant[$index];
            $itemVenda->preco_unitario = $request->valor[$index];
            $itemVenda->sub_total = $request->quant[$index] * $request->valor[$index];
            $itemVenda->condigo_produto = $this->gerarCodigoVenda($itemVenda->produto_id.$itemVenda->venda_id); // Gere um código de produto exclusivo
            $itemVenda->save();

            // Atualize o valor total da venda com o valor deste item
            $venda->valor_total += $itemVenda->sub_total;
        }
        $venda->codigo_venda = $this->gerarCodigoVenda(); // Gere um código de venda exclusivo
        if ($request->isDonation) {

            $request->validate([
                'nome' => 'required|string|max:255',
                'observacao' => 'nullable|string',
                'email' => 'nullable|email',
                'numero' => 'nullable|max:60'
            ]);
            $user = Auth::user();
            $id = $user->funcionario->loja->id;

            $cliente = new Cliente();

            $cliente->nome = $request->nome;
            $cliente->observacao = $request->nome;
            $cliente->email = $request->nome;
            $cliente->numero = $request->numero;
            $cliente->loja_id = $id;

            $cliente->save();

            $venda->cliente_id = $cliente->id;
        }else{
            $venda->cliente_id = $request->clienteId;

        }

        // Atualize o valor total da venda
        $venda->save();
        return redirect()->route('venda.index')->with('success', 'Venda criada com sucesso!');
    }
    public function show($id)
    {

        $venda = Venda::with('produtos')->find($id);
        $produtos = Produto::all();

        return view('venda.show', ['produtos' => $produtos,
            'venda' => $venda
            ]);
    }

    public function update(Request $request, $idVenda)
    {
        // Encontre a venda existente
        $venda = Venda::find($idVenda);

        if (!$venda) {
            return redirect()->back()->with('error', 'Venda não encontrada');
        }

        // Exclua todos os produtos relacionados a essa venda
        $venda->produtos()->detach();

        // Processar os novos produtos da venda
        foreach ($request->produtoId as $index => $produtoId) {
            // Anexe um produto à venda atual com dados de pivô
            $produto = Produto::find($produtoId);
            $produto->qtd-= $request->quant[$index];

            $venda->produtos()->attach($produtoId, [
                'qtd_vendida' => $request->quant[$index],
                'preco_unitario' => $request->valor[$index],
                'sub_total' => $request->quant[$index] * $request->valor[$index],
                'condigo_produto' => $this->gerarCodigoVenda($produtoId . $venda->id)
            ]);

            // Atualize o valor total da venda com o valor deste produto
            $venda->valor_total += $request->quant[$index] * $request->valor[$index];
        }

        $venda->codigo_venda = $this->gerarCodigoVenda(); // Gere um código de venda exclusivo

        // Atualize o valor total da venda
        $venda->save();

        return redirect()->route('venda.index')->with('success', 'Venda atualizada com sucesso');
    }

    public function destroy($idvenda)
    {
        $venda = Venda::find($idvenda);
        // Use o método detach para remover os produtos relacionados a esta venda
        $venda->produtos()->detach();

        $venda->delete();

        return redirect()->route('venda.index')->with('success', 'Venda excluído com sucesso!');
    }

    public function dados()
    {
        $vendas = Venda::with('produtos')->get();

        return DataTables::of($vendas)
            ->addColumn('qtd_produtos', function($venda) {
                return $venda->produtos->count();
            })
            ->addColumn('action', function ($venda) {
                return '
            <a href="' . route('venda.show', $venda->id) . '" class="btn btn-primary btn-sm">Mostrar</a>
            <form action="'.route('venda.destroy', $venda->id).'" method="POST" style="display:inline;">
                '.csrf_field().'
                '.method_field('DELETE').'
                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
            </form>
        ';
            })
            ->make(true);
    }
}
