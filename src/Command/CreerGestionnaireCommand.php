<?php

namespace App\Command;

use App\Entity\Gestionnaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Crée un compte gestionnaire (il n'y a pas de page d'inscription).
 * Exemple : php bin/console app:creer-gestionnaire secretariat.prepa MonMotDePasse
 */
#[AsCommand(name: 'app:creer-gestionnaire', description: 'Crée un compte gestionnaire des oraux')]
class CreerGestionnaireCommand
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher,
    ) {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Identifiant de connexion')] string $identifiant,
        #[Argument('Mot de passe')] string $motDePasse,
    ): int {
        if ($this->em->getRepository(Gestionnaire::class)->findOneBy(['identifiant' => $identifiant])) {
            $io->error(sprintf('Le gestionnaire « %s » existe déjà.', $identifiant));

            return Command::FAILURE;
        }

        $gestionnaire = (new Gestionnaire())->setIdentifiant($identifiant);
        $gestionnaire->setPassword($this->hasher->hashPassword($gestionnaire, $motDePasse));

        $this->em->persist($gestionnaire);
        $this->em->flush();

        $io->success(sprintf('Gestionnaire « %s » créé.', $identifiant));

        return Command::SUCCESS;
    }
}
