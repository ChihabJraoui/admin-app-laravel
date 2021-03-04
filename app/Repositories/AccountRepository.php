<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Statement;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AccountRepository
{
    public function __construct()
    {
    }

    /**
     * Get many investments
     *
     * @return mixed
     */
    function getManyAccounts()
    {
        return Account::all();
    }

    function getPending()
    {
        $pendingInvestments = Account::whereNull('accepted_at')->whereNull('declined_at')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return $pendingInvestments;
    }

    /**
     * Get one investment
     *
     * @param $id
     * @return mixed
     */
    function getOneAccount($id)
    {
        return Account::find($id);
    }

    /**
     * Approve one investment
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    function approve(Request $request, $id)
    {
        return DB::transaction(function() use ($request, $id)
        {
            $investment = $this->getOneAccount($id);

            $investment->principal = $request->has('principal') ? $request->get('principal') : null;
            $investment->interest_rate = $request->has('interest_rate') ? $request->get('interest_rate') : null;
            $investment->accepted_at = Carbon::now();
            $investment->updated_at = Carbon::now();
            $investment->save();

            return [
                'message' => 'Account is approved'
            ];
        });
    }

    /**
     * Decline one account
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    function decline(Request $request, $id)
    {
        return DB::transaction(function() use ($request, $id)
        {
            $account = $this->getOneAccount($id);

            $account->declined_at = Carbon::now();
            $account->updated_at = Carbon::now();
            $account->save();

            return [
                'message' => 'Account is declined'
            ];
        });
    }

    /**
     * Add statement
     *
     * @param Request $request
     * @param $accountId
     * @return mixed
     * @throws Exception
     */
    function addStatement(Request $request, $accountId)
    {
        $account = Account::find($accountId);

        if($account->declined_at != null)
        {
            throw new Exception('Cannot add statement to a declined account.');
        }

        if($account->accepted_at == null && $account->declined_at == null)
        {
            throw new Exception('Cannot add statement to a pending account.');
        }

        // Get date from request
        $date = Carbon::parse($request->get('date'))->toDateString();

        $statements = $account->statements()->where('date', $date)->get();

        if($statements->count() > 0)
        {
            throw new UnprocessableEntityHttpException('A statement for the date '.$date.' is already added to this account.');
        }

        // Create statement
        $statement = $account->statements()->create([
            'amount' => $account->principal * ($account->interest_rate / 100),
            'date' => $date
        ]);

        return [
            'id' => $statement->id,
            'created_at' => $statement->created_at,
            'message' => 'Statement created successfulyy'
        ];
    }

    /**
     * Delete statement
     *
     * @param Request $request
     * @param $statementId
     * @return mixed
     * @throws Exception
     */
    function deleteStatement(Request $request, $statementId)
    {
        $statement = Statement::find($statementId);
        $statement->delete();

        return [
            'message' => 'Statement deleted'
        ];
    }
}
