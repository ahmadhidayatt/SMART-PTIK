<?php

namespace App\Exports;

use App\Models\User;
use DateTime;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class UsersExport implements
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents,
    FromCollection,
    WithCustomStartCell,
    WithTitle
{
    use Exportable;

    private  $rowTanggal = array();
    private  $rowTanggalC = array();
    private $id_kelas;

    public function __construct(int $id_kelas)
    {
        $this->id_kelas = $id_kelas;
    }

    public function collection()
    {

        $rekaps = DB::select(DB::raw(
            "select *,a.jam as time ,DATE_FORMAT(tanggal, '%d-%M-%Y') as tanggall from absensimhs a 
        join absensi b on a.id_absen = b.id_absen 
        join kelas c on b.id_kelas = c.id_kelas 
        join matakuliah e on c.id_mk = e.id_mk
        join users d on a.id_user = d.id 
        where c.id_kelas = $this->id_kelas order by d.nii asc"
        ));



        $rekap = $rekaps;

        $rows = array();


        foreach ($rekaps as $index => $value) {
           
            foreach ($rows as $indexs => $val) {
                if (isset($val['id']) && $val['id'] === $value->id) {
                    continue 2;
                    
                }
                
            }
           

            $row = array();
            $row =  array_merge(array_slice($row, 0, 3), array('id' => $value->id), array_slice($row, 3));
            $row =  array_merge(array_slice($row, 0, 3), array('nii' => $value->nii), array_slice($row, 3));
            $row =  array_merge(array_slice($row, 0, 3), array('nama' => $value->name), array_slice($row, 3));


            for ($i = 0; $i < count($rekap); $i++) {
                // dd($rekap[$i]->id_user);
                if ($value->id_user == $rekap[$i]->id_user) {
                    $ket = '';
                    if ($rekap[$i]->kehadiran == 'masuk') {
                        $ket = '1';
                    } else {
                        $ket = '0';
                    }
                    $row = array_merge(array_slice($row, 0, 3), array($rekap[$i]->tanggall => $ket), array_slice($row, 3));
                }
            }
            array_push($rows, $row);
          

        }
       

        $query = User::query();
        return   collect($rows);
    }

    public function map($user): array
    {

        $tanggal = DB::select(DB::raw(
            "select DATE_FORMAT(tanggal, '%d-%M-%Y') as tanggal from absensi where id_kelas = $this->id_kelas order by STR_TO_DATE(tanggal,'%Y/%m/%d') asc"
        ));
        // dd($this->id_kelas );
        foreach ($tanggal as $index => $value) {
            array_push($this->rowTanggalC, $value->tanggal);
        }

        if (count($this->rowTanggal) <= 15) {
            $a = count($this->rowTanggalC) - 3;
            for ($i = count($this->rowTanggalC); $i <= 15; $i++) {
                $this->rowTanggalC = array_merge(array_slice($this->rowTanggalC, 0, 2), array($a  => ''), array_slice($this->rowTanggalC, 2));
                $a++;
            }
        }


        $column = array();
        array_push(
            $column,
            $user['id'],
            $user['nii'],
            $user['nama'],
        );


        foreach ($this->rowTanggalC as $jindex => $value) {
            if (isset($user[$value])) {
                array_push($column,   $user[$value]);
            } else {
                array_push($column,   'A');
            }
        }
        $this->rowTanggalC = [];
        return [
            $column
        ];
    }

    public function headings(): array
    {
        $tanggal = DB::select(DB::raw(
            "select DATE_FORMAT(tanggal, '%d-%M-%Y') as tanggal from absensi where id_kelas = $this->id_kelas order by STR_TO_DATE(tanggal,'%Y/%m/%d') asc"
        ));

        foreach ($tanggal as $index => $value) {
            array_push($this->rowTanggal, $value->tanggal);
        }

        if (count($this->rowTanggal) <= 15) {
            $a = count($this->rowTanggal) - 3;
            $b = count($this->rowTanggal);
            for ($i = count($this->rowTanggal); $i <= 15; $i++) {
                $this->rowTanggal = array_merge(array_slice($this->rowTanggal, 0, $b), array($a  => ''), array_slice($this->rowTanggal, $b));
                $a++;
                $b++;
            }
        }


        $heading = array();
        array_push($heading, 'No', 'Nim', 'Nama');
        foreach ($this->rowTanggal as $jindex => $value) {
            array_push($heading, $value);
        }

        // dd($heading);

        return [
            $heading
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
            },
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A11:S11')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
                $event->sheet->getStyle('A12:S12')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
                $event->sheet->getStyle('B2')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);

                $rekaps = DB::select(DB::raw(
                    "select *,a.jam as time,(select count(z.id_user) from user_has_kelas z where z.id_kelas=b.id_kelas ) as total from absensimhs a 
        join absensi b on a.id_absen = b.id_absen 
        join kelas c on b.id_kelas = c.id_kelas 
        join matakuliah e on c.id_mk = e.id_mk
        join users d on e.id_dosen = d.id 
        where c.id_kelas = $this->id_kelas order by  b.tanggal asc"
                ));
                $sheet = $event->sheet;
                $sheet->setCellValue('B2', "Format Laporan Kehadiran Mahasiswa");
                $sheet->setCellValue('B3', "Dosen");
                $sheet->setCellValue('B4', "Mata Kuliah");
                $sheet->setCellValue('B5', "Hari");
                $sheet->setCellValue('B6', "Jam");
                $sheet->setCellValue('B7', "Total Mahasiswa");
                $sheet->mergeCells('A11:A12');
                $sheet->setCellValue('A11', "No");
                $sheet->mergeCells('B11:B12');
                $sheet->setCellValue('B11', "NIM");
                $sheet->mergeCells('C11:C12');
                $sheet->setCellValue('C11', "Nama");
                $sheet->setCellValue('D11', "Pertemuan 1");
                $sheet->setCellValue('E11', "Pertemuan 2");
                $sheet->setCellValue('F11', "Pertemuan 3");
                $sheet->setCellValue('G11', "Pertemuan 4");
                $sheet->setCellValue('H11', "Pertemuan 5");
                $sheet->setCellValue('I11', "Pertemuan 6");
                $sheet->setCellValue('J11', "Pertemuan 7");
                $sheet->setCellValue('K11', "Pertemuan 8");
                $sheet->setCellValue('L11', "Pertemuan 9");
                $sheet->setCellValue('M11', "Pertemuan 10");
                $sheet->setCellValue('N11', "Pertemuan 11");
                $sheet->setCellValue('O11', "Pertemuan 12");
                $sheet->setCellValue('P11', "Pertemuan 13");
                $sheet->setCellValue('Q11', "Pertemuan 14");
                $sheet->setCellValue('R11', "Pertemuan 15");
                $sheet->setCellValue('S11', "Pertemuan 16");



                //isi
                $sheet->setCellValue('C3', $rekaps[0]->name);
                $sheet->setCellValue('C4', $rekaps[0]->matkul);
                $sheet->setCellValue('C5', $rekaps[0]->hari);
                $sheet->setCellValue('C6', $rekaps[0]->jam);
                $sheet->setCellValue('C7', (string)$rekaps[0]->total);



                $styleArray = [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $styleArray2 = [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    ],
                ];

                $cellRange = 'A11:S11'; // All headers
                $cellRange1 = 'D13:S53'; 
                $cellRange2 = 'C7'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle($cellRange1)->applyFromArray($styleArray2);
                $event->sheet->getDelegate()->getStyle($cellRange2)->applyFromArray($styleArray2);
            }
        ];
    }



    public function startCell(): string
    {
        return 'A12';
    }

    public function title(): string
    {
        return 'report1';
    }
}
