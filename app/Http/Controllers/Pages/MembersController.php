<?php

namespace FELS\Http\Controllers\Pages;

use FELS\Http\Controllers\Controller;
use FELS\Core\Repository\Contracts\UserRepository;

class MembersController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get the list of all current members.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $members = $this->repository->paginate(30);

        return view('pages.members', compact('members'));
    }
}