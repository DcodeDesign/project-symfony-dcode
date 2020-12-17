<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content_article;

    /**
     * @ORM\ManyToMany(targetEntity=CategoriesArticles::class, inversedBy="articles")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=SecurityUser::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserID;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContentArticle(): ?string
    {
        return $this->content_article;
    }

    public function setContentArticle(string $content_article): self
    {
        $this->content_article = $content_article;

        return $this;
    }

    /**
     * @return Collection|CategoriesArticles[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(CategoriesArticles $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(CategoriesArticles $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getUserID(): ?SecurityUser
    {
        return $this->UserID;
    }

    public function setUserID(?SecurityUser $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }
}
