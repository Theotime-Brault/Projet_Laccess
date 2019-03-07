<?php

namespace Lacces\LaccesBundle\Repository\Exercise;

/**
 * qcmEnonceVideoFrRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class qcmEnonceVideoFrRepository extends \Doctrine\ORM\EntityRepository
{
  public function findByQcmVideoFrId ($qcmVideoFrId){
    return $this->createQueryBuilder('c')
      ->where('c.qcmVideoFr=:word')
      ->setParameter('word', $qcmVideoFrId)
      ->getQuery()
      ->getResult();
  }

    public function findQcmenonceByQcmAndEnonce($enonce){
        return $this->createQueryBuilder('c')
            ->where('c.enonces=:enonce')
            ->setParameter('enonce', $enonce)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
