<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InvoiceDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => fake()->name() , 
            'unit' => ['piece' , 'g' , 'kg'][rand(0,2)], 
            'quantity' => rand(1 , 100), 
            'price' =>  rand(10 , 250), 
            'productn_subtotal' => rand(100, 1000), 
            'invoice_id' => Invoice::inRandomOrder()->first()->id , 
        ];
    }
}
