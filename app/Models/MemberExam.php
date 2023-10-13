<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MemberExam extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'member_id',
        'exam_id',
        'start',
        'end',
    ];

    protected $appends = ['is_passed'];

    public function getIsPassedAttribute()
    {
        return Carbon::parse($this->attributes['end'])->isPast() ? true : false;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->setDescriptionForEvent(fn (string $eventName) => auth()->user()?->name . " {$eventName} " . $this->getTable());
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->isoFormat('D MMM Y HH:mm');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->isoFormat('D MMM Y HH:mm');
    }

    /**
     * Get the user that owns the Setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }
    public function examAnswers(): HasMany
    {
        return $this->hasMany(ExamAnswer::class);
    }
}
