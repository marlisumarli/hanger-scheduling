<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\K2F;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\K2FRequest;
use Subjig\Report\Model\SubjigResponse;
use Subjig\Report\Repository\K2FRepository;

class K2FService
{
    private K2FRepository $k2FRepository;

    public function __construct(K2FRepository $k2FRepository)
    {
        $this->k2FRepository = $k2FRepository;
    }

    public function requestCreate(K2FRequest $request): SubjigResponse
    {
        $this->validateColumnCreateRequest($request);
        try {
            Database::beginTransaction();

            $k2fId = $this->k2FRepository->findById($request->id);
            $k2fName = $this->k2FRepository->findByName($request->name);
            if ($k2fId != null) {
                throw new ValidationException("Id : $request->id sudah ada");
            } elseif ($k2fName != null) {
                throw new ValidationException("Nama : $request->name sudah ada");
            }

            $k2f = new K2F();
            $k2f->id = count($this->k2FRepository->findAll()) + 1;
            $k2f->k2f_id = strtoupper(trim($request->id));
            $k2f->k2f_name = ucwords(trim($request->name));
            $k2f->k2f_qty = $request->qty;
            $this->k2FRepository->save($k2f);

            $response = new SubjigResponse();
            $response->k2F = $k2f;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnCreateRequest(K2FRequest $request): void
    {
        if ($request->id == null || $request->name == null || $request->qty == null ||
            trim($request->id) == '' || trim($request->name) == '' || trim($request->qty) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^A-Z0-9]/i', $request->id) || preg_match('/[^a-zA-Z| ]/i', $request->name) ||
            preg_match('/[^0-9]/i', $request->qty)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestUpdate(K2FRequest $request): SubjigResponse
    {
        $this->validateColumnUpdateRequest($request);
        try {
            Database::beginTransaction();

            $k2fId = $this->k2FRepository->findById($request->id);
            if ($k2fId == null) {
                throw new ValidationException("is null");
            }

            $k2f = new K2F();
            $k2f->k2f_id = strtoupper(trim($request->id));
            $k2f->k2f_name = ucwords(trim($request->name));
            $k2f->k2f_qty = $request->qty;
            $this->k2FRepository->update($k2f);

            $response = new SubjigResponse();
            $response->k2F = $k2f;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnUpdateRequest(K2FRequest $request): void
    {
        if ($request->name == null || $request->qty == null || trim($request->name) == '' || trim($request->qty) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^a-zA-Z| ]/i', $request->name) || preg_match('/[^0-9]/i', $request->qty)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestUpdateOrder(K2FRequest $request): SubjigResponse
    {
        try {
            Database::beginTransaction();

            $k2f = new K2F();
            $k2f->k2f_id = $request->id;
            $k2f->id = $request->ordered;
            $this->k2FRepository->updateOrder($k2f);

            $response = new SubjigResponse();
            $response->k2F = $k2f;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestDelete(K2FRequest $request): SubjigResponse
    {
        try {
            Database::beginTransaction();

            $k2f = new  K2F();
            $k2f->k2f_id = $request->id;
            $this->k2FRepository->deleteById($k2f->k2f_id);

            foreach ($this->k2FRepository->findAll() as $key => $value) {
                $k2f = new K2F();
                $k2f->k2f_id = $value->getK2fId();
                $k2f->id = $key + 1;
                $k2f->k2f_name = $value->getK2fName();
                $k2f->k2f_qty = $value->getK2fQty();
                $this->k2FRepository->update($k2f);
            }

            $response = new SubjigResponse();
            $response->k2F = $k2f;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }
}