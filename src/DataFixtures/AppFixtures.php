<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getMovies() as $movie) {
            $manager->persist($movie);
        }

        $manager->flush();
    }

    public function getMovies(): iterable
    {
        foreach ($this->getMoviesData() as $datum) {
            $date = $datum['Released'] === 'N/A' ? $datum['Year'] : $datum['Released'];

            yield (new Movie())
                ->setTitle($datum['Title'])
                ->setPlot($datum['Plot'])
                ->setCountry($datum['Country'])
                ->setReleasedAt(new \DateTimeImmutable($date))
                ->setDirector($datum['Director'])
                ->setRated($datum['Rated'])
                ->setImdbId($datum['imdbID'])
                ->setGenre($datum['Genre'])
                ->setPoster($datum['Poster'])
            ;
        }
    }

    public function getMoviesData(): iterable
    {
        $files = (new Finder())
            ->in(__DIR__)
            ->files()
            ->name('movie_fixtures.json');

        foreach ($files as $file) {
            $content = $file->getContents();

            foreach (json_decode($content, true) as $item) {
                yield $item;
            }
        }
    }
}
