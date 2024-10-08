<?php
class User {
    private ?int $id = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;
    private ?string $username = null;
    private ?string $password = null;
    private ?Role $role = null;
    private ?string $avatar = null;
    public function __construct(
        ?int $id = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $email = null,
        ?string $username = null,
        ?string $password = null,
        ?Role $role = null,
        ?string $avatar = null
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
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

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function getRole(): ?Role {
        return $this->role;
    }

    public function setRole(?Role $role): void {
        $this->role = $role;
    }

    public function getAvatar(): ?string {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): void {
        $this->avatar = $avatar;
    }

    public function __tostring() :string{
            return "[". ($this->getRole()->getId()??"") ."]". $this->getFirstName();
    }
}
