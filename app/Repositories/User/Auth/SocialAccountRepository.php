<?php

namespace App\Repositories\User\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Models\SocialAccount;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class SocialAccountRepository.
 */
class SocialAccountRepository extends BaseRepository
{
  /**
   * @return string
   */
  public function model()
  {
    return SocialAccount::class;
  }

  /**
   * @param array $data
   *
   * @throws \Exception
   * @throws \Throwable
   * @return User
   */
  public function store(array $data): User
  {
    return DB::transaction(function () use ($data) {
      $user = User::where('email', $data['email'])->first();
      if (!$user) {
        $user = User::create([
          'email' => $data['email'],
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'password' => Hash::make('123456789'),
        ]);
        if ($user) {

          User::$guard_name = "web";
          $user->assignRole('user');
        }
      }
      if (!$user->socialAccount) {
        try {

          $socialAccount = SocialAccount::create([
            'user_id' => $user->id,
            'provider_id' => $data['id'],
            'provider_type' => $data['provider'],
            'token' => $data['token'],
            'avatar' => $data['avatar']
          ]);
        } catch (\Exception  $e) {
          dd($e);
        }
      }
      return $user;
      throw new GeneralException(__('User created'));
    });
  }
}
