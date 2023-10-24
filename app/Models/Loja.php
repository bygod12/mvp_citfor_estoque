<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;
    protected $table = 'loja';


    protected $fillable = [
        'nome',
        'bairro',
        'rua',
        'num_casa',
        'numero',
        'cnpj',
        'foto'
    ];
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'loja_id');
    }

    public function funcionario()
    {
        return $this->hasMany(Funcionario::class, 'loja_id');
    }
    public function categorias()
    {
        return $this->hasMany(Categorium::class, 'loja_id');
    }
    public function doadors()
    {
        return $this->hasMany(Doador::class, 'loja_id');
    }
}
