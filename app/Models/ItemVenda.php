<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ItemVenda
 *
 * @property int $produto_idproduto
 * @property int $venda_idvenda
 * @property int $qtd_vendida
 * @property float $preco_unitario
 * @property float $sub_total
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Produto $produto
 * @property Venda $venda
 *
 * @package App\Models
 */
class ItemVenda extends Pivot
{
	use SoftDeletes;
	protected $table = 'item_venda';
	public $incrementing = false;

	protected $casts = [
		'produto_id' => 'int',
		'venda_id' => 'int',
		'qtd_vendida' => 'int',
		'preco_unitario' => 'float',
		'sub_total' => 'float'
	];

	protected $fillable = [
		'qtd_vendida',
		'preco_unitario',
		'sub_total',
        'condigo_produto'
	];

	public function produto()
	{
		return $this->belongsTo(Produto::class, 'produto_id');
	}

	public function venda()
	{
		return $this->belongsTo(Venda::class, 'venda_id');
	}
}
