<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ordersController extends Controller
{

    public function order(): JsonResponse
    {
        $response = [
            "client" => [
                "id" => 1,
                "nombre" => "Carlos",
                "apellido" => "Hernandez",
                "password" => '',
                "correo" => "carlos@gmail.com",
                "telefono" => "102512120",
                "longitud" => 1.002002,
                "latitud" => 1.3230355,
                "tipo_cliente" => "das",
                "store_id" => 1
            ],
            "products" => [
                [
                    "imagen"=> "https://i.imgur.com/qzn9ifW.png",
                    "categoria" => "categoria numero 1 texto largo",
                    "id" => 1,
                    "pedidoId" => 1,
                    "product_id" => 1,
                    "comentario" => 'comentario del pedido',
                    "productId" => 1,
                    "cantidad" => 2,
                    "opcionId" => 2,
                    "precio" => 15.0,
                    "sizesid" => 1,
                    "producto" => "el producto numero #1 con texto algo largo",
                    "size" => "1",
                    "modificadores" => [
                        [
                            "id" => 1,
                            "name" => "Modificadores #1",
                            "selection_model" => "New",
                            "choices_select" => "A",
                            "min" => 12,
                            "max" => 10,
                            "storeId" => 1,
                            "estado" => false,
                            "order" => "1",
                            "detalles" => [
                                [
                                    "id" => 1,
                                    "name" => "detalle 1",
                                    "order" => 1,
                                    "modificadorId" => 1,
                                    "upcharge" => 10.0
                                ],
                                [
                                    "id" => 1,
                                    "name" => "detalle 2",
                                    "order" => 1,
                                    "modificadorId" => 1,
                                    "upcharge" => 10.0
                                ],
                                [
                                    "id" => 1,
                                    "name" => "detalle 3",
                                    "order" => 1,
                                    "modificadorId" => 1,
                                    "upcharge" => 10.0
                                ],
                                [
                                    "id" => 1,
                                    "name" => "detalle 3",
                                    "order" => 1,
                                    "modificadorId" => 1,
                                    "upcharge" => 10.0
                                ]
                            ]
                        ],
                    ]
                ]
            ],
            "shippingAddress" => "new order with comment",
            "indications" => "new one indications",
            "paymentOption" => "Cash",
            "telephone" => "10202110",
            "orderDate" => Carbon::now()->format('Y-m-d h:i:s'),
            "status" => 1,
            "delivery" => true,
            "tip" => 1,
            "discounts" => 1
        ];
        return response()->json($response);
    }
}
