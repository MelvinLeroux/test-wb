<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserService
{
    private $entityManager;
    private $hasher;

    public function __construct(SluggerInterface $slugger, EntityManagerInterface $entityManager, ParameterBagInterface $params, UserPasswordHasherInterface $hasher)
    {
        $this->entityManager = $entityManager;
        $this->hasher = $hasher;
    }

    public function createUser($data, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $existingUser = $userRepository->findOneBy(['email' => $data['email']]);
        if ($existingUser) {
            throw new \Error('Cette adresse e-mail est déjà utilisée.');
        }
        $requiredFields = ['pseudo', 'email', 'password', 'firstname', 'lastname', 'birthdate', 'city', 'age'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new \Error('Tous les champs doivent être remplis');
            }
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Error('L\'adresse e-mail n\'est pas au bon format');
        }
        if (!$this->isPasswordValid($data['password'])) {
            throw new \Error('Le mot de passe doit contenir au moins une majuscule, une lettre minuscule, un chiffre et un caractère spécial');
        }
        if (null === $data['age']) {
            throw new \Error('Sur le sang de tes morts tu dois dire t\as plus de 18 ans');
        }

        $user = new User();
        $user->setPseudo($data['pseudo']);
        $password = $data['password'];
        $hashedPassword = $this->hasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
        $user->setEmail($data['email']);
        $user->setCreatedAt(new \DateTimeImmutable());
        // Gestion du fichier thumbnail

        // Créer une instance UploadedFile pour le fichier thumbnail

        return $user;
    }

    public function update(User $user, $data, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher)
    {
        if (isset($data['pseudo']) && !empty($data['pseudo'])) {
            $user->setPseudo($data['pseudo']);

            if (isset($data['email'])) {
                $user->setEmail($data['email']);
            }

            if (isset($data['roles'])) {
                $user->setRoles($data['roles']);
            }
        }

        // Gestion des mots de passe

        // on définit les champs qui contiennent des mots de passe
        $passwordsFields = [
            'oldPassword',
            'newPassword',
            'confirmNewPassword',
        ];

        // on extrait les champs de mot de passe reçus
        $passwords = [];
        foreach ($passwordsFields as $field) {
            if (key_exists($field, $data) && $data[$field]) {
                $passwords[$field] = $data[$field];
            }
        }

        // on compte le nombre de mots de passe reçus
        $passwordsCount = count($passwords);

        // si on a reçu au moins un mot de passe...
        if ($passwordsCount > 0) {
            // ...et si on n'a pas reçu tous les mots de passe
            if ($passwordsCount < count($passwordsFields)) {
                // alors on retourne une réponse d'erreur
                return new JsonResponse(['error' => 'Veuillez remplir tous les champs de mot de passe.'], JsonResponse::HTTP_BAD_REQUEST);
            }

            if (!$hasher->isPasswordValid($user, $passwords['oldPassword'])) {
                return new JsonResponse(['error' => 'L\'ancien mot de passe est incorrect.'], JsonResponse::HTTP_BAD_REQUEST);
            }
            if ($passwords['oldPassword'] === $passwords['newPassword']) {
                return new JsonResponse(['error' => 'Votre nouveau mot de passe doit être différent de l\'ancien.'], JsonResponse::HTTP_BAD_REQUEST);
            }
            if ($passwords['newPassword'] !== $passwords['confirmNewPassword']) {
                return new JsonResponse(['error' => 'Les mots de passe ne correspondent pas.'], JsonResponse::HTTP_BAD_REQUEST);
            }
            if ($passwords['newPassword'] === $passwords['confirmNewPassword']) {
                if (!$this->isPasswordValid($passwords['newPassword'])) {
                    return new JsonResponse(['error' => 'Le mot de passe doit contenir au moins une majuscule, une lettre minuscule, un chiffre et un caractère spécial'], 400);
                }
                $hashedPassword = $this->hasher->hashPassword($user, $passwords['newPassword']);
                $user->setPassword($hashedPassword);
            }
        }

        return $user;
    }

    private function isPasswordValid($password)
    {
        // Vérifie si le mot de passe contient au moins une majuscule, une lettre minuscule, un chiffre et un caractère spécial
        return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&_\-\.])[A-Za-z\d@$!%*?&_\-\.]{8,}$/', $password);
    }
}
