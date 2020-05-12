<?php

namespace App\Services;

use App\Models\Debt;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DebtService
{
    /**
     * @var Debt
     */
    protected $debt;

    /**
     * @var int
     */
    private $limit = 10;

    /**
     * DebtService constructor.
     * @param Debt $debt
     */
    public function __construct(Debt $debt)
    {
        $this->debt = $debt;
    }

    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function getListByUser(User $user): LengthAwarePaginator
    {
        $list = $this->debt::where('user_id', $user->id)
            ->paginate($this->limit);

        return $list;
    }

    /**
     * @param User $user
     * @param array $requestData
     * @return bool
     */
    public function store(User $user, array $requestData): bool
    {
        $debt = !empty($requestData['debt']) ? true : false;
        $item = new Debt();
        $item->user_id = $user->id;
        $item->name = $requestData['title'];
        $item->recipient = !empty($requestData['recipient']) ? $requestData['recipient'] : $requestData['recipient_list'];
        $item->setAmount($debt, $requestData['amount']);

        return $item->save();
    }

    /**
     * @param Debt $debt
     * @return bool
     * @throws \Exception
     */
    public function destroy(Debt $debt): bool
    {
        return $debt->delete();
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function getRecipients(User $user): Collection
    {
        $list = $this->debt::where('user_id', $user->id)->get();

        return $list;
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function dashboard(User $user): Collection
    {
        $list = $this->debt::selectRaw("MONTH(created_at) as month, Year(created_at) as year, SUM(amount) as amount")
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'ASC')
            ->groupBy('year')
            ->groupBy('month')
            ->get();

        $amount = 0;

        foreach ($list as $item) {
            $item->amount += $amount;
            $amount = $item->amount;
        }

        return $list;
    }
}
