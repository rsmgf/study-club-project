<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'status', 'due_date'];
    
    protected $dates = ['due_date', 'deleted_at'];

    const STATUS_PENDING = 'Pending';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_OVERDUE = 'Overdue';

    public function scopeActive($query)
    {
        return $query->where('status', '!=', self::STATUS_COMPLETED);
    }
}

