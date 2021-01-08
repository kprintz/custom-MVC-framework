<?php

namespace Model\Calculations;

use Model\AbstractResource;

class CalculationsResource extends AbstractResource
{
    public string $COL_IP = 'ip';
    public string $COL_DATE = 'date';
    public string $COL_CALCULATION = 'calculation';

    public function getColumnNames()
    {
        return [
            $this->COL_ID,
            $this->COL_IP,
            $this->COL_DATE,
            $this->COL_CALCULATION,
            $this->COL_DELETED
        ];
    }
}
