<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    public const STATUS_BILLED = 'B';
    public const STATUS_PAID = 'P';
    public const STATUS_VOID = 'V';

    public const STATUS_LABELS = [
        self::STATUS_BILLED => 'Billed',
        self::STATUS_PAID => 'Paid',
        self::STATUS_VOID => 'Void',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'amount',
        'status',
        'billed_date',
        'paid_date',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'billed_date' => 'date',
        'paid_date' => 'date',
    ];

    /**
     * @var array<int, string>
     */
    protected $appends = ['status_label'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }
}
