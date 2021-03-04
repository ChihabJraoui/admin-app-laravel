<?php

namespace App\Services;

use App\Models\Investment;
use App\Repositories\AccountRepository;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountService
{
    use ApiResponse;

    private $accountRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }

    /**
     * Get many investments
     *
     * @return JsonResponse
     */
    function getManyInvestments()
    {
        return $this->accountRepository->getManyAccounts();
    }

    function getPendingInvestments()
    {
        return $this->accountRepository->getPending();
    }

    /**
     * Approve one investment
     *
     * @return JsonResponse
     */
    function approve(Request $request, $id)
    {
        return $this->accountRepository->approve($request, $id);
    }

    /**
     * Approve one investment
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    function decline(Request $request, $id)
    {
        return $this->accountRepository->decline($request, $id);
    }

    /**
     * Add statement
     *
     * @param Request $request
     * @param $accountId
     * @return JsonResponse
     * @throws Exception
     */
    function addStatement(Request $request, $accountId)
    {
        return $this->accountRepository->addStatement($request, $accountId);
    }

    /**
     * Delete statement
     *
     * @param Request $request
     * @param $statementId
     * @return JsonResponse
     * @throws Exception
     */
    function deleteStatement(Request $request, $statementId)
    {
        return $this->accountRepository->deleteStatement($request, $statementId);
    }
}
