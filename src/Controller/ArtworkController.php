<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class ArtworkController extends AbstractController
{
    #[Rest\Post(path: '/artworks', name: 'store_artwork')]
    public function store(
        Request $request
    ): Response {
        if ($request->headers->get('X-AUTH') !== $_ENV['AUTH_SECRET']) {
            throw new AccessDeniedHttpException();
        }

        /**
         * @var string $filename
         * @var UploadedFile $file
         */
        foreach ($request->files->all() as $filename => $file) {
            $file->move(getcwd() . '/uploads', str_replace('_', '.', $filename));
        }

        return $this->empty();
    }
}
