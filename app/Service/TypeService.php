<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\TypeRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\Type;
use Subjig\Report\Repository\SubjigRepository;
use Subjig\Report\Repository\TypeRepository;

class TypeService
{
    private TypeRepository $typeRepository;

    /**
     * @param TypeRepository $typeRepository
     */
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function requestCreate(TypeRequest $request): ResponseSubjigApp
    {
        $this->validateColumnCreateRequest($request);
        try {
            Database::beginTransaction();

            $id = $this->typeRepository->findById(strtoupper($request->id));
            if ($id != null) {
                throw new ValidationException("Id : " . strtoupper($request->id) . " sudah ada");
            }

            $type = new Type();
            $type->setTypeId(strtoupper(trim($request->id)));
            $type->setTypeQty($request->qty);
            $this->typeRepository->save($type);

            $response = new ResponseSubjigApp();
            $response->type = $type;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnCreateRequest(TypeRequest $typeRequest): void
    {
        if (trim($typeRequest->id) == '' || ($typeRequest->id && $typeRequest->qty) == null) {
            throw new ValidationException('Harus Diisi!');
        } elseif (preg_match('/[^a-zA-Z0-9]/i', $typeRequest->id)) {
            throw new ValidationException('Tidak valid!');
        }
    }

    public function requestUpdate(TypeRequest $request): ResponseSubjigApp
    {
        $response = new ResponseSubjigApp();
        if (isset($request->newId)) {
            $this->validateColumnUpdateRequest($request);
            try {
                Database::beginTransaction();

                $id = $this->typeRepository->findById(strtoupper($request->newId));
                if ($id != null) {
                    throw new ValidationException("Id : " . strtoupper($request->newId) . " sudah ada");
                }

                $type = new Type();
                $type->setNewTypeId(strtoupper(trim($request->newId)));
                $type->setTypeId($request->id);
                $this->typeRepository->update($type);

                $response->type = $type;
                Database::commitTransaction();

            } catch (Exception $exception) {
                Database::rollBackTransaction();
                throw $exception;
            }
        } elseif (isset($request->qty)) {
            try {
                Database::beginTransaction();

                $subjigs = new SubjigRepository(Database::getConnection());
                $allSubjig = count($subjigs->data($request->id));

                if ($request->qty < $allSubjig) {
                    throw new ValidationException("Type Quantity tidak dapat diubah: Kurang dari jumlah Subjig saat ini");
                }

                $type = new Type();
                $type->setTypeId($request->id);
                $type->setTypeQty($request->qty);
                $this->typeRepository->update($type);

                $response->type = $type;
                Database::commitTransaction();

            } catch (Exception $exception) {
                Database::rollBackTransaction();
                throw $exception;
            }
        }
        return $response;
    }

    private function validateColumnUpdateRequest(TypeRequest $typeRequest): void
    {
        if (trim($typeRequest->newId) == '' || $typeRequest->newId == null) {
            throw new ValidationException('Harus Diisi!');
        } elseif (preg_match('/[^a-zA-Z0-9]/i', $typeRequest->newId)) {
            throw new ValidationException('Tidak valid!');
        }
    }
}