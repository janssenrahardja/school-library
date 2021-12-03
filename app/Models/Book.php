<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'books';
    protected $fillable = [
        'author_id',
        'title',
        'description',
        'image',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function authors()
    {
        return $this->belongsTo('App\Http\Models\User', 'author_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Http\Models\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Http\Models\User', 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo('App\Http\Models\User', 'deleted_by');
    }
}
