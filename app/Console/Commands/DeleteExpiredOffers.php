<?php

namespace App\Console\Commands;

use App\Repositories\IOfferRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredOffers extends Command {
    private const ONE_DAY_IN_HOURS = 24;

    public function __construct(
        private IOfferRepository $offerRepository
    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired-offers:delete';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle(): void {
        $allTrashedOffers = $this->offerRepository->fetchOnlyTrashed();
        $currentTime  = now();
        $idsForDelete = [];

        foreach ($allTrashedOffers as $trashedOffer) {
            $hours = $currentTime->diffInHours(Carbon::parse($trashedOffer->getDeletedAt()));
            if ($hours >= self::ONE_DAY_IN_HOURS) {
                $idsForDelete[] = $trashedOffer->getId();
            }
        }

        $this->offerRepository->deleteMany($idsForDelete);
    }
}
