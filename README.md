"# This is chalhoub backend task by Hamid Parchami" 
<strong>Run the Project</strong>
docker-compose up -d

<strong>Endpoints:</strong><br>
1. list of products:<br>
GET localhost:8080/api/v1/products

2. product detail:<br>
GET localhost:8080/api/v1/products/{product_id}

3. create new product<br>
POST /api/v1/products HTTP/1.1<br>
Host: localhost:8080<br>
Content-Type: application/json<br>
Cache-Control: no-cache<br>
Postman-Token: 593131f3-0870-426d-98a4-061f0d5be716<br><br>
{"title":"product test 1", "abstract":"abstract for product test 1", "description":"description for product test 1", "image_url":"http://lorempixel.com/400/200", "price":500, "stock":5}

<strong>Tests:</strong><br>
run vendor/bin/phpunit

<strong>Seeder:</strong><br>
php artisan db:seed --class=ProductsTableSeeder --env=artisan