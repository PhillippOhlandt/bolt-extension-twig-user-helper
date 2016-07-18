<?php

namespace Bolt\Extension\Ohlandt\TwigUserHelper;

use Bolt\Extension\SimpleExtension;
use Bolt\Storage\Repository\UsersRepository;

/**
 * TwigUserHelper extension class.
 *
 * @author Phillipp Ohlandt <phillipp.ohlandt@googlemail.com>
 */
class TwigUserHelperExtension extends SimpleExtension
{
    /**
     * @inheritdoc
     *
     * @return array
     */
    protected function registerTwigFunctions()
    {
        return [
            'users' => 'usersTwig',
            'user' => 'userTwig',
        ];
    }

    public function usersTwig()
    {
        $repo = $this->getUsersRepository();

        return array_map(function ($user) {
            return $user->serialize();
        }, $repo->getUsers());
    }

    public function userTwig($id)
    {
        $repo = $this->getUsersRepository();

        $user = $repo->getUser($id);

        if ($user) {
            return $user->serialize();
        }

        return null;
    }

    protected function getUsersRepository()
    {
        $app = $this->getContainer();
        /** @var UsersRepository */
        return $app['storage']->getRepository('Bolt\Storage\Entity\Users');
    }

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
