<?php

namespace App\Entity;


//use JsonSerializable;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
#[ORM\Table(name: 'phones')]
#[PrivateProperties(['id'])]
class Phone// implements JsonSerializable
{
//    use JsonSerializableTrait;
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'phones')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private User $user;

    #[ORM\Column(length: 45, nullable: true)]
    private string $phone;

    /**
     * @param User $user
     * @param string $phone
     */
    public function __construct(User $user, string $phone)
    {
        $this->user = $user;
        $this->phone = $phone;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

}
