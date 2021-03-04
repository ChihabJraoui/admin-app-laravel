<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $accountService;

    public function __construct()
    {
        $this->accountService = new AccountService();
    }

    /**
     * Get Pending Investments
     *
     * @return JsonResponse
     */
    function getManyInvestments()
    {
        return $this->success($this->accountService->getManyInvestments());
    }

    /**
     * Get Pending Investments
     *
     * @return JsonResponse
     */
    function getPendingInvestments()
    {
        return $this->success($this->accountService->getPendingInvestments());
    }

    /**
     * Get Pending Investments
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    function approve(Request $request, $id)
    {
        return $this->success($this->accountService->approve($request, $id));
    }

    /**
     * Get Pending Investments
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    function decline(Request $request, $id)
    {
        return $this->success($this->accountService->decline($request, $id));
    }

    /**
     * Add statement
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    function addStatement(Request $request, $id)
    {
        return $this->success($this->accountService->addStatement($request, $id));
    }

    /**
     * Delete statement
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    function deleteStatement(Request $request, $id)
    {
        return $this->success($this->accountService->deleteStatement($request, $id));
    }
}
