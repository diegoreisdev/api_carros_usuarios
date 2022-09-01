<?php

declare(strict_types=1);

namespace App\Models\Cars;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 * @package App\Models\Cars
 */
class Cars extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'carros';

    /**
     * @var string[]
     */
    protected $fillable = [
        'usuario_id',
        'modelo',
        'marca',
        'cor',
        'ano'
    ];

    public array $rules = [
        'usuario_id' => 'numeric|nullable',
        'modelo'     => 'required|min:3|max:20',
        'marca'      => 'required|min:3|max:20',
        'cor'        => 'required|min:3|max:20',
        'ano'        => 'required|numeric'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo;
     */
    public function usuarios()
    {
        return $this->belongsTo(User::class);
    }
}
