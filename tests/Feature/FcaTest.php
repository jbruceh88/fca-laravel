<?php

    namespace Tests\Feature;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Support\Facades\Http;
    use Tests\TestCase;

    class FcaTest extends TestCase
    {
        /**
         * A basic feature test example.
         *
         * @return void
         */


        public function testFcaValidationErrorNoneAlphaNumeric()
        {
            $response = $this->post('/verify/fca', ['fcaNumber' => '11111%']);

            $response->assertInvalid(['fcaNumber']);
        }


        public function testFcaValidationErrorToSmall()
        {
            $response = $this->post('/verify/fca', ['fcaNumber' => '11']);

            $response->assertInvalid(['fcaNumber']);
        }

        public function testFcaValidationErrorToLong()
        {
            $response = $this->post('/verify/fca', ['fcaNumber' => '111111111111111111111']);

            $response->assertInvalid(['fcaNumber']);
        }


        public function testFcaFirmNotFound()
        {
            Http::fake([
                'https://register.fca.org.uk/services/V0.1/*' => Http::response(
                    [
                        'Status' => 'FSR-API-02-01-11'
                    ],
                    200, []
                )
            ]);

            $response = $this->post('/verify/fca', ['fcaNumber' => '11111']);
            $response->assertSessionHasErrors(['fcaNumber' => 'Firm Not Found Found']);
        }

        public function testFcaSuccess()
        {
            Http::fake([
                'https://register.fca.org.uk/services/V0.1/*' => Http::response(
                    [
                        'Status' => 'FSR-API-02-01-00',
                        'Data' => [
                            ['FRN' => '11111']
                        ]
                    ],
                    200, []
                )
            ]);

            $response = $this->post('/verify/fca', ['fcaNumber' => '11111']);
            $response->assertSessionHasNoErrors();
        }
    }
