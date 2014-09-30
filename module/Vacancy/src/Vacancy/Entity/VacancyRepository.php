<?php
namespace Vacancy\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Gedmo\Translatable\TranslatableListener;

/**
 * Vacancy repository.
 */
class VacancyRepository extends EntityRepository
{
    public function getByDepartmentInLocale($departmentId = null, $locale = 'en_us')
    {
        $dql = 'SELECT v FROM Vacancy\Entity\Vacancy v ' .
            'WHERE v.department = ?1';

        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $departmentId);

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\Translatable\Query\TreeWalker\TranslationWalker'
        );

        $query->setHint(TranslatableListener::HINT_TRANSLATABLE_LOCALE, $locale);
        $query->setHint(TranslatableListener::HINT_FALLBACK, 1);


        return $query->getResult();
    }
}
 