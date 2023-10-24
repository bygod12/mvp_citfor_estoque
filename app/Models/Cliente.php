<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'cliente';

    protected $fillable = [
        'nome',
        'observacao',
        'email',
        'numero'

    ];
    public function vendas()
    {
        return $this->hasMany(Venda::class, 'cliente_id');
    }
    public function loja()
    {
        return $this->belongsTo(Loja::class, 'loja_id');
    }
}
