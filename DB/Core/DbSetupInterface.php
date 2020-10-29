<?php

namespace DB\Core;

interface DbSetupInterface
{
    /**
     * @return mixed
     */
    public function initialize();
}
