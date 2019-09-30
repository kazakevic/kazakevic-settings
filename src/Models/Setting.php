<?php

namespace Kazakevic\Settings\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bool value
 */
class Setting extends Model
{
    public const BOOL = 0;

    public const INT = 1;

    public const STRING = 2;

    public const OBJECT = 3;

    public const HEAD = 4;

    protected $table = 'settings';

    protected $fillable = ['key', 'value', 'type'];
}
