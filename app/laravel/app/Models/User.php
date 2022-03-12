<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class User extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
