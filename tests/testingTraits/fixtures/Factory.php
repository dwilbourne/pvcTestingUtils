<?php

namespace pvcTests\testingutils\testingTraits\fixtures;

use stdClass;

class Factory
{
    public function makeStdClass(): StdClass
    {
        return new StdClass();
    }
}