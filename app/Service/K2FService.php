<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\K2F;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\K2FCreateRequest;
use Subjig\Report\Model\K2FDeleteRequest;
use Subjig\Report\Model\K2FResponse;
use Subjig\Report\Model\K2FUpdateRequest;
use Subjig\Report\Repository\K2FRepository;

class K2FService
{
    private K2FRepository $k2FRepository;

    public function __construct(K2FRepository $k2FRepository)
    {
        $this->k2FRepository = $k2FRepository;
    }

    public function requestCreate(K2FCreateRequest $request): K2FResponse
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
            $k2f->k2f_id = strtoupper(trim($request->id));
            $k2f->k2f_name = ucwords(strtolower(trim($request->name)));
            $k2f->k2f_qty = $request->qty;
            $this->k2FRepository->save($k2f);

            $response = new K2FResponse();
            $response->k2F = $k2f;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnCreateRequest(K2FCreateRequest $request): void
    {
        if ($request->id == null || $request->name == null || $request->qty == null ||
            trim($request->id) == '' || trim($request->name) == '' || trim($request->qty) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^A-Z0-9]/i', $request->id) || preg_match('/[^a-zA-Z| ]/i', $request->name) ||
            preg_match('/[^0-9]/i', $request->qty)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestUpdate(K2FUpdateRequest $request): K2FResponse
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
            $k2f->k2f_name = ucwords(strtolower(trim($request->name)));
            $k2f->k2f_qty = $request->qty;
            $this->k2FRepository->update($k2f);

            $response = new K2FResponse();
            $response->k2F = $k2f;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnUpdateRequest(K2FUpdateRequest $request): void
    {
        if ($request->name == null || $request->qty == null || trim($request->name) == '' || trim($request->qty) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^a-zA-Z| ]/i', $request->name) || preg_match('/[^0-9]/i', $request->qty)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestDelete(K2FDeleteRequest $request): K2FResponse
    {
        $k2f = $this->k2FRepository->findById($request->id);
        if ($k2f == null) {
            throw new ValidationException('Hapus gagal');
        } else {
            $k2f = new  K2F();
            $k2f->id = $request->id;
            $this->k2FRepository->deleteById($k2f->id);
        }
        $response = new K2FResponse();
        $response->k2F = $k2f;
        return $response;
    }
}