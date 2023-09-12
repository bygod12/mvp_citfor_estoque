<?php

namespace App\Http\Controllers;

use App\Charts\IncomeChart;
use App\Models\Doador;
use App\Models\Produto;
use App\Models\Venda;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vendas = Venda::with('produtos')->get();
        $produtos = Produto::query()->with(['categoria', 'doador']); // Carrega as relações categoria e doador
        $doador = Doador::query(); // Carrega as relações categoria e doador
        // Obtenha a data de início (segunda-feira) e a data de término (domingo) da semana atual
        $startDate = now()->startOfWeek(); // Para obter a primeira hora da segunda-feira
        $endDate = now()->endOfWeek(); // Para obter a última hora do domingo

        // Obtenha as vendas da semana atual agrupadas por dia da semana
        $valoresVendaPorDia = Venda::whereBetween('data_venda', [$startDate, $endDate])
            ->select(DB::raw('DAYNAME(data_venda) as dia_semana'), DB::raw('COUNT(*) as quantidade_vendas'), DB::raw('SUM(valor_total) as total'))
            ->groupBy('dia_semana')
            ->get();

        // Inicialize um array com os dias da semana em ordem
        $diasSemana = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // Preencha os valores de venda por dia da semana
        $valoresQuantidadeVendas = [];
        $valoresVendaDinheiro = [];

        foreach ($diasSemana as $dia) {
            $valor = $valoresVendaPorDia->firstWhere('dia_semana', $dia);
            $valoresQuantidadeVendas[] = $valor ? $valor->quantidade_vendas : 0;
            $valoresVendaDinheiro[] = $valor ? $valor->total : 0;
        }

        // Crie e preencha o gráfico
        $incomeChartVenda = new IncomeChart;
        $incomeChartVenda->labels(['Domg', 'Seg', 'Ter', 'Quar', 'Quin', 'Sex', 'Sab']);
        $incomeChartVenda->dataset('Quantidade de Vendas', 'line', $valoresQuantidadeVendas)->backgroundColor('rgba(255, 99, 132, 0.2)');
        $incomeChartVenda->dataset('Valores em Dinheiro', 'line', $valoresVendaDinheiro)->backgroundColor('rgba(54, 162, 235, 0.2)');

        // Obtenha as doações da semana atual e aplique a lógica de entrega
        $doacoesSemana = Doador::whereBetween('created_at', [$startDate, $endDate])->get();

        $doacoesRecebidas = 0;
        $doacoesParaReceber = 0;
        $doacoesAtrasadas = 0;

        foreach ($doacoesSemana as $doacao) {
            $entregaDate = new DateTime($doacao->hora_entrega);
            $now = new DateTime();

            if ($doacao->entregue) {
                $doacoesRecebidas++;
            } elseif ($entregaDate > $now) {
                $doacoesParaReceber++;
            } else {
                $doacoesAtrasadas++;
            }
        }

        // Crie e preencha o gráfico
        $incomeChartDoacao = new IncomeChart;
        $incomeChartDoacao->labels(['Domg', 'Seg', 'Ter', 'Quar', 'Quin', 'Sex', 'Sab']);
        $incomeChartDoacao->dataset('Recebidas', 'line', [$doacoesRecebidas, 0, 0, 0, 0, 0, 0])->backgroundColor('rgba(75, 192, 192, 0.2)');
        $incomeChartDoacao->dataset('Para Receber', 'line', [$doacoesParaReceber, 0, 0, 0, 0, 0, 0])->backgroundColor('rgba(54, 162, 235, 0.2)');
        $incomeChartDoacao->dataset('Atrasadas', 'line', [$doacoesAtrasadas, 0, 0, 0, 0, 0, 0])->backgroundColor('rgba(255, 99, 132, 0.2)');

        // Total de vendas da semana atual
        $totalVendasSemana = array_sum($valoresQuantidadeVendas);

        // Total de doações recebidas, para receber e atrasadas
        $totalDoacoesRecebidas = $doacoesRecebidas;
        $totalDoacoesParaReceber = $doacoesParaReceber;
        $totalDoacoesAtrasadas = $doacoesAtrasadas;
        // Calcule o total de roupas em estoque
        // Consulta para pegar todos os produtos com quantidade em estoque
        $produtosComEstoque = Produto::where('qtd', '>', 0)->get();

        // Agora, você pode calcular a quantidade total em estoque
        $totalRoupasEstoque = $produtosComEstoque->sum('qtd');

        // Calcule o total de vendas de hoje
        $totalVendasHoje = Venda::whereDate('created_at', today());
        $valoresVendasHoje = $totalVendasHoje->pluck('valor_total');

        // Agora, use a função sum para calcular a soma dos valores
        $totalVendasHoje = $valoresVendasHoje->sum();
        return view('home', [
            'incomeChartVenda' => $incomeChartVenda,
            'incomeChartDoacao' => $incomeChartDoacao,
            'totalVendasSemana' => $totalVendasSemana,
            'totalDoacoesRecebidas' => $totalDoacoesRecebidas,
            'totalDoacoesParaReceber' => $totalDoacoesParaReceber,
            'totalDoacoesAtrasadas' => $totalDoacoesAtrasadas,
            'totalRoupasEstoque' => $totalRoupasEstoque,
            'totalVendasHoje' => $totalVendasHoje,
        ] );
    }
}
