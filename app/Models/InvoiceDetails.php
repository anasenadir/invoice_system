<?php

namespace App\Models;

use App\Http\Controllers\Invoices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetails extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'unit',
        'quantity',
        'price',
        'productn_subtotal',
        'invoice_id',
    ];

    public function invoice()
    {
        return $this->BelongsTo(Invoices::class);
    }
}
