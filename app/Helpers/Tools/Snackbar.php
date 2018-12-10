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

    public function white($text)
    {
        return $this->bar($text, 'white');
    }

    public function primary($text)
    {
        return $this->bar($text, 'primary');
    }

    public function success($text)
    {
        return $this->bar($text, 'success');
    }

    public function warning($text)
    {
        return $this->bar($text, 'warning');
    }

    public function danger($text)
    {
        return $this->bar($text, 'danger');
    }

    public function dark($text)
    {
        return $this->bar($text, 'dark');
    }
}
