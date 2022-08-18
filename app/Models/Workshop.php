<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Workshop extends Model
{
    public function scopeFutureWorkshops($query, $params)
    {
        $query->where('start', '>', now()->toDateString());
    }
}
