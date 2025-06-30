<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tumulo extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quadra',
        'rua',
        'numero',
        'tipo',
        'status',
        'localizacao_detalhada',
        'codigo', // <-- ADICIONADO
        'tags',   // <-- ADICIONADO
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array', // <-- ADICIONADO: Converte a coluna JSON 'tags' em array e vice-versa.
    ];

        /**
     * Define o relacionamento: Um Túmulo PODE TER MUITOS Sepultamentos.
     */
    public function sepultamentos()
    {
        return $this->hasMany(Sepultamento::class);
    }

    /**
     * Retorna as classes CSS para o status
     */
    public function getStatusBadgeAttribute()
    {
        $classes = [
            'Disponível' => 'badge-light-success',
            'Ocupado' => 'badge-light-danger',
            'Reservado' => 'badge-light-warning',
            'Em Manutenção' => 'badge-light-primary'
        ];

        return $classes[$this->status] ?? 'badge-light-secondary';
    }
    
    /**
     * Retorna o ícone para o status
     */
    public function getStatusIconAttribute()
    {
        $icons = [
            'Disponível' => 'bi bi-check-circle',
            'Ocupado' => 'bi bi-x-circle',
            'Reservado' => 'bi bi-hourglass',
            'Em Manutenção' => 'bi bi-tools'
        ];

        return $icons[$this->status] ?? 'bi bi-question-circle';
    }

        /**
     * Tipos permitidos com descrições
     */
    public static function tiposPermitidos()
    {
        return [
            'Cova Simples' => 'Cova Simples',
            'Jazigo' => 'Jazigo',
            'Gaveta' => 'Gaveta'
        ];
    }

    /**
     * Classes CSS para cada tipo
     */
    public function getTipoBadgeAttribute()
    {
        $classes = [
            'Cova Simples' => 'badge-light-info',
            'Jazigo' => 'badge-light-primary',
            'Gaveta' => 'badge-light-secondary'
        ];

        return $classes[$this->tipo] ?? 'badge-light-dark';
    }

    /**
     * Ícones para cada tipo
     */
    public function getTipoIconAttribute()
    {
        $icons = [
            'Cova Simples' => 'bi bi-square',
            'Jazigo' => 'bi bi-building',
            'Gaveta' => 'bi bi-archive'
        ];

        return $icons[$this->tipo] ?? 'bi bi-question-square';
    }
}