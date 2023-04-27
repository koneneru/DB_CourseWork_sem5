<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'product', 'author', 'rating',
        'review', 'created_at', 'updated_at',
    ];
}
