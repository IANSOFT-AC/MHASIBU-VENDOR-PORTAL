<?php

namespace app\Library;

use yii\base\Component;

class Utility extends Component
{
    public function processPath($path)
    {
        $trim = trim($path);
        $dashed = str_replace(' ', '_', $trim);
        return $dashed;
    }
}
