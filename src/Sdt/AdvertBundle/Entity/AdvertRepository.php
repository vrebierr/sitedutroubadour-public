<?php

namespace Sdt\AdvertBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AdvertRepository extends EntityRepository
{
    public function search($category, $ageMin, $ageMax, $locale)
    {
        $qb = $this->createQueryBuilder('a');

        $qb->where(':category MEMBER OF a.lookingFor')
           ->setParameter('category', $category)
           ->andWhere('a.ageMin >= :ageMin')
           ->setParameter('ageMin', $ageMin)
           ->andWhere('a.ageMax <= :ageMax')
           ->setParameter('ageMax', $ageMax)
           ->andWhere($qb->expr()->in('a.locale', $locale))
        ;

        return $qb->getQuery()->getResult();
    }

    public function findAllDefault()
    {
        $datetime = new \Datetime();
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.updatedAt >= :update')
           ->setParameter('update', $datetime->modify('-30 day'))
        ;

        return $qb->getQuery()->getResult();
    }
}