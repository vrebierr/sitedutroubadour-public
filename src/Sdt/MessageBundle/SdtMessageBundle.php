<?php

namespace Sdt\MessageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SdtMessageBundle extends Bundle
{
	public function getParent()
    {
        return 'OrnicarMessageBundle';
    }
}
