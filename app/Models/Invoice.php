<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_name' , 
    'customer_email' , 
    'customer_mobile',
    'company_name' ,
    'invoice_number' ,
    'invoice_date' , 'sub_total' ,'discount_type' ,  'discount_value' , 'vat' ,'shipping' , 'total_due'
    ];


    public function details(){
        return $this->hasMany(InvoiceDetails::class , 'invoice_id');
    }
}
