<?php
namespace Vacancy\Controller;

use Doctrine\ORM\EntityManager;
use Vacancy\Entity\VacancyRepository;
use Vacancy\Form\FilterForm;
use Zend\Http\Request;
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
        $form = new FilterForm($this->getEntityManager());
        /**
         * @var Request $request
         */
        $request = $this->getRequest();
        $departmentId = $request->getQuery('Department');
        $locale = $request->getQuery('Locale');

        if ($departmentId) {
            $form->get('Department')->setValue($departmentId);
        }
        if ($locale) {
            $form->get('Locale')->setValue($locale);
        }

        /**
         * @var VacancyRepository $vacancyRepository
         */
        $vacancyRepository = $this->getEntityManager()->getRepository('Vacancy\Entity\Vacancy');

        return new ViewModel(array(
            'form' => $form,
            'vacancies' => $vacancyRepository->getByDepartmentInLocale(
                    $departmentId,
                    $locale
                ),
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
 