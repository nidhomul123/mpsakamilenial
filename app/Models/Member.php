<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Member extends Authenticatable
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'grade_id',
        'name',
        'image',
        'card',
        'email',
        'gender',
        'birth_place',
        'birth_date',
        'gudep',
        'kwarran',
        'number_id',
        'level',
        'address',
        'phone',
        'instagram',
        'password',
        'status'
    ];

    protected $appends = ['full_path_image', 'full_path_card'];

    public function getFullPathImageAttribute()
    {
        return asset('storage/image/member/' . $this->attributes['image']);
    }

    public function getFullPathCardAttribute()
    {
        return asset('storage/image/member-card/' . $this->attributes['card']);
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
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
}
