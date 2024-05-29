<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $table = 'm_user';        // mendefinisikan nama tabel yang digunakan oleh model ini
    public $timestamps = false;
    protected $primaryKey = 'user_id';  // mendefinisikan primary key dari tabel yang digunakan

    protected $fillable = [
        'user_id',
        'level_id',
        'username',
        'nama',
        'password',
        'image',
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('storage/posts/' . $image),
        );
    }
}
