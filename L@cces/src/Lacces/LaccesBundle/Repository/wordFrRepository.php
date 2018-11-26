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
  public function getWordFrByWord($w){
    return $this->createQueryBuilder('c')
    ->where('c.word = :word')
    ->setParameter('word', $w)
    ->getQuery()
    ->getOneOrNullResult();
  }

  public function findAll (){
    return $this->createQueryBuilder('c')
    ->orderBy('c.popularity', 'DESC')
    ->addOrderBy('c.word', 'ASC')
    ->getQuery()
    ->getResult();
  }

  public function getVideoLinkByWord($w){
    return $this->createQueryBuilder('c')
    ->select('videoLink')
    ->where('c.word = :word')
    ->setParameter('word', $w)
    ->getQuery()
    ->getOneOrNullResult();
  }
}
