<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\SupplyLine;
use Subjig\Report\Repository\SupplyLineRepository;

class SupplyLineService
{
    private SupplyLineRepository $lineRepository;

    public function __construct(SupplyLineRepository $lineRepository)
    {
        $this->lineRepository = $lineRepository;
    }

    public function requestCreate(SupplyRequest $request): ResponseSubjigApp
    {
        try {
            Database::beginTransaction();

            $line = new SupplyLine();
            $line->setSupplyId($request->supplyId);
            $line->setHangerId($request->hangerId);
            $line->setLineA($request->lineA);
            $line->setLineB($request->lineB);
            $line->setLineC($request->lineC);
            $line->setTotal($line->getLineA() + $line->getLineB() + $line->getLineC());
            $this->lineRepository->save($line);

            $response = new ResponseSubjigApp();
            $response->supplyLine = $line;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestUpdate(SupplyRequest $request): ResponseSubjigApp
    {
        try {
            Database::beginTransaction();

            $line = new SupplyLine();
            $line->setId($request->supplyLineId);
            $line->setLineA($request->lineA);
            $line->setLineB($request->lineB);
            $line->setLineC($request->lineC);
            $line->setTotal($request->lineA + $request->lineB + $request->lineC);
            $this->lineRepository->update($line);

            $response = new ResponseSubjigApp();
            $response->supplyLine = $line;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }
}