<?php

namespace App\Http\Controllers;

use App\Services\DebtService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     * @param DebtService $debtService
     */
    public function __construct(DebtService $debtService)
    {
        $this->debtService = $debtService;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $list = $this->debtService->dashboard($request->user());

        return view('home', compact('list'));
    }
}
