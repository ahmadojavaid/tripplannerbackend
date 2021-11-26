<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\ManageUser;
use App\Http\Requests\Admin\User\StoreUser;
use App\Http\Requests\Admin\User\UpdateUser;
use App\Repositories\Admin\User\UserRepository;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{


  protected $userRepository;
  /**
   * UserController constructor.
   *
   * @param UserRepository $userRepository
   */
  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }


  public function index(ManageUser $request)
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Users"]
    ];

    $users =  $this->userRepository->list();
    return view('pages.admin.user.index', [
      'breadcrumbs' => $breadcrumbs,
      'users' => $users,
    ]);
  }
  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/users", 'name' => "User Manager"], ['name' => "Create User"]
    ];
    return view('pages.admin.user.create', [
      'breadcrumbs' => $breadcrumbs,
      'roleArr' => Role::pluck('name', 'id'),
      'permissionArr' => Permission::pluck('name', 'id')
    ]);
  }

  public function store(StoreUser $request)
  {
    $this->userRepository->create($request->all());

    return redirect()->route('admin.user.index')->with('success', __('User Created Successfully'));
  }


  public function edit(User $user)
  {

    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/users", 'name' => "User Manager"], ['name' => "Update User"]
    ];

    return view('pages.admin.user.edit', [
      'breadcrumbs' => $breadcrumbs,
      'user' => $user,
      'roleArr' => Role::pluck('name', 'id'),
      'permissionArr' => Permission::pluck('name', 'id')
    ]);
  }


  public function update(UpdateUser $request, User $user)
  {
    $this->userRepository->update($user, $request->all());

    return redirect()->route('admin.user.index')->with('success', __('User Updated Successfully'));
  }


  public function destroy()
  {
  }
}
