<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('provinces')->insert(['department_id' => 1, 'ubigeo' => '0101', 'name' => 'Chachapoyas']);
        DB::table('provinces')->insert(['department_id' => 1, 'ubigeo' => '0102', 'name' => 'Bagua']);
        DB::table('provinces')->insert(['department_id' => 1, 'ubigeo' => '0103', 'name' => 'Bongará']);
        DB::table('provinces')->insert(['department_id' => 1, 'ubigeo' => '0104', 'name' => 'Condorcanqui']);
        DB::table('provinces')->insert(['department_id' => 1, 'ubigeo' => '0105', 'name' => 'Luya']);
        DB::table('provinces')->insert(['department_id' => 1, 'ubigeo' => '0106', 'name' => 'Rodríguez de Mendoza']);
        DB::table('provinces')->insert(['department_id' => 1, 'ubigeo' => '0107', 'name' => 'Utcubamba']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0201', 'name' => 'Huaraz']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0202', 'name' => 'Aija']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0203', 'name' => 'Antonio Raymondi']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0204', 'name' => 'Asunción']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0205', 'name' => 'Bolognesi']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0206', 'name' => 'Carhuaz']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0207', 'name' => 'Carlos Fermín Fitzcarrald']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0208', 'name' => 'Casma']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0209', 'name' => 'Corongo']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0210', 'name' => 'Huari']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0211', 'name' => 'Huarmey']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0212', 'name' => 'Huaylas']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0213', 'name' => 'Mariscal Luzuriaga']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0214', 'name' => 'Ocros']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0215', 'name' => 'Pallasca']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0216', 'name' => 'Pomabamba']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0217', 'name' => 'Recuay']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0218', 'name' => 'Santa']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0219', 'name' => 'Sihuas']);
        DB::table('provinces')->insert(['department_id' => 2, 'ubigeo' => '0220', 'name' => 'Yungay']);
        DB::table('provinces')->insert(['department_id' => 3, 'ubigeo' => '0301', 'name' => 'Abancay']);
        DB::table('provinces')->insert(['department_id' => 3, 'ubigeo' => '0302', 'name' => 'Andahuaylas']);
        DB::table('provinces')->insert(['department_id' => 3, 'ubigeo' => '0303', 'name' => 'Antabamba']);
        DB::table('provinces')->insert(['department_id' => 3, 'ubigeo' => '0304', 'name' => 'Aymaraes']);
        DB::table('provinces')->insert(['department_id' => 3, 'ubigeo' => '0305', 'name' => 'Cotabambas']);
        DB::table('provinces')->insert(['department_id' => 3, 'ubigeo' => '0306', 'name' => 'Chincheros']);
        DB::table('provinces')->insert(['department_id' => 3, 'ubigeo' => '0307', 'name' => 'Grau']);
        DB::table('provinces')->insert(['department_id' => 4, 'ubigeo' => '0401', 'name' => 'Arequipa']);
        DB::table('provinces')->insert(['department_id' => 4, 'ubigeo' => '0402', 'name' => 'Camaná']);
        DB::table('provinces')->insert(['department_id' => 4, 'ubigeo' => '0403', 'name' => 'Caravelí']);
        DB::table('provinces')->insert(['department_id' => 4, 'ubigeo' => '0404', 'name' => 'Castilla']);
        DB::table('provinces')->insert(['department_id' => 4, 'ubigeo' => '0405', 'name' => 'Caylloma']);
        DB::table('provinces')->insert(['department_id' => 4, 'ubigeo' => '0406', 'name' => 'Condesuyos']);
        DB::table('provinces')->insert(['department_id' => 4, 'ubigeo' => '0407', 'name' => 'Islay']);
        DB::table('provinces')->insert(['department_id' => 4, 'ubigeo' => '0408', 'name' => 'La Uniòn']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0501', 'name' => 'Huamanga']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0502', 'name' => 'Cangallo']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0503', 'name' => 'Huanca Sancos']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0504', 'name' => 'Huanta']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0505', 'name' => 'La Mar']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0506', 'name' => 'Lucanas']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0507', 'name' => 'Parinacochas']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0508', 'name' => 'Pàucar del Sara Sara']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0509', 'name' => 'Sucre']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0510', 'name' => 'Víctor Fajardo']);
        DB::table('provinces')->insert(['department_id' => 5, 'ubigeo' => '0511', 'name' => 'Vilcas Huamán']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0601', 'name' => 'Cajamarca']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0602', 'name' => 'Cajabamba']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0603', 'name' => 'Celendín']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0604', 'name' => 'Chota']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0605', 'name' => 'Contumazá']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0606', 'name' => 'Cutervo']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0607', 'name' => 'Hualgayoc']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0608', 'name' => 'Jaén']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0609', 'name' => 'San Ignacio']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0610', 'name' => 'San Marcos']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0611', 'name' => 'San Miguel']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0612', 'name' => 'San Pablo']);
        DB::table('provinces')->insert(['department_id' => 6, 'ubigeo' => '0613', 'name' => 'Santa Cruz']);
        DB::table('provinces')->insert(['department_id' => 7, 'ubigeo' => '0701', 'name' => 'Prov. Const. del Callao']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0801', 'name' => 'Cusco']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0802', 'name' => 'Acomayo']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0803', 'name' => 'Anta']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0804', 'name' => 'Calca']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0805', 'name' => 'Canas']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0806', 'name' => 'Canchis']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0807', 'name' => 'Chumbivilcas']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0808', 'name' => 'Espinar']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0809', 'name' => 'La Convención']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0810', 'name' => 'Paruro']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0811', 'name' => 'Paucartambo']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0812', 'name' => 'Quispicanchi']);
        DB::table('provinces')->insert(['department_id' => 8, 'ubigeo' => '0813', 'name' => 'Urubamba']);
        DB::table('provinces')->insert(['department_id' => 9, 'ubigeo' => '0901', 'name' => 'Huancavelica']);
        DB::table('provinces')->insert(['department_id' => 9, 'ubigeo' => '0902', 'name' => 'Acobamba']);
        DB::table('provinces')->insert(['department_id' => 9, 'ubigeo' => '0903', 'name' => 'Angaraes']);
        DB::table('provinces')->insert(['department_id' => 9, 'ubigeo' => '0904', 'name' => 'Castrovirreyna']);
        DB::table('provinces')->insert(['department_id' => 9, 'ubigeo' => '0905', 'name' => 'Churcampa']);
        DB::table('provinces')->insert(['department_id' => 9, 'ubigeo' => '0906', 'name' => 'Huaytará']);
        DB::table('provinces')->insert(['department_id' => 9, 'ubigeo' => '0907', 'name' => 'Tayacaja']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1001', 'name' => 'Huánuco']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1002', 'name' => 'Ambo']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1003', 'name' => 'Dos de Mayo']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1004', 'name' => 'Huacaybamba']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1005', 'name' => 'Huamalíes']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1006', 'name' => 'Leoncio Prado']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1007', 'name' => 'Marañón']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1008', 'name' => 'Pachitea']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1009', 'name' => 'Puerto Inca']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1010', 'name' => 'Lauricocha']);
        DB::table('provinces')->insert(['department_id' => 10, 'ubigeo' => '1011', 'name' => 'Yarowilca']);
        DB::table('provinces')->insert(['department_id' => 11, 'ubigeo' => '1101', 'name' => 'Ica']);
        DB::table('provinces')->insert(['department_id' => 11, 'ubigeo' => '1102', 'name' => 'Chincha']);
        DB::table('provinces')->insert(['department_id' => 11, 'ubigeo' => '1103', 'name' => 'Nasca']);
        DB::table('provinces')->insert(['department_id' => 11, 'ubigeo' => '1104', 'name' => 'Palpa']);
        DB::table('provinces')->insert(['department_id' => 11, 'ubigeo' => '1105', 'name' => 'Pisco']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1201', 'name' => 'Huancayo']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1202', 'name' => 'Concepción']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1203', 'name' => 'Chanchamayo']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1204', 'name' => 'Jauja']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1205', 'name' => 'Junín']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1206', 'name' => 'Satipo']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1207', 'name' => 'Tarma']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1208', 'name' => 'Yauli']);
        DB::table('provinces')->insert(['department_id' => 12, 'ubigeo' => '1209', 'name' => 'Chupaca']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1301', 'name' => 'Trujillo']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1302', 'name' => 'Ascope']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1303', 'name' => 'Bolívar']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1304', 'name' => 'Chepén']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1305', 'name' => 'Julcán']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1306', 'name' => 'Otuzco']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1307', 'name' => 'Pacasmayo']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1308', 'name' => 'Pataz']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1309', 'name' => 'Sánchez Carrión']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1310', 'name' => 'Santiago de Chuco']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1311', 'name' => 'Gran Chimú']);
        DB::table('provinces')->insert(['department_id' => 13, 'ubigeo' => '1312', 'name' => 'Virú']);
        DB::table('provinces')->insert(['department_id' => 14, 'ubigeo' => '1401', 'name' => 'Chiclayo']);
        DB::table('provinces')->insert(['department_id' => 14, 'ubigeo' => '1402', 'name' => 'Ferreñafe']);
        DB::table('provinces')->insert(['department_id' => 14, 'ubigeo' => '1403', 'name' => 'Lambayeque']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1501', 'name' => 'Lima']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1502', 'name' => 'Barranca']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1503', 'name' => 'Cajatambo']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1504', 'name' => 'Canta']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1505', 'name' => 'Cañete']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1506', 'name' => 'Huaral']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1507', 'name' => 'Huarochirí']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1508', 'name' => 'Huaura']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1509', 'name' => 'Oyón']);
        DB::table('provinces')->insert(['department_id' => 15, 'ubigeo' => '1510', 'name' => 'Yauyos']);
        DB::table('provinces')->insert(['department_id' => 16, 'ubigeo' => '1601', 'name' => 'Maynas']);
        DB::table('provinces')->insert(['department_id' => 16, 'ubigeo' => '1602', 'name' => 'Alto Amazonas']);
        DB::table('provinces')->insert(['department_id' => 16, 'ubigeo' => '1603', 'name' => 'Loreto']);
        DB::table('provinces')->insert(['department_id' => 16, 'ubigeo' => '1604', 'name' => 'Mariscal Ramón Castilla']);
        DB::table('provinces')->insert(['department_id' => 16, 'ubigeo' => '1605', 'name' => 'Requena']);
        DB::table('provinces')->insert(['department_id' => 16, 'ubigeo' => '1606', 'name' => 'Ucayali']);
        DB::table('provinces')->insert(['department_id' => 16, 'ubigeo' => '1607', 'name' => 'Datem del Marañón']);
        DB::table('provinces')->insert(['department_id' => 16, 'ubigeo' => '1608', 'name' => 'Putumayo']);
        DB::table('provinces')->insert(['department_id' => 17, 'ubigeo' => '1701', 'name' => 'Tambopata']);
        DB::table('provinces')->insert(['department_id' => 17, 'ubigeo' => '1702', 'name' => 'Manu']);
        DB::table('provinces')->insert(['department_id' => 17, 'ubigeo' => '1703', 'name' => 'Tahuamanu']);
        DB::table('provinces')->insert(['department_id' => 18, 'ubigeo' => '1801', 'name' => 'Mariscal Nieto']);
        DB::table('provinces')->insert(['department_id' => 18, 'ubigeo' => '1802', 'name' => 'General Sánchez Cerro']);
        DB::table('provinces')->insert(['department_id' => 18, 'ubigeo' => '1803', 'name' => 'Ilo']);
        DB::table('provinces')->insert(['department_id' => 19, 'ubigeo' => '1901', 'name' => 'Pasco']);
        DB::table('provinces')->insert(['department_id' => 19, 'ubigeo' => '1902', 'name' => 'Daniel Alcides Carrión']);
        DB::table('provinces')->insert(['department_id' => 19, 'ubigeo' => '1903', 'name' => 'Oxapampa']);
        DB::table('provinces')->insert(['department_id' => 20, 'ubigeo' => '2001', 'name' => 'Piura']);
        DB::table('provinces')->insert(['department_id' => 20, 'ubigeo' => '2002', 'name' => 'Ayabaca']);
        DB::table('provinces')->insert(['department_id' => 20, 'ubigeo' => '2003', 'name' => 'Huancabamba']);
        DB::table('provinces')->insert(['department_id' => 20, 'ubigeo' => '2004', 'name' => 'Morropón']);
        DB::table('provinces')->insert(['department_id' => 20, 'ubigeo' => '2005', 'name' => 'Paita']);
        DB::table('provinces')->insert(['department_id' => 20, 'ubigeo' => '2006', 'name' => 'Sullana']);
        DB::table('provinces')->insert(['department_id' => 20, 'ubigeo' => '2007', 'name' => 'Talara']);
        DB::table('provinces')->insert(['department_id' => 20, 'ubigeo' => '2008', 'name' => 'Sechura']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2101', 'name' => 'Puno']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2102', 'name' => 'Azángaro']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2103', 'name' => 'Carabaya']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2104', 'name' => 'Chucuito']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2105', 'name' => 'El Collao']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2106', 'name' => 'Huancané']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2107', 'name' => 'Lampa']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2108', 'name' => 'Melgar']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2109', 'name' => 'Moho']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2110', 'name' => 'San Antonio de Putina']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2111', 'name' => 'San Román']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2112', 'name' => 'Sandia']);
        DB::table('provinces')->insert(['department_id' => 21, 'ubigeo' => '2113', 'name' => 'Yunguyo']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2201', 'name' => 'Moyobamba']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2202', 'name' => 'Bellavista']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2203', 'name' => 'El Dorado']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2204', 'name' => 'Huallaga']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2205', 'name' => 'Lamas']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2206', 'name' => 'Mariscal Cáceres']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2207', 'name' => 'Picota']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2208', 'name' => 'Rioja']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2209', 'name' => 'San Martín']);
        DB::table('provinces')->insert(['department_id' => 22, 'ubigeo' => '2210', 'name' => 'Tocache']);
        DB::table('provinces')->insert(['department_id' => 23, 'ubigeo' => '2301', 'name' => 'Tacna']);
        DB::table('provinces')->insert(['department_id' => 23, 'ubigeo' => '2302', 'name' => 'Candarave']);
        DB::table('provinces')->insert(['department_id' => 23, 'ubigeo' => '2303', 'name' => 'Jorge Basadre']);
        DB::table('provinces')->insert(['department_id' => 23, 'ubigeo' => '2304', 'name' => 'Tarata']);
        DB::table('provinces')->insert(['department_id' => 24, 'ubigeo' => '2401', 'name' => 'Tumbes']);
        DB::table('provinces')->insert(['department_id' => 24, 'ubigeo' => '2402', 'name' => 'Contralmirante Villar']);
        DB::table('provinces')->insert(['department_id' => 24, 'ubigeo' => '2403', 'name' => 'Zarumilla']);
        DB::table('provinces')->insert(['department_id' => 25, 'ubigeo' => '2501', 'name' => 'Coronel Portillo']);
        DB::table('provinces')->insert(['department_id' => 25, 'ubigeo' => '2502', 'name' => 'Atalaya']);
        DB::table('provinces')->insert(['department_id' => 25, 'ubigeo' => '2503', 'name' => 'Padre Abad']);
        DB::table('provinces')->insert(['department_id' => 25, 'ubigeo' => '2504', 'name' => 'Purús']);


    }
}
