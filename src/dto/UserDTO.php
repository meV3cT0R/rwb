<?php
class UserDTO {
    private ?int $id = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;
    private ?string $username = null;
    private ?string $role = null;
    private ?string $avatar = null;
    public function __construct(
        int|User|null $user = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $email = null,
        ?string $username = null,
        ?string $role = null,
        ?string $avatar = null
    ) {
        if($user instanceof User) {
            $this->id = $user->getId();
            $this->firstName = $user->getFirstName();
            $this->lastName = $user->getLastName();
            $this->email = $user->getEmail();
            $this->username = $user->getUsername();
            if($user->getRole()!=null)
                $this->role = $user->getRole()->getName();
            $this->avatar = $user->getAvatar();
            return;
        }
        $this->id = $user;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->username = $username;
        $this->role = $role;
        $this->avatar = $avatar;
    }
    
    
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void {
        $this->lastName = $lastName;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $username): void {
        $this->username = $username;
    }

    public function getRole(): ?string {
        return $this->role;
    }

    public function setRole(?string $role): void {
        $this->role = $role;
    }

    public function getAvatar(): ?string {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): void {
        $this->avatar = $avatar;
    }
}
