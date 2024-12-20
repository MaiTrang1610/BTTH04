<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Issue extends Model
{
    use HasFactory;
     // Định nghĩa các cột có thể điền (fillable)
    protected $fillable = ['computer_id','reported_id','reported_date','description','urgency','status'];

    // Định nghĩa mối quan hệ với Computer (issues thuộc về một máy tính)
    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }

}
