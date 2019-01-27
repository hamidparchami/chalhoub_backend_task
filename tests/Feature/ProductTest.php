<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * test product creation
     *
     * @return void
     * @throws \Exception
     */
    public function testCreateProduct()
    {
        $faker = \Faker\Factory::create();
        $productData = [
            'id' => \Ramsey\Uuid\Uuid::uuid1(),
            'title'        => $faker->title,
            'abstract'      => $faker->realText(500),
            'description'   => $faker->text,
            'image_url'     => $faker->imageUrl($width = 640, $height = 480),
            'price'         => $faker->randomNumber(3),
            'stock'         => $faker->randomNumber(2),
        ];

        $response = $this->json('POST', '/api/v1/products', $productData);

        $response->assertStatus(201)
                 ->assertJson([
                    'success' => true,
                 ]);
    }

    /**
     * test products list endpoint
     * @return void
     */
    public function testRetrieveProductsList()
    {
        $response = $this->json('GET', '/api/v1/products');

        $response->assertStatus(200);
        $totalProducts = count($response->getOriginalContent()['data']);
        $this->assertGreaterThan(0, $totalProducts);
    }

    /**
     * test product detail endpoint
     * @return void
     */
    public function testProductDetail()
    {
        $product = Product::orderBy('created_at', 'desc')->first(['id']);
        $response = $this->json('GET', '/api/v1/products/' . $product->id);

        $response->assertStatus(200);
    }
}
