<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'status', 'due_date', 'user_id'];
    protected $dates = ['due_date', 'deleted_at'];

    const STATUS_PENDING = 'Pending';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_OVERDUE = 'Overdue';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope to get tasks only for the logged-in user
    public function scopeOwnedByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Automatically mark overdue tasks
    public static function updateOverdueTasks($userId)
    {
        self::where('user_id', $userId)
            ->where('status', self::STATUS_PENDING)
            ->where('due_date', '<', Carbon::now())
            ->update(['status' => self::STATUS_OVERDUE]);
    }
}
