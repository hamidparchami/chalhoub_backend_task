<?php

namespace App\Listeners;

use App\Events\ProductObjectValidatedForCreation;
use App\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProduct
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductObjectValidatedForCreation $event
     * @return product id
     */
    public function handle(ProductObjectValidatedForCreation $event)
    {
        $product = Product::create($event->product);
        return $product;
    }
}
