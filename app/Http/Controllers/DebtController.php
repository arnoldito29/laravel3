<?php

namespace App\Http\Controllers;

use App\Http\Requests\DebtRequest;
use App\Models\Debt;
use App\Services\DebtService;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * @var DebtService
     */
    protected $debtService;

    /**
     * DebtController constructor.
     * @param DebtService $debtService
     */
    public function __construct(DebtService $debtService)
    {
        $this->debtService = $debtService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $list = $this->debtService->getListByUser($request->user());

        return view('pages.debts.index', compact('list'));
    }

    public function store(DebtRequest $debtRequest)
    {
        $status = $this->debtService->store($debtRequest->user(), $debtRequest->all());

        if (!empty($status)) {
            session()->flash('status', 'Item inserted');
        } else {
            session()->flash('error', 'Item not inserted');
        }

        return redirect()->route('debts.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $users = $this->debtService->getRecipients($request->user());

        return view('pages.debts.create', compact('users'));
    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy(Debt $debt)
    {
        $status = $this->debtService->destroy($debt);

        if (!empty($status)) {
            session()->flash('status', 'Item deleted');
        } else {
            session()->flash('error', 'Item not deleted');
        }

        return redirect()->route('debts.index');
    }
}
