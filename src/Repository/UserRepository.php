<?php

namespace App\Repositories;

use App\Entity\User;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findActiveUser(): array
    {
        return $this->findBy(['status'=> User::STATUS_ACTIVE]);
    }

    public function getUserAllDataById(int $id): User
    {
        $user = $this->findOneBy(['id'=> $id]);
        /**
         * @var User $user
         */
        if (is_null($user)) {
            throw new EntityNotFoundException('User with id: ' . $id . ' is not found');
        }
        $user->getPhones()->count();
        return $user;

    }

    public function getUserAllDataById2(int $id): User
    {
        $qb = $this->createQueryBuilder('u')

            ->leftJoin(Phone::class, 'p', 'WITH', 'p.user = u.id')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
        ;

        $query = $qb->getQuery();
        return $query->getResult()[0];
    }

    public function getBanList()
    {
        $qb = $this->createQueryBuilder('u')
            ->where('u.status = :status')
            ->setParameter('status', User::STATUS_DISABLED)
            ->orderBy('u.login', 'ASC');

        if (new \DateTime() >= new \DateTime('01.11.2022')) {
            $qb->orWhere('u.age < :age')->setParameter('age', 20);
        }
        $query = $qb->getQuery();
        $sql = $query->getSQL();

        return $query->getResult();
    }
}
