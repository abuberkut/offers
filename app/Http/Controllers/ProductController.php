<?php

namespace App\Http\Controllers;

use App\Entities\ESeller;
use App\Repositories\IProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private IProductRepository $productRepository
    ) {}

    public function sellers(int $id): JsonResponse {
        $sellers = array_map(
            static fn(ESeller $seller) => $seller->present(),
            $this->productRepository->fetchById($id, ["sellers"])->getSellers()
        );

        return response()->json($sellers);
    }
}
