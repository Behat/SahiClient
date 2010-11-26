<?php

namespace Everzet\SahiDriver\Accessor\Table;

use Everzet\SahiDriver\Connection;
use Everzet\SahiDriver\Accessor\AbstractDomAccessor;
use Everzet\SahiDriver\Exception;

/*
 * This file is part of the SahiDriver.
 * (c) 2010 Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * TableHeader Element Accessor.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class TableHeaderAccessor extends AbstractDomAccessor
{
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'tableHeader';
    }
}
