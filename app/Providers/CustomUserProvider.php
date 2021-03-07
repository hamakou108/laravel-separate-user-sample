<?php


namespace App\Providers;


use App\Models\User;
use Domain\User\UserEmail;
use Domain\User\UserId;
use Domain\User\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\App;

class CustomUserProvider implements UserProvider
{
    private UserRepository $repository;
    private Hasher $hasher;

    public function __construct(
        UserRepository $repository,
        Hasher $hasher
    ) {
        $this->repository = $repository;
        $this->hasher = $hasher;
    }

    public function retrieveById($identifier)
    {
        return App::make(User::class, ['id' => new UserId($identifier)]);
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (!isset($credentials['email'])) {
            return null;
        }

        try {
            $id = $this->repository->getIdByEmail(new UserEmail($credentials['email']));
        } catch (\Exception $e) {
            return null;
        }

        return App::make(User::class, ['id' => $id]);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}
