<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable= ['user_id', 'date', 'work_start', 'work_end'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function rests ()
    {
        return $this->hasMany(Rest::class);
    }

    public function previous()
    {
        return self::whereDate('date', '<', Carbon::today())->orderBy('date', 'desc')->first();
    }
    public function next()
    {
        return $this->where('date', '>', $this->date)->orderBy('date', 'asc')->get();
    }
}
