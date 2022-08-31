<?php

declare(strict_types=1);

namespace App\Models\User;

use App\Models\Cars\Cars;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models\User
 */
class User extends Model
{
    /**
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * @var string[]
     */
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'senha'
    ];

    /**
     * @var array
     */
    public array $rules = [
        'nome'  => 'required|min:4|string',
        'email' => 'required|email|max:32|email:rfc,dns',
        'senha' => 'required|min:6',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany;
     */
    public function carros()
    {
        return $this->hasMany(Cars::class);
    }
}
