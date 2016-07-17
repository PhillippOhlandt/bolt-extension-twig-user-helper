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
        return $this->getActiveUsers();
    }

    public function userTwig($id)
    {
        $repo = $this->getUsersRepository();

        return $repo->getUser($id);
    }

    protected function getUsersRepository()
    {
        $app = $this->getContainer();
        /** @var UsersRepository */
        return $app['storage']->getRepository('Bolt\Storage\Entity\Users');
    }

    protected function getActiveUsersQueryBuilder(UsersRepository $repo)
    {
        $qb = $repo->createQueryBuilder();
        $qb->where('enabled = :enabled');
        $qb->setParameter('enabled', 1);

        return $qb;
    }

    protected function getActiveUsers()
    {
        $repo = $this->getUsersRepository();
        $qb = $this->getActiveUsersQueryBuilder($repo);
        $users = array_map(function ($user) {
            $user->setPassword(null);
            $user->setShadowpassword(null);
            $user->setShadowtoken(null);
            $user->setShadowvalidity(null);
            return $user;
        }, $repo->findwith($qb));

        return $users;
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
