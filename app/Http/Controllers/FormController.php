<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\RequestFca;
    use App\Services\FcaService;

    class FormController extends Controller
    {
        /**
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
         */
        public function index()
        {
            return view('form');
        }

        /**
         * @param RequestFca $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function verifyFca(RequestFca $request): \Illuminate\Http\RedirectResponse
        {
            $fcnNumber = (string)$request->fcaNumber;
            $fcaResult = (new FcaService)->verifyFcaNumber((string)$fcnNumber);

            if (!$fcaResult) {
                return back()->withErrors(['fcaNumber' => 'Could not verify FCA Number'])->withInput();
            }

            if ($fcaResult['Status'] == 'FSR-API-02-01-00') {
                if ($fcaResult['Data'][0]['FRN'] == $fcnNumber) {
                    return back()->with('success', 'Firm Found: FCA Number Is a Match')->withInput();
                } else {
                    return back()
                        ->withErrors(['fcaNumber' => 'Firm Found: FCA Number Is Not A Match'])->withInput();;
                }
            } else {
                return back()->withErrors(['fcaNumber' => 'Firm Not Found Found'])->withInput();
            }

            return $fcaResult;
        }
    }
