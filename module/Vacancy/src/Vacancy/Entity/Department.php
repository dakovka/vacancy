<?php
namespace Vacancy\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Department.
 *
 * @ORM\Entity
 * @ORM\Table(name="department")
 */
class Department
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     **/
    protected $id;
    /**
     * @ORM\Column(type="string")
     **/
    protected $name;
    /**
     * @ORM\OneToMany(targetEntity="Vacancy", mappedBy="department")
     * @var Vacancy[]
     **/
    protected $vacancies;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->vacancies = new ArrayCollection();
    }

    /**
     * Returns the id.
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the name.
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Adds vacancy.
     * @param Vacancy $vacancy
     * @return $this
     */
    public function addVacancy(Vacancy $vacancy)
    {
        $this->vacancies[] = $vacancy;

        return $this;
    }

    /**
     * Returns vacancies.
     * @return Vacancy[]
     */
    public function getVacancies()
    {
        return $this->vacancies;
    }
}
 