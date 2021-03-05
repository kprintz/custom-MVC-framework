<?php
/**
 * @Author: katherine
 */

namespace View\Block;

use Model\Users\Users;

class DatabaseDisplay extends AbstractBlock
{
    protected $template = "View/Templates/database_display.phtml";

    public function displayUsername()
    {
        return $_SESSION['username'];
    }
}
