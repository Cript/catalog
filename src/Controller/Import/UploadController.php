<?php

namespace App\Controller\Import;

use App\Context\ImportXML\Application\Command\ImportXML\ImportXML;
use App\Context\Shared\Application\Bus\Command\CommandBusInterface;
use Flow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class UploadController extends AbstractController
{
    #[Route('/import/upload', name: 'import_upload', methods: ['POST'])]
    public function __invoke(
        Request $request,
        CommandBusInterface $commandBus,
        string $projectDir
    )
    {
        $config = new Flow\Config();
        $config->setTempDir(sprintf('%s/var/import_tmp_folder', $projectDir));
        $file = new Flow\File($config);

        if ($file->validateChunk()) {
            $file->saveChunk();
        } else {
            return new Response(null, 400);
        }

        if ($file->validateFile()) {
            /**
             * @var UploadedFile $uploadedFile
             */
            $uploadedFile = $request->files->get('file');
            $fileName = sprintf('%s/var/import/%s_%s', $projectDir, uniqid(), $uploadedFile->getClientOriginalName());
            $file->save($fileName);

            $command = new ImportXML($fileName);
            $commandBus->dispatch($command);
        }

        return new Response(null, 200);
    }
}
