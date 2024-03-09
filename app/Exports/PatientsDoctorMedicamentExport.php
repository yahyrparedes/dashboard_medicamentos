<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientsDoctorMedicamentExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'id', 'Nombre del cupon', 'Valor estimado del cupon', 'Delivery Gratis',
            'Id Cliente', 'Cliente', 'Correo', 'Genero', 'Tipo de documento', 'N° Documento', 'N° Celular',
            'Id Orden', 'Metodo de Pago', 'Total Pagado', 'Total descuento', 'Total Productos', 'Total Delivery',
            'Transportista', 'Estado de la Orden'
        ];
    }
}
