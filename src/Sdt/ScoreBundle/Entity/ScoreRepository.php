<?php

namespace Sdt\ScoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ScoreRepository extends EntityRepository
{
    public function search($artist, $song, $category)
    {
        $qb = $this->createQueryBuilder('s');

        if($category != '')
        {
            $qb->where('s.artist LIKE :artist AND s.song LIKE :song')
               ->setParameter('artist', '%'.$artist.'%')
               ->setParameter('song', '%'.$song.'%')
               ->andWhere('s.category = :category')
               ->setParameter('category', $category)
               ->andWhere('s.enabled = true')
            ;
        }
        else
        {
            $qb->where('s.artist LIKE :artist AND s.song LIKE :song')
               ->setParameter('artist', '%'.$artist.'%')
               ->setParameter('song', '%'.$song.'%')
               ->andWhere('s.enabled = true')
            ;
        }

        return $qb->getQuery()->getResult();
    }
}