<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Movimentacao
 *
 * @property int $idmovimentacao
 * @property string $data_movimentacao
 * @property int $qtd_movimentada
 * @property string $tipo_movimentacao
 * @property int $produto_idproduto
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Produto $produto
 *
 * @package App\Models
 */
class Movimentacao extends Model
{
	use SoftDeletes;
	protected $table = 'movimentacao';
	public $incrementing = false;

	protected $casts = [
		'qtd_movimentada' => 'int',
		'produto_idproduto' => 'int'
	];

	protected $fillable = [
		'data_movimentacao',
		'qtd_movimentada',
		'tipo_movimentacao',
		'produto_idproduto'
	];

	public function produto()
	{
		return $this->belongsTo(Produto::class, 'produto_id');
	}
}
