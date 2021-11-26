<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUser;
use App\Repositories\Admin\User\UserRepository;
use App\Models\User;

class RoleController extends Controller
{


  /**
   * RoleController constructor.
   *
   * @param UserRepository $userRepository
   */
  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }


  public function index()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['name' => "Users"]
    ];

    $users =  User::all();
    return view('pages.admin.role.index', [
      'breadcrumbs' => $breadcrumbs,
      'users' => $users,
      'products' => []
    ]);
  }
  public function create()
  {
    $breadcrumbs = [
      ['link' => "/admin", 'name' => "Home"], ['link' => "/admin/users", 'name' => "User Manager"], ['name' => "Create User"]
    ];
    return view('pages.admin.user.create', [
      'breadcrumbs' => $breadcrumbs
    ]);
  }

  public function store(StoreUser $request)
  {

    $this->userRepository->create($request->only(
      'name',
      'email',
      'password',
      // 'roles',
      // 'permissions'
    ));

    return redirect()->route('admin.user.index')->with('success', __('alerts.backend.users.created'));
  }
  public function edit()
  {
  }
  public function update()
  {
  }
  public function destroy()
  {
  }
}
