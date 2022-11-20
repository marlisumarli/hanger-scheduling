<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\Line;
use Subjig\Report\Repository\LineRepository;

class LineService
{
    private LineRepository $lineRepository;

    public function __construct(LineRepository $lineRepository)
    {
        $this->lineRepository = $lineRepository;
    }

    public function requestCreate(SupplyRequest $request): ResponseSubjigApp
    {
        try {
            Database::beginTransaction();

            $line = new Line();
            $line->supply_id = $request->supplyId;
            $line->subjig_id = $request->subjigId;
            $line->jumlah_line_a = $request->jumlahLineA;
            $line->jumlah_line_b = $request->jumlahLineB;
            $line->jumlah_line_c = $request->jumlahLineC;
            $line->target_set = $request->supplyTarget;
            $line->total = $request->jumlahLineA + $request->jumlahLineB + $request->jumlahLineC;
            $this->lineRepository->save($line);

            $response = new ResponseSubjigApp();
            $response->line = $line;

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

            $line = new Line();
            $line->id = $request->lineId;
            $line->jumlah_line_a = $request->jumlahLineA;
            $line->jumlah_line_b = $request->jumlahLineB;
            $line->jumlah_line_c = $request->jumlahLineC;
            $line->target_set = $request->supplyTarget;
            $line->total = $request->jumlahLineA + $request->jumlahLineB + $request->jumlahLineC;
            $this->lineRepository->update($line);

            $response = new ResponseSubjigApp();
            $response->line = $line;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }
}