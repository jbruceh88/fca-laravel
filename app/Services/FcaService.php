<?php

    namespace App\Services;

    use Illuminate\Support\Facades\Http;

    class FcaService
    {
        /**
         * @param string $fcaNumber
         * @return array|bool
         */
        public function verifyFcaNumber(string $fcaNumber): array|bool
        {
            $uri = sprintf("/Firm/{$fcaNumber}");
            $url = env('FCA_DOMAIN') . $uri;

            try {
                $fcaResponse = Http::withHeaders([
                    'X-AUTH-EMAIL' => env('FCA_EMAIL'),
                    'X-AUTH-KEY' => env('FCA_KEY')
                ])->get($url, [
                    'Firm' => $fcaNumber
                ]);
            } catch (\Exception $e) {
                abort(500, 'Unable to connect to service');
            }

            if ($fcaResponse->successful()) {
                return json_decode($fcaResponse, true);
            } else {
                return false;
            }
        }
    }
