<?php

namespace App\Http\Controllers;

use App\Models\CommitteeMember;
use Illuminate\Contracts\View\View;

class CommitteeMemberController extends Controller
{
    public function __invoke(): View
    {
        $committeeMembers = CommitteeMember::orderBy('order')->get();

        return view('committee-members.index', [
            'committeeMembers' => $committeeMembers,
        ]);
    }
}
