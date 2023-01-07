<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository */
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->middleware('auth');
    }


    /**
     * Shows index Users view
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        abort_if(Gate::denies('users_access'), 403);

        $users = $this->userRepository->paginate(10);

        if (!isset($users)) {
            Flash::error('Users were not found.');

            return view('dashboard');
        } else {

            return view('users.index')
                ->with('users', $users);
        }
    }


    /**
     * Shows create User view
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        abort_if(Gate::denies('users_create'), 403);

        return view('users.create');
    }


    /**
     * Creates new User
     *
     * @param CreateUserRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function store(CreateUserRequest $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_store'), 403);

        $input = $request->all();

        if (!isset($input)) {
            Flash::error('User was not created successfully.');
        } else {
            $user = $this->userRepository->create($input);

            Flash::success($user->fullName . ' was created successfully.');
        }

        return redirect(route('users.index'));
    }


    /**
     * Shows show User view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function show(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_show'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (!isset($user)) {

            Flash::error($user->fullName . ' was not found');

            return redirect(route('users.index'));
        } else {
            return view('users.show')->with('user', $user);
        }
    }


    /**
     * Shows edit User view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function edit(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_edit'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (!isset($user)) {
            Flash::error($user->fullName . ' was not found');

            return redirect(route('users.index'));
        } else {
            return view('users.edit')->with('user', $user);
        }
    }


    /**
     * Updates User using specified id.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function update(int $id, UpdateUserRequest $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (!isset($user)) {

            Flash::error($user->fullName . ' was not found');
        } else {

            $this->userRepository->hashPassword($user);

            $this->userRepository->update($request->all(), $id);

            Flash::success($user->fullName . ' was updated successfully.');
        }

        return redirect(route('users.index'));
    }


    /**
     * Removes User using specified id.
     *
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_destroy'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (!isset($user)) {

            Flash::error($user->fullName . ' was not found');

        } else {

            $this->userRepository->delete($id);

            Flash::success($user->fullName . ' was deleted successfully.');

        }
        return redirect(route('users.index'));
    }


    /**
     * Updates Role for requested User
     *
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function roleUpdate(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('roles_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($request->user_id);

        /** @var Request $roles */
        $roles = $request->roles;

        if (isset($user) && isset($roles)) {

            $user->syncRoles($request->roles);

            Flash::success($user->fullName . ' role updated successfully.');

            return redirect(route('users.index'));

        } else {

            Flash::error('User or Role does not exist!');

            return view('users.edit', $user);
        }
    }


    /**
     * Shows assign role view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function roleShow(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('roles_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        /** @var Role $roles */
        $roles = Role::all();

        if (isset($user) && isset($roles)) {
            return view('roles.edit')->with('user', $user)->with('roles', $roles);
        } else {
            Flash::error('User or Role does not exist!');
            return view('users.edit', $user);
        }
    }
}
