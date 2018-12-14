<?php

namespace App\Helpers\Tools;

use Session;

class Snackbar
{
    private function make($text, $type)
    {
        Session::flash('snackbar', [
            'text' => $text,
            'type' => $type,
        ]);

        return $this;
    }

    public function bar($text, $type = 'success')
    {
        return $this->make($text, $type);
    }

    public function info($text)
    {
        return $this->bar($text, 'info');
    }

    public function success($text)
    {
        return $this->bar($text, 'success');
    }

    public function error($text)
    {
        return $this->bar($text, 'error');
    }

}
