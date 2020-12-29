<?php

namespace Scoris\ACL\Repositories\Caches;

use Scoris\ACL\Repositories\Interfaces\RoleInterface;
use Scoris\Support\Repositories\Caches\CacheAbstractDecorator;

class RoleCacheDecorator extends CacheAbstractDecorator implements RoleInterface
{
    /**
     * {@inheritdoc}
     */
    public function createSlug($name, $id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
