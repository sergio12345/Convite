<?php

namespace App\Models\StarkBank;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\File;

use StarkBank\Project;
use StarkBank\Settings;
use StarkBank\Invoice;

class StarkBankPixPayment extends Model
{
    use HasFactory;

    public function __construct()
    {
        $project = new Project([
            "environment" => config('services.stark_bank.environment'), 
            "id" => config('services.stark_bank.key'), 
            "privateKey" => file_get_contents(config('services.stark_bank.path_to_private_key')),
        ]);

        Settings::setUser($project); 
    }

    public function makePayment($payment)
    {
        $invoice = Invoice::create([
            new Invoice([
                "amount" => intval(number_format($payment['value'], 2, '.', '') * 100),
                "taxId" => $payment['cpf'],
                "name" => $payment['name'],
                "tags" => [
                    'env-'. config('services.stark_bank.environment')
                ],
                'fine' => 0,
                "interest" => 0,
                "descriptions" => [
                    [
                        "key" => "campaign",
                        "value" => "name campaign"
                    ]
                ],
            ])
        ]);

        return $invoice[0];
    }

    /* public function getPayment($payment)
    {
        try {
            $invoice = Invoice::get($payment->payment_id);
        } catch (\Exception $e){
            \Log::info($e->getMessage());
            $invoice = json_decode($e->getMessage());
        }

        return $invoice;
    } */

    public function getQrCode($payment_id)
    {
        $png = Invoice::qrcode($payment_id, ["size" => 6]);
        $fp = fopen(public_path('storage/qrcode.png'), 'w');
        fwrite($fp, $png);
        fclose($fp);

        // S3
        //$file = \Storage::disk('s3')->putFileAs('QrCode', new File(public_path('storage/qrcode.png')), $payment_id . '.png');

        // Local
        $file = \Storage::disk('public')->putFileAs('QrCode', new File(public_path('storage/qrcode.png')), $payment_id . '.png');

        return $file;

    }
}
