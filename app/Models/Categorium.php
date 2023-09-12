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
 * Class Categorium
 *
 * @property int $idcategoria
 * @property string $nome
 * @property string|null $descricao
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Produto[] $produtos
 *
 * @package App\Models
 */
class Categorium extends Model
{
	use SoftDeletes;
	protected $table = 'categoria';
	public $incrementing = false;



	protected $fillable = [
		'nome',
        'loja_id',
        'descricao'
	];

	public function produtos()
	{
		return $this->hasMany(Produto::class, 'categoria_id');
	}

    public function loja()
    {
        return $this->belongsTo(Loja::class, 'loja_id');
    }
}
