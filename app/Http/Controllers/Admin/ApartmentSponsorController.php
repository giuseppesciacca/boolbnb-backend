<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\ApartmentSponsor;
use App\Models\Apartment;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreApartmentSponsorRequest;
use App\Http\Requests\UpdateApartmentSponsorRequest;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Braintree\Gateway;

class ApartmentSponsorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $apartmentId = $request->query('apartment'); //prendo i valori dall'url
        $apartment = Apartment::where('id', '=', $apartmentId)->first(); //prendo l'elemento con l'id corrispondente

        if (Auth::id() === $apartment->user_id) {
            $sponsorId = $request->query('sponsor');
            $sponsor = Sponsor::where('id', '=', $sponsorId)->first();

            $gateway = new Gateway([
                "environment" => env("BRAINTREE_ENVIRONMENT"),
                "merchantId" => env("BRAINTREE_MERCHANT_ID"),
                "publicKey" => env("BRAINTREE_PUBLIC_KEY"),
                "privateKey" => env("BRAINTREE_PRIVATE_KEY")
            ]);

            $clientToken = $gateway->clientToken()->generate();

            return view('admin.payments.create', compact('apartment', 'sponsor', 'clientToken'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentSponsorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentSponsorRequest $request)
    {
        $apartment_slug = Apartment::where('id', '=', $request->apartment)->value('slug');

        $val_data = $request->validated();

        $val_data['apartment_id'] = $request->apartment;
        $val_data['sponsor_id'] = $request->sponsor;

        $amount = Sponsor::where('id', '=', $request->sponsor)->value('price');
        $nonceFromTheClient = $_POST["payment_method_nonce"];
        $deviceDataFromTheClient = $_POST["device_data"];

        $gateway = new Gateway([
            "environment" => env("BRAINTREE_ENVIRONMENT"),
            "merchantId" => env("BRAINTREE_MERCHANT_ID"),
            "publicKey" => env("BRAINTREE_PUBLIC_KEY"),
            "privateKey" => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'deviceData' => $deviceDataFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if ($result->success) {
            $now = Carbon::now()->timezone('Europe/Rome');

            $apartment_has_already_sponsor = ApartmentSponsor::join('apartments', 'apartment_id', '=', 'id')->where('apartments.id', '=', $request->apartment)->where('expire_date', '>', $now)->orderByDesc('expire_date')->first();
            /* 
            SELECT *
            FROM `apartment_sponsor`
            JOIN `apartments` ON apartment_id = id
            WHERE `apartments`.id = numeroAppartamentoCorrente
              AND expire_date > CURDATE()
            ORDER BY expire_date DESC;
    
            di questi prendi il primo della lista
            */

            if ($apartment_has_already_sponsor) {
                $expire_date_in_string = $apartment_has_already_sponsor->expire_date;

                $expireDateForStartDate = DateTime::createFromFormat('Y-m-d H:i:s', $expire_date_in_string);

                $val_data['start_date'] = $expireDateForStartDate;

                $expireDate = DateTime::createFromFormat('Y-m-d H:i:s', $expire_date_in_string);

                if ($request->sponsor == 1) {
                    $expire_date = $expireDate->modify('+24 hours');
                } elseif ($request->sponsor == 2) {
                    $expire_date = $expireDate->modify('+72 hours');
                } else {
                    $expire_date = $expireDate->modify('+144 hours');
                }

                $val_data['expire_date'] =  $expire_date;
            } else {

                $val_data['start_date'] = Carbon::now()->timezone('Europe/Rome');

                if ($request->sponsor == 1) {
                    $expireDate = Carbon::now()->timezone('Europe/Rome')->addHours(24);
                } elseif ($request->sponsor == 2) {
                    $expireDate = Carbon::now()->timezone('Europe/Rome')->addHours(72);
                } else {
                    $expireDate = Carbon::now()->timezone('Europe/Rome')->addHours(144);
                }

                $val_data['expire_date'] =  $expireDate;
            }

            ApartmentSponsor::create($val_data);

            return to_route('admin.sponsors.show', ['sponsor' => $apartment_slug])->with('message', 'Sponsorizzazione aggiunta con successo');
        } else {
            return redirect()->back()->withErrors('Pagamento fallito, riprovare');
        }
    }
}
