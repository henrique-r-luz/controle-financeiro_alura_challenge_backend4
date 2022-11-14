<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DespesasRepository;

#[ORM\Entity(repositoryClass: DespesasRepository::class)]
class Despesas implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descricao = null;

    #[ORM\Column(type: "decimal", precision: 15, scale: 2)]
    #[Assert\PositiveOrZero]
    private ?float $valor = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data = null;

    #[ORM\ManyToOne(inversedBy: 'despesas')]
    private ?Categoria $categoria = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getMes()
    {
        return $this->data->format('m');
    }

    public function getDataFormat()
    {
        //return date_format($thisdate, 'Y-m-d H:i:s');
        return $this->data->format('Y-m-d');
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'descricao' => $this->getDescricao(),
            'valor' => $this->getValor(),
            'data' => $this->getDataFormat(),
            'categoria' =>  isset($this->categoria) ? $this->categoria->getNome() : ''
        ];
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
}
