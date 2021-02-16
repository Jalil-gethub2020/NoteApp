<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;

    /*   protected $casts = [
        'is_complete' => 'boolean',
    ]; */

    /*use SoftDeletes;
protected $dates =['deleted_at'];
*/

    protected $fillable = [
        'user_id',
        'title',
        'content',
        // 'is_complete',
    ];

    public function user()
    {

        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
