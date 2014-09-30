<?php
namespace Vacancy\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vacancy.
 *
 * @ORM\Entity(repositoryClass="VacancyRepository")
 * @ORM\Table(name="vacancy")
 */
class Vacancy
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     **/
    protected $id;
    /**
     * @ORM\Column(type="string")
     * @var string
     **/
    protected $name;
    /**
     * @ORM\Column(type="string")
     * @var string
     **/
    protected $description;
    /**
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="vacancies")
     * @var Department
     **/
    protected $department;

    /**
     * Returns id.
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets department.
     * @param Department $department
     * @return $this
     */
    public function setDepartment(Department $department)
    {
        $this->department = $department;
        $department->addVacancy($this);

        return $this;
    }

    /**
     * Returns department.
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Sets name.
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets name.
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns description.
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
 