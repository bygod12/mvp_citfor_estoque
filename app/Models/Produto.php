<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Produto
 *
 * @property int $idproduto
 * @property string $nome
 * @property string $descricao
 * @property float $valor
 * @property int $qtd
 * @property int $doador_iddoador
 * @property int $categoria_idcategoria
 * @property string $foto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Categorium $categorium
 * @property Doador $doador
 * @property Collection|ItemVenda[] $item_vendas
 * @property Collection|Movimentacao[] $movimentacaos
 *
 * @package App\Models
 */
class Produto extends Model
{
	use SoftDeletes;
	protected $table = 'produto';
	public $incrementing = false;

	protected $casts = [
		'valor' => 'float',
		'qtd' => 'int',
		'doador_id' => 'int',
		'categoria_id' => 'int'
	];

	protected $fillable = [
		'nome',
		'descricao',
		'valor',
		'qtd',
		'doador_id',
		'categoria_id',
		'foto'
	];

	public function categoria()
	{
		return $this->belongsTo(Categorium::class, 'categoria_id');
	}

	public function doador()
	{
		return $this->belongsTo(Doador::class, 'doador_id');
	}

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'item_venda', 'produto_id', 'venda_id')
            ->withPivot(['qtd_vendida', 'preco_unitario', 'sub_total', 'condigo_produto'])
            ->using(ItemVenda::class);
    }

	public function movimentacaos()
	{
		return $this->hasMany(Movimentacao::class, 'produto_id');
	}

    public function codigos()
    {
        return $this->hasMany(Codigo::class, 'codigo_id');

    }
    public function loja()
    {
        return $this->belongsTo(Loja::class, 'loja_id');
    }
}
