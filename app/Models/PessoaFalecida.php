<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PessoaFalecida extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'pessoa_falecidas'; // Define o nome da tabela, se necessário
    protected $fillable = [
        'codigo',
        'nome_completo',
        'foto_path',
        'cpf',
        'data_nascimento',
        'status_social',
        'data_falecimento',
        'data_sepultamento',
        'causa_morte',
        'descricao',
        'tags',
        'nome_responsavel',
        'telefone_responsavel',
        'endereco_responsavel',
        'email',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array', // Converte a coluna JSON 'tags' em array e vice-versa
        'data_nascimento' => 'date', // Garante que seja um objeto Carbon
        'data_falecimento' => 'date', // Garante que seja um objeto Carbon
        'data_sepultamento' => 'date',
    ];

    public function tumulo()
    {
        return $this->hasOneThrough(
            Tumulo::class,
            Sepultamento::class,
            'pessoa_falecida_id', // Foreign key na tabela Sepultamento
            'id', // Foreign key na tabela Tumulo
            'id', // Local key na tabela PessoaFalecida
            'tumulo_id' // Local key na tabela Sepultamento
        );
    }

    public function sepultamento()
    {
        return $this->hasOne(Sepultamento::class);
    }



    public function setTagsAttribute($value)
    {
        if (is_string($value)) {
            // Se for uma string JSON, decodifica para verificar a estrutura
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                // Se já estiver no formato correto, armazena como está
                $this->attributes['tags'] = $value;
            } else {
                // Se for uma string simples separada por vírgulas
                $tagsArray = array_map('trim', explode(',', $value));
                $this->attributes['tags'] = json_encode(
                    array_map(function ($tag) {
                        return ['value' => $tag];
                    }, $tagsArray)
                );
            }
        } elseif (is_array($value)) {
            // Se for um array, converte para o formato correto
            $this->attributes['tags'] = json_encode(
                array_map(function ($tag) {
                    return is_array($tag) ? $tag : ['value' => $tag];
                }, $value)
            );
        } else {
            $this->attributes['tags'] = null;
        }
    }

    public function getTagsAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        return json_decode($value, true);
    }

    public function getTagsAsStringAttribute()
    {
        if (empty($this->tags)) {
            return '';
        }

        return implode(',', array_column($this->tags, 'value'));
    }
}
