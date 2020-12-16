<?php

namespace App\Entity;


use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(): ?string
    {
        return $this->password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    public function setBirthdate(string $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    private function age($date)
    {
        $date = $this->birthdate;
        $today = date("d-m-Y");
        $diff = date_diff(date_create($date), date_create($today));
        return $diff->format('%y');
    }
    private function isValidBirthdate($date): Boolean
    {
        if (age($date) < 13)
        {
            return false;
        } else {
            return true;
        }
    }

    public function isValid(Array champs): String
    {
       if (!$this->isValidName()){
           return "Nom pas bon";
       } else {
            if (!$this->isValidSurname()){
                return "Insérez prénom";
            } else {
                if (!$this->isValidEmail()){
                    return "Mauvais format de mail";
                } else {
                    if (!$this->isValidPassword()){
                        return "Mot de passe trop court ou trop long";
                    } else {
                        if (!$this->isValidBirthdate()){
                            return "Vous êtes trop jeune";
                        } else {
                            return "Votre profil est conforme !";
                        }
                    }
                }
            }
       }
    }

    private function isValidName($inputName): Boolean
    {
        $inputName = $this->name;
        if ($inputName != null && $inputName != "") {
            return true;
        } else {
            return false;
        }
    }

    private function isValidSurname($inputSurname): Boolean
    {
        $inputSurname = $this->surname;
        if ($inputSurname != null && $inputSurname != "") {
            return true;
        } else {
            return false;
        }
    }

    private function isValidEmail($inputEmail): Boolean
    {
        $inputEmail = $this->email;
        if (filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    private function isValidPassword($password): Boolean
    {
        $password = $this->password;
        if (strlen($password) < 8 || strlen($password) > 40){
            return false;
        } else {
            return true;
        }
    }
}
