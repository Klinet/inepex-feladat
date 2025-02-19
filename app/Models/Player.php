<?php

// /////////////////////////////////////////////////////////////////////////////
// PLEASE DO NOT RENAME OR REMOVE ANY OF THE CODE BELOW.
// YOU CAN ADD YOUR CODE TO THIS FILE TO EXTEND THE FEATURES TO USE THEM IN YOUR WORK.
// /////////////////////////////////////////////////////////////////////////////

namespace App\Models;

use App\Enums\PlayerPositionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $name
 //* @property PlayerPosition $position
 * @property PlayerPositionEnum $position
 * @property PlayerSkill $skill
 */
class Player extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'name',
        'position'
    ];

    protected $casts = [
        'position' => PlayerPositionEnum::class,
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $with = ['skills'];

    public function skills(): HasMany
    {
        return $this->hasMany(PlayerSkill::class);
    }
}
