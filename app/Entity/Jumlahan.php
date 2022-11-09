<?php

namespace Subjig\Report\Entity;

class Jumlahan
{
    private string $nama;
    private string $nim;
    private int $presensi;
    private int $tugas;
    private int $uts;
    private int $uas;

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @param string $nama
     */
    public function setNama(string $nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return string
     */
    public function getNim(): string
    {
        return $this->nim;
    }

    /**
     * @param string $nim
     */
    public function setNim(string $nim): void
    {
        $this->nim = $nim;
    }

    /**
     * @return int
     */
    public function getPresensi(): int
    {
        return $this->presensi;
    }

    /**
     * @param int $presensi
     */
    public function setPresensi(int $presensi): void
    {
        $this->presensi = $presensi;
    }

    /**
     * @return int
     */
    public function getTugas(): int
    {
        return $this->tugas;
    }

    /**
     * @param int $tugas
     */
    public function setTugas(int $tugas): void
    {
        $this->tugas = $tugas;
    }

    /**
     * @return int
     */
    public function getUts(): int
    {
        return $this->uts;
    }

    /**
     * @param int $uts
     */
    public function setUts(int $uts): void
    {
        $this->uts = $uts;
    }

    /**
     * @return int
     */
    public function getUas(): int
    {
        return $this->uas;
    }

    /**
     * @param int $uas
     */
    public function setUas(int $uas): void
    {
        $this->uas = $uas;
    }

}