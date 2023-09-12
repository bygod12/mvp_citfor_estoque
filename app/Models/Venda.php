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
 * Class Venda
 *
 * @property int $idvenda
 * @property string $valor_total
 * @property Carbon $data_venda
 * @property int $funcionario_idfuncionario
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Funcionario $funcionario
 * @property Collection|ItemVenda[] $item_vendas
 *
 * @package App\Models
 */
class Venda extends Model
{
	use SoftDeletes;
	protected $table = 'venda';

	protected $casts = [
		'data_venda' => 'datetime',
		'funcionario_idfuncionario' => 'int'
	];

	protected $fillable = [
		'valor_total',
		'data_venda',
		'funcionario_idfuncionario'
	];

	public function funcionario()
	{
		return $this->belongsTo(Funcionario::class, 'funcionario_id');
	}

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'item_venda', 'venda_id', 'produto_id')
            ->withPivot(['qtd_vendida', 'preco_unitario', 'sub_total', 'condigo_produto'])
            ->using(ItemVenda::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');

    }
}
