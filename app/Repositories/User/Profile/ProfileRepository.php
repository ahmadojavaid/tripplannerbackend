<?php

namespace App\Repositories\User\Profile;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class ProfileRepository.
 */
class ProfileRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return User::class;
  }

  /**
   * @param User  $user
   * @param array $data
   *
   * @throws GeneralException
   * @throws \Exception
   * @throws \Throwable
   * @return User
   */
  public function update(User $user, array $data): User
  {
    return DB::transaction(function () use ($user, $data) {
      $user->update([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'phone_no' => $data['phone_no'],
        'email' => $data['email'],
      ]);

      if (isset($data['avatar']))
        $user->updateFile($data['avatar'], 'id', 'avatar');


      return $user;

      throw new GeneralException(__('Error while updating user'));
    });
  }
}
