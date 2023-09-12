<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Funcionario extends Model
{
    use HasFactory;
    use HasRoles;

    use SoftDeletes;
    protected $table = 'funcionario';

    protected $fillable = [
        'numero',
        'cpf',
        'loja_id',
        'cargo_id'
    ];
    public function vendas()
    {
        return $this->hasMany(Venda::class, 'funcionario_id');
    }
    public function loja()
    {
        return $this->belongsTo(Loja::class, 'loja_id');
    }

    // No modelo Funcionario
    public function auth()
    {
        return $this->hasOne(User::class, 'funcionario_id');
    }
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
}
