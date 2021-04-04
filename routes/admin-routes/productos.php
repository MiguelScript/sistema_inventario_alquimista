<?php

use App\Http\Controllers\Products\CreateProductController;
use App\Http\Controllers\Products\UpdateProductController;
use App\Http\Controllers\Products\DeleteProductController;

Route::post('/admin-productos', [ProductsController::class, 'get_products']);
Route::post('/productos-crear', [CreateProductController::class, '__invoke']);
Route::post('/productos-actualizar', [UpdateProductController::class, '__invoke']);
Route::post('/productos-eliminiar', [DeleteProductController::class, '__invoke']);
