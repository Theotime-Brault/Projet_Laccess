<?php

namespace Lacces\LaccesBundle\Repository;

/**
 * wordFrRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class wordFrRepository extends \Doctrine\ORM\EntityRepository
{
  public function findByWord($w){
    return $this->createQueryBuilder('c')
    ->where('c.word = :word')
    ->setParameter('word', $w)
    ->leftJoin('c.wordEns', 'b')
    ->addSelect('b')
    ->getQuery()
    ->getOneOrNullResult();
  }

  public function findByPopularity ($motif){
    return $this->createQueryBuilder('c')
        ->select('c.word')
        ->where('c.word LIKE :word')
        ->setParameter('word', $motif)
        ->orderBy('c.popularity', 'DESC')
        ->addOrderBy('c.word', 'ASC')
        ->getQuery()
        ->setMaxResults(12)
        ->getResult();
  }

  public function findAll(){
    return $this->createQueryBuilder('c')
    ->orderBy('c.word', 'ASC')
    ->getQuery()
    ->getResult();
  }
}
