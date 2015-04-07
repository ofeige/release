<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Releases
 *
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="releases")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ReleasesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Releases
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vertical;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $environment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $branch;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $revision;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $cluster;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set vertical
     *
     * @param string $vertical
     * @return Releases
     */
    public function setVertical($vertical)
    {
        $this->vertical = $vertical;

        return $this;
    }

    /**
     * Get vertical
     *
     * @return string 
     */
    public function getVertical()
    {
        return $this->vertical;
    }

    /**
     * Set environment
     *
     * @param string $environment
     * @return Releases
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * Get environment
     *
     * @return string 
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return Releases
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Releases
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Releases
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set branch
     *
     * @param string $branch
     * @return Releases
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get branch
     *
     * @return string 
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * Set revision
     *
     * @param string $revision
     * @return Releases
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get revision
     *
     * @return string 
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * Set cluster
     *
     * @param string $cluster
     * @return Releases
     */
    public function setCluster($cluster)
    {
        $this->cluster = $cluster;

        return $this;
    }

    /**
     * Get cluster
     *
     * @return string 
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Releases
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }
}
