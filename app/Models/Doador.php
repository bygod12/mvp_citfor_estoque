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
 * Class Doador
 *
 * @property int $iddoador
 * @property string $nome
 * @property string $bairro
 * @property string $rua
 * @property string $num_casa
 * @property string $numero_1
 * @property string $numero_2
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Produto[] $produtos
 *
 * @package App\Models
 */
class Doador extends Model
{
	use SoftDeletes;
	protected $table = 'doador';


	protected $fillable = [
        'loja_id',
        'nomedoador',
        'email',
        'hora_entrega',
        'entregue',
		'bairro',
		'rua',
		'num_casa',
		'numero_1',
		'numero_2'
	];

	public function produtos()
	{
		return $this->hasMany(Produto::class, 'doador_id');
	}
    public function loja()
    {
        return $this->belongsTo(Loja::class, 'loja_id');
    }
}
