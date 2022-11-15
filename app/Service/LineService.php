<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\Line;
use Subjig\Report\Model\SupplyRequest;
use Subjig\Report\Model\SupplyResponse;
use Subjig\Report\Repository\LineRepository;

class LineService
{
    private LineRepository $lineRepository;

    public function __construct(LineRepository $lineRepository)
    {
        $this->lineRepository = $lineRepository;
    }

    public function requestCreate(SupplyRequest $request): SupplyResponse
    {
        try {
            Database::beginTransaction();

            $line = new Line();
            $line->supply_id = $request->supplyId;
            $line->subjig_id = $request->subjigId;
            $line->jumlah_line_a = $request->jumlahLineA;
            $line->jumlah_line_b = $request->jumlahLineB;
            $line->jumlah_line_c = $request->jumlahLineC;
            $line->total = $request->jumlahLineA + $request->jumlahLineB + $request->jumlahLineC;
            $this->lineRepository->save($line);

            $response = new SupplyResponse();
            $response->line = $line;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestUpdate(SupplyRequest $request): SupplyResponse
    {
        try {
            Database::beginTransaction();

            $line = new Line();
            $line->id = $request->id;
            $line->jumlah_line_a = $request->jumlahLineA;
            $line->jumlah_line_b = $request->jumlahLineB;
            $line->jumlah_line_c = $request->jumlahLineC;
            $line->total = $request->jumlahLineA + $request->jumlahLineB + $request->jumlahLineC;
            $this->lineRepository->update($line);

            $response = new SupplyResponse();
            $response->line = $line;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }
}