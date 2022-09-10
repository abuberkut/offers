<?php

namespace App\Http\Controllers;

use App\LoadConfig;
use App\OfferFilters;
use App\Repositories\IOfferRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OfferController extends Controller {
    public function __construct(private IOfferRepository $offerRepository) {}

    public function load(Request $request): JsonResponse {
        $loadConfig = new LoadConfig(
            page: $request->get("page") ?? LoadConfig::DEFAULT_PAGE,
            perPage: $request->get("per_page") ?? LoadConfig::DEFAULT_PER_PAGE,
            sortingField: $request->get("sorting_field") ?? LoadConfig::DEFAULT_SORTING_FIELD,
            sortingDirection: $request->get("sorting_direction") ?? LoadConfig::DEFAULT_SORTING_DIRECTION,
        );

        $offerFilters = (new OfferFilters())
            ->setProductName($request->get("product_name"))
            ->setMaxPrice($request->get("max_price"));

        return response()->json($this->offerRepository->load($loadConfig, $offerFilters));
    }

    public function delete(int $id): JsonResponse {
        if (!$this->offerRepository->exists($id)) {
            return response()->json("Not found offer with id $id", ResponseAlias::HTTP_NOT_FOUND);
        }

        DB::beginTransaction();
        try {
            $this->offerRepository->softDelete($id);
            DB::commit();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error($throwable->getMessage(), $throwable->getTrace());
            return response()->json("Could not delete offer with id $id. Error message {$throwable->getMessage()}", ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json("Offer with given id $id successfully deleted",ResponseAlias::HTTP_OK);
    }

    public function restore(int $id): JsonResponse {
        $this->offerRepository->restore($id);

        if (!$this->offerRepository->exists($id)) {
            return response()->json("Not found offer with id $id", ResponseAlias::HTTP_NOT_FOUND);
        }

        return response()->json("Offer with given id $id restored successfully", ResponseAlias::HTTP_OK);
    }
}
