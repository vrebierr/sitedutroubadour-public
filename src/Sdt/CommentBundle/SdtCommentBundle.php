<?php

namespace Sdt\CommentBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SdtCommentBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSCommentBundle';
    }
}
