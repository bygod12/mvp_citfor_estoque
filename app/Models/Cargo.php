<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use SoftDeletes;
    protected $table = 'cargo';



    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'cargo_id');
    }
}
