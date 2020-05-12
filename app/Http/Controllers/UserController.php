<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {
        return view('pages.users.profile');
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request)
    {
        $status = $this->userService->update($request->user(), $request->all());

        if (!empty($request->file)) {
            $fileName = $request->user()->id .'.'. $request->file->extension();

            $request->file->move(public_path('uploads'), $fileName);

            $status = $this->userService->update($request->user(), ['avatar' => $fileName]);
        }

        if (!empty($status)) {
            session()->flash('status', 'updated');
        } else {
            session()->flash('error', 'not updated');
        }

        return redirect()->route('users.profile');
    }
}
