<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_name' => fake()->name() , 
            'customer_email' =>  fake()->email(), 
            'customer_mobile' =>  fake()->e164PhoneNumber() , 
            'company_name' => substr(fake()->company(), 0, 29), 
            'invoice_number' => substr( fake()->swiftBicNumber(), 0, 20), 
            'invoice_date' => fake()->date(), 
            'sub_total' => rand(500 , 1400) , 
            'discount_type' => ['dh' , 'percent'][rand(0 , 1)] , 
            'discount_value' => rand(10 , 150) , 
            'vat' => rand(10 , 1000), 
            'shipping' => rand(10 , 1000) , 
            'total_due' =>rand(500 , 2000) , 
        ];
    }
}
