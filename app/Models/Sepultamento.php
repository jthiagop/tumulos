<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Sepultamento extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pessoa_falecida_id',
        'tumulo_id',
        'data_sepultamento',
        'observacoes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data_sepultamento' => 'datetime', // MELHORIA 1
    ];

    /**
     * The relationships that should always be loaded.
     * Isso otimiza a performance e previne o problema N+1 automaticamente.
     *
     * @var array
     */
    protected $with = ['pessoaFalecida', 'tumulo']; // MELHORIA 2

    /**
     * Define o relacionamento: Um Sepultamento PERTENCE A uma PessoaFalecida.
     */
    public function pessoaFalecida(): BelongsTo
    {
        return $this->belongsTo(PessoaFalecida::class);
    }

    /**
     * Define o relacionamento: Um Sepultamento PERTENCE A um Tumulo.
     */
    public function tumulo(): BelongsTo
    {
        return $this->belongsTo(Tumulo::class);
    }

    /**
     * Acessor para a data de sepultamento formatada.
     * Acessado na view como: $sepultamento->data_formatada
     */
    public function getDataFormatadaAttribute(): string
    {
        // Graças ao casting, $this->data_sepultamento já é um objeto Carbon.
        return $this->data_sepultamento 
                ? $this->data_sepultamento->format('d/m/Y H:i') 
                : 'Data não informada';
    }
}