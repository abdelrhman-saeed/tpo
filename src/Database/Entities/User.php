<?php

namespace AbdelrhmanSaeed\Tpo\Database\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string')]
    private string $phone;

    #[ORM\Column(type: 'integer')]
    private int $creditLimit = 0;

    public static function create(array $fields): self
    {
        $user = new self();
        foreach ($fields as $name => $value) {
            if (method_exists($user, 'set' . ucfirst($name))) {
                $user->{'set' . ucfirst($name)}($value);
            } else {
                throw new \Exception("User Entity has no such field: $name!", 1);
            }
        }

        return $user;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCreditLimit(): int
    {
        return $this->creditLimit;
    }

    // Setters
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function setCreditLimit(int $creditLimit): void
    {
        $this->creditLimit = $creditLimit;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'creditLimit' => $this->creditLimit,
        ];
    }
}
