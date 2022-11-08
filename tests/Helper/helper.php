<?php

namespace Subjig\Report\App {

    function header(string $value): void
    {
        echo $value;
    }

}

namespace Subjig\Report\Service {

    function setcookie(string $name, string $value): void
    {
        echo "$name: $value";
    }

}