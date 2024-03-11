<?php

namespace App\Exports;

use App\Models\User;
use App\Utils\Constants;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientsDoctorMedicamentExport implements FromCollection, WithHeadings
{

    private $user_id;

    public function __construct(int $user_id )
    {
        $this->user_id = $user_id;
    }

    public function collection()
    {
        $role = DB::table('roles')
            ->where('name', '=', Constants::ROLE_PATIENT)
            ->first();

        $query = DB::table('users')
            ->join('model_has_roles', function ($join) use ($role) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                    ->where('model_has_roles.role_id', '=', $role->id);
            })
            ->join('genders', 'genders.id', '=', 'users.gender_id')
            ->join('districts', function ($join) {
                $join->on('districts.ubigeo', '=', 'users.ubigeo');
            })
            ->join('provinces', 'provinces.id', '=', 'districts.province_id')
            ->join('departments', 'departments.id', '=', 'provinces.department_id')
            ->join('user_doctor', 'user_doctor.user_id', '=', 'users.id')
            ->join('users as doctor', 'doctor.id', '=', 'user_doctor.doctor_id')
            ->join('reminders', 'reminders.user_id', '=', 'users.id')
            ->join('medications', 'medications.id', '=', 'reminders.medication_id')
            ->join('medication_types', 'medication_types.id', '=', 'medications.medication_type_id')
            ->where('users.id', '=', $this->user_id)
            ->select('users.id', 'users.name', 'users.last_name', 'users.email', 'genders.name as genero', 'users.document', 'users.phone', 'users.is_active', 'users.created_at',
                'departments.name as department', 'provinces.name as province', 'districts.name as district',
                'doctor.id as doctor_id', 'doctor.name as doctor_name', 'doctor.last_name as doctor_last_name', 'doctor.email as doctor_email', 'doctor.cmp as doctor_cmp',
                'reminders.id as reminder_id', 'reminders.start_date as reminder_start_date', 'reminders.end_date as reminder_end_date', 'reminders.duration as reminder_duration', 'reminders.frequency as reminder_frequency',
                'medications.name as medicament', 'medications.created_by', 'medications.is_active as medicament_is_active',
                'medication_types.name as medication_type', 'medication_types.is_active as medication_type_is_active'
            )
            ->get();
        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombres',
            'Apellidos',
            'Correo',
            'Genero',
            'Documento',
            'Telefono',
            'Activo',
            'Fecha registro',
            'Departamento',
            'Provincia',
            'Distrito',
            'ID Doctor',
            'Nombres Doctor',
            'Apellidos Doctor',
            'Correo Doctor',
            'CMP Doctor',
            'ID Recordatorio',
            'Fecha Inicio Recordatorio',
            'Fecha Fin Recordatorio',
            'Duracion Recordatorio',
            'Frecuencia Recordatorio',
            'Medicamento',
            'Creado Por',
            'Medicamento Activo',
            'Tipo Medicamento Nombre',
            'Tipo Medicamento Activo '
        ];
    }

}
