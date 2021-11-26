<?php

namespace App\Repositories\Admin\User;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return User::class;
  }


  public function list()
  {
    return User::all();
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return User
   */
  public function create(array $data): User
  {
    return DB::transaction(function () use ($data) {
      $user = parent::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'phone_no' => $data['phone_no'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
      ]);

      if ($user) {
        if ($data['role'] == 1 || $data['role'] == 3) {
          User::$guard_name = "admin";
          if ($data['role'] == 3)
            $user->assignRole('blog user');
          else
            $user->assignRole('admin');
        } else {
          User::$guard_name = "web";
          $user->assignRole('user');
          if (isset($data['permissions']))
            $user->givePermissionTo($data['permissions']);
        }

        return $user;
      }

      throw new Exception(__('exceptions.backend.access.users.create_error'));
    });
  }

  /**
   * @param User  $user
   * @param array $data
   *
   * @throws Exception
   * @throws \Exception
   * @throws \Throwable
   * @return User
   */
  public function update(User $user, array $data): User
  {
    return DB::transaction(function () use ($user, $data) {
      $arr = [
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'phone_no' => $data['phone_no'],
        'email' => $data['email'],
      ];
      if ($data['password'])
        $arr['password'] = Hash::make($data['password']);


      if ($user->update($arr)) {
        if ($data['role'] == 1 || $data['role'] == 3) {
          User::$guard_name = "admin";
          if ($data['role'] == 3) {

            $user->syncRoles('blog user');
          } else
            $user->syncRoles('admin');
        } else {
          User::$guard_name = "web";
          $user->syncRoles('user');
          if (isset($data['permissions']))
            $user->givePermissionTo($data['permissions']);
        }

        return $user;
      }

      throw new Exception(__('exceptions.backend.access.users.update_error'));
    });
  }



  /**
   * @param User $user
   *
   * @throws Exception
   * @throws \Exception
   * @throws \Throwable
   * @return User
   */
  public function forceDelete(User $user): User
  {
    if ($user->deleted_at === null) {
      throw new Exception(__('exceptions.backend.access.users.delete_first'));
    }

    return DB::transaction(function () use ($user) {
      // Delete associated relationships
      $user->passwordHistories()->delete();
      $user->providers()->delete();

      if ($user->forceDelete()) {

        return $user;
      }

      throw new Exception(__('exceptions.backend.access.users.delete_error'));
    });
  }
}
