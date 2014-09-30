<?php
namespace Vacancy\Controller;

use Doctrine\ORM\EntityManager;
use Vacancy\Entity\VacancyRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Vacancies filter.
 */
class VacancyController extends AbstractActionController
{
    /**
     * @var EntityManager $entityManager
     */
    protected $entityManager;

    /**
     * {@inheritdoc}
     */
    public function indexAction()
    {
        /**
         * @var VacancyRepository $vacancyRepository
         */
        $vacancyRepository = $this->getEntityManager()->getRepository('Vacancy\Entity\Vacancy');

        return new ViewModel(array(
            'vacancies' => $vacancyRepository->findAll()
        ));
    }

    /**
     * Returns Doctrine entity manager.
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        if (is_null($this->entityManager)) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }

        return $this->entityManager;
    }
}
 