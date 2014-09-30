<?php
namespace Vacancy\Form;

use Doctrine\ORM\EntityManager;
use Vacancy\Entity\Department;
use Zend\Form\Form;

/**
 * Vacancies filter form.
 */
class FilterForm extends Form
{
    /**
     * @var EntityManager $entityManager
     */
    protected $entityManager;

    /**
     * Constructor.
     * @param EntityManager $entityManager
     * @param string|null $name
     */
    public function __construct(EntityManager $entityManager, $name = null)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;

        $this->setAttribute('method', 'get');

        $this->add(array(
                'name' => 'Department',
                'type' => 'Select',
                'options' => array(
                    'label' => 'Department',
                    'value_options' => $this->getDepartmentOptions()
                ),
            ));
        $this->add(array(
                'name' => 'Locale',
                'type' => 'Select',
                'options' => array(
                    'label' => 'Locale',
                    'value_options' => $this->getLocalesOptions()
                ),
            ));
        $this->add(array(
                'name' => 'submit',
                'type' => 'Submit',
                'attributes' => array(
                    'value' => 'Filter',
                    'id' => 'submitbutton',
                ),
            ));
    }

    /**
     * Returns value options for department select.
     * @return array
     */
    protected function getDepartmentOptions()
    {
        $repository = $this->entityManager->getRepository('Vacancy\Entity\Department');
        $result = array();
        /**
         * @var Department $department
         */
        foreach ($repository->findAll() as $department) {
            $result[$department->getId()] = $department->getName();
        }

        return $result;
    }

    /**
     * Returns value options for locale select.
     * @return array
     */
    protected function getLocalesOptions()
    {
        $dql = 'SELECT DISTINCT t.locale FROM Vacancy\Entity\VacancyTranslation t';
        $queryResult = $this->entityManager->createQuery($dql)->getScalarResult();

        $result = array('en_us' => 'en_us');
        foreach ($queryResult as $translation) {
            $result[$translation['locale']] = $translation['locale'];
        }

        return $result;
    }

}
 