<?php

foreach (glob(__DIR__ . '/Includes/*.php') as $filename) {
    include_once $filename;
}
