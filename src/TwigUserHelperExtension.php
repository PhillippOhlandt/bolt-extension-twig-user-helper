<?php

namespace Bolt\Extension\Ohlandt\TwigUserHelper;

use Bolt\Extension\SimpleExtension;

/**
 * TwigUserHelper extension class.
 *
 * @author Phillipp Ohlandt <phillipp.ohlandt@googlemail.com>
 */
class TwigUserHelperExtension extends SimpleExtension
{
    /**
     * Such name, much pretty.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return 'Twig User Helper';
    }
}
