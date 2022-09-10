<?php

namespace App\Http\Middleware;

use App\Repositories\IOfferRepository;
use App\Repositories\ISellerRepository;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DeleteOfferMiddleware {
    public function __construct(
        private ISellerRepository $sellerRepository
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|RedirectResponse|Response
     */
    public function handle(Request $request, Closure $next): Response|JsonResponse|RedirectResponse {
        $offerId = (int)$request->route("id");
        $sellerToken = $request->header("token");

        try {
            $seller = $this->sellerRepository->fetchByToken($sellerToken, ["offers"]);
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage(), $throwable->getTrace());
            return response()->json("Could not fetch seller by token. Error message {$throwable->getMessage()}", ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

        if (!$seller) {
            return response()->json("Not found seller with with given token", ResponseAlias::HTTP_NOT_FOUND);
        }

        foreach ($seller->getOffers() as $offer) {
            if ($offer->getId() === $offerId) {
                return $next($request);
            }
        }

        return response()->json("You are not allowed", ResponseAlias::HTTP_UNAUTHORIZED);
    }
}
