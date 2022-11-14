<?php

namespace App\Repository;

use App\Entity\User;
use App\Helper\Metodo;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



    public function buscaDados(?string $email)
    {
        $query  =  $this->createQueryBuilder(Metodo::entidade);
        $alias = Metodo::entidade;
        if ($email !== null) {
            $query->andWhere($query->expr()->like("{$alias}.email", ":email"))
                ->setParameter('email', '%' . $email . '%');
        }
        return $query->getQuery()->getResult();
    }
}
