<?php

namespace Kunstmaan\TranslatorBundle\Service\Stasher;

use Kunstmaan\TranslatorBundle\Entity\TranslationDomain;
use Kunstmaan\TranslatorBundle\Entity\Translation;
use Kunstmaan\TranslatorBundle\Model\Translation\TranslationGroup;

class DoctrineORMStasher implements StasherInterface
{

    private $translationRepository;
    private $translationDomainRepository;
    private $entityManager;

    public function doesDomainExist(TranslationDomain $domain)
    {

    }

    public function doesTranslationExist(Translation $translation)
    {

    }

    public function addTranslation(Translation $translation)
    {

    }

    public function updateTranslation(Translation $translation)
    {

    }

    public function getTranslationGroupByKeywordAndDomain($keyword, $domain)
    {
        $translations = $this->translationRepository->findBy(array('keyword' => $keyword, 'domain' => $domain));
        $translationGroup = new TranslationGroup;
        $translationGroup->setTranslationDomain($domain);
        $translationGroup->setKeyword($keyword);
        $translationGroup->setTranslations($translations);

        return $translationGroup;
    }

    public function getTranslationDomainByName($name)
    {
        $result = $this->translationDomainRepository->findBy(array('name' => $name));

        if(is_array($result)) {
            return reset($result);
        }

        return null;
    }

    public function createTranslationDomain($name)
    {
        $domain = new TranslationDomain;
        $domain->setName($name);
        $this->persist($domain);
        return $domain;
    }

    public function setTranslationRepository($translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    public function setTranslationDomainRepository($translationDomainRepository)
    {
        $this->translationDomainRepository = $translationDomainRepository;
    }

    public function persist($entity)
    {
        $this->entityManager->persist($entity);
        return $entity;
    }

    public function flush($entity = null)
    {
        if($entity != null) {
            $this->persist($entity);
        }

        $this->entityManager->flush();
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }
}