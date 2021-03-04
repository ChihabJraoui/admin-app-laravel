<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function __construct()
    {
    }

    /**
     * Get many investments
     *
     * @return mixed
     */
    function getManyUsers()
    {
        return User::orderBy('created_at', 'DESC')
            ->withCount('accounts')
            ->get();
    }

    /**
     * Get many investments
     *
     * @return mixed
     */
    function getLastJoinedUsers()
    {
        return User::orderBy('created_at', 'DESC')
            ->whereHas('accounts', function($query)
            {
                $query->whereNotNull('accepted_at');
            })
            ->withCount('accounts')
            ->get();
    }

    /**
     * Get one user details
     * with accounts
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    function getOneUserWithDetails($request, $id)
    {
        return User::where('id', $id)
            ->with([
                'accounts.statements' => function($query) { $query->orderBy('date', 'desc'); }
            ])
            ->first();
    }
}
