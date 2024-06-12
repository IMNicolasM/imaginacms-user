<?php

namespace Modules\User\Repositories\Cache;

use Illuminate\Database\Eloquent\Collection;
use Modules\User\Entities\UserToken;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;
use Modules\User\Repositories\UserTokenRepository;

class CacheUserTokenDecorator extends BaseCacheDecorator implements UserTokenRepository
{
    /**
     * @var UserTokenRepository
     */
    protected $repository;

    public function __construct(UserTokenRepository $repository)
    {
        parent::__construct();
        $this->entityName = 'user-tokens';
        $this->repository = $repository;
    }

    /**
     * Get all tokens for the given user
     */
    public function allForUser($userId)
    {
        $this->remember(function () use ($userId) {
            return $this->repository->allForUser($userId);
        });
    }

    public function generateFor($userId)
    {
        $this->clearCache();

        return $this->repository->generateFor($userId);
    }
}
