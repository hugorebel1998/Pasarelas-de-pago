<?php   
namespace App\Services;
 
use App\Traits\ConsumesExternalServices;
 
class PaypalService 
{
    use ConsumesExternalServices;

	protected $baseUri;
 
	protected $clientId;
 
	protected $clientSecret;
	
	public function __construct()
	{
		# code...
		$this->baseUri= config('services.paypal.base_uri');
		$this->clientId= config('services.paypal.client_id');
        $this->clientSecret= config('services.paypal.secret');
        
	}
 
	public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
	{
		# code...
		$headers['Authorization'] = $this->resolveAccessToken();
	}
 
	public function decodeResponse($response)
	{
		# code...
		return json_decode($response);
	}
	public function resolveAccessToken()
	{
		# code...
		$credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");
 
		return "Basic {$credentials}";
	}
 
    public function createOrder($value, $currency)
    {
        return $this->makeRequest(
            'POST',
            '/v2/checkout/orders',
            [],
            [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' => strtoupper($currency),
                            'value' => $value,
                        ]
                    ]
                        ],
                'application_context' => [
                    'brand_name' => config('app.name'),
                    'shipping_preferenc' => 'NO_SHIPPING',
                    'user_action' => 'PAY_NOW',
                    'return_url' => route('payment.approval'),
                    'cancel_url' => route('payment.cancelled'),
                ]
            ],
            [],
            $isJsonRequest = true,
        );
    }
}
