<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Repositories\IOfferRepository;
use App\Repositories\OfferRepository;
use Illuminate\Http\Request;

class TestController extends Controller {
    public function test() {
        dd(1);
    }
}
