<?php

namespace Lacces\LaccesBundle\Repository\Exercise;

/**
 * comparaisonVideoFrRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class comparaisonVideoFrRepository extends \Doctrine\ORM\EntityRepository
{
  public function findByWordFrId ($wordFrId){
    return $this->createQueryBuilder('c')
      ->select('c.id')
      ->where('c.wordFr=:word')
      ->setParameter('word', $wordFrId)
      ->getQuery()
      ->getResult();
  }

    public function findByWord()
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.wordFr', 'w')
            ->getQuery()
            ->getResult();
    }
}
