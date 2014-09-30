<?php
namespace Vacancy\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Vacancy.
 *
 * @ORM\Entity(repositoryClass="VacancyRepository")
 * @ORM\Table(name="vacancy")
 * @Gedmo\TranslationEntity(class="Vacancy\Entity\VacancyTranslation")
 */
class Vacancy implements Translatable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     **/
    protected $id;
    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     * @var string
     **/
    protected $name;
    /**
     * @ORM\Column(type="string")
     * @Gedmo\Translatable
     * @var string
     **/
    protected $description;
    /**
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="vacancies")
     * @var Department
     **/
    protected $department;
    /**
     * @ORM\OneToMany(targetEntity="VacancyTranslation", mappedBy="object", cascade={"persist", "remove"})
     * @var VacancyTranslation[]
     **/
    protected $translations;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

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

    /**
     * Adds translation.
     * @param VacancyTranslation $translation
     * @return $this
     */
    public function addTranslation(VacancyTranslation $translation)
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setObject($this);
        }

        return $this;
    }

    /**
     * Returns translations.
     * @return VacancyTranslation[]
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}
 