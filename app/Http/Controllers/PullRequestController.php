<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\PullRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PullRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $members = Member::with(['openPrs', 'reviewedPrs'])->get();

        foreach ($members as $member) {
            $member['score'] = $member->reviewedPrs->count() * 2;
        }

        return $this->okResponse('successful', $members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PullRequest  $pullRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PullRequest $pullRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PullRequest  $pullRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PullRequest $pullRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PullRequest  $pullRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PullRequest $pullRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PullRequest  $pullRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PullRequest $pullRequest)
    {
        //
    }
}
