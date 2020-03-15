<?php

use Illuminate\Database\Seeder;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
        INSERT INTO `contactos` 
        (`id`, `empresa_id`, `centro_id`, `nombre`, `cargo`, `zona`, `email`, `movil`, `oficina`, `created_at`, `updated_at`) VALUES
        (1, 5, 77, 'ALEJANDRO OYARZO','JEFE','3','alejandro.oyarzo@blumar.com', '+56 9 61427298' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (2, 5, 76, 'ALEJANDRO OYARZO','JEFE','3','alejandro.oyarzo@blumar.com', '+56 9 61427298' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (3, 5, 75, 'NELSON PEREZ','JEFE',4,'nelson.perez@blumar.com', '+56412269400' ,'PUNTA ARENAX','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (4, 1, 11, 'FRANCISCO SUBIABRE','JEFE',2,'Francisco.Subiabre@cermaq.com', '+56(9)40023518' ,'QUENCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (5, 1, 2, 'FRANCISCO SUBIABRE','JEFE',2,'Francisco.Subiabre@cermaq.com', '+56(9)40023518' ,'QUENCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (6, 1, 12, 'FRANCISCO SUBIABRE','JEFE',2,'Francisco.Subiabre@cermaq.com', '+56(9)40023518' ,'QUENCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (7, 1, 5, 'FRANCISCO SUBIABRE','JEFE',2,'Francisco.Subiabre@cermaq.com', '+56(9)40023518' ,'DUCAÑAS','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (8, 1, 28, 'FRANCISCO SUBIABRE','JEFE',2,'Francisco.Subiabre@cermaq.com', '+56(9)40023518' ,'QUENCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (9, 1, 23, 'FRANCISCO SUBIABRE','JEFE',2,'Francisco.Subiabre@cermaq.com', '+56(9)40023518' ,'QUENCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (10, 1, 27, 'FRANCISCO SUBIABRE','JEFE',2,'Francisco.Subiabre@cermaq.com', '+56(9)40023518' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (11, 1, 18, 'LUIS CIGARRUISTA','JEFE',1,'luis.cigarruista@cermaq.com', '+56952381148' ,'HUALAIHUE','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (12, 1, 8, 'LUIS CIGARRUISTA','JEFE',1,'luis.cigarruista@cermaq.com', '+56952381148' ,'HUALAIHUE','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (13, 1, 3, 'LUIS CIGARRUISTA','JEFE',1,'luis.cigarruista@cermaq.com', '+56952381148' ,'HUALAIHUE','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (14, 1, 25, 'MARCELO FRANCIS','JEFE',4,'marcelo.franzi@cermaq.com', '+56971359233' ,'PUNTA ARENA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (15, 1, 26, 'MARCELO FRANCIS','JEFE',4,'marcelo.franzi@cermaq.com', '+56971359233' ,'PUNTA ARENA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (16, 1, 10, 'MARCELO FRANCIS','JEFE',4,'marcelo.franzi@cermaq.com', '+56971359233' ,'PUNTA ARENA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (17, 1, 82, 'MARCELO FRANCIS','JEFE',4,'marcelo.franzi@cermaq.com', '+56971359233' ,'PUNTA ARENA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (18, 1, 83, 'MARCELO FRANCIS','JEFE',4,'marcelo.franzi@cermaq.com', '+56971359233' ,'PUNTA ARENA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (19, 1, 84, 'MARCELO FRANCIS','JEFE',4,'marcelo.franzi@cermaq.com', '+56971359233' ,'PUNTA ARENA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (20, 1, 24, 'MARCELO FRANCIS','JEFE',4,'marcelo.franzi@cermaq.com', '+56971359233' ,'PUNTA ARENA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (21, 1, 13, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56652563200' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (22, 1, 4, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56652563200' ,'HUALAIHUE','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (23, 1, 6, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56652563200' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (24, 1, 85, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com','+56652563200' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (25, 1, 9, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56652563200' ,'HUALAIHUE','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (26, 1, 30, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56 65 2563200' ,'HUALAIHUE','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (27, 1, 1, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56 65 2563200' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (28, 1, 86, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56 65 2563200' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (29, 1, 87, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56 65 2563200' ,'CALBUCO-HUELMO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (30, 1, 88, 'MAURICIO LASERRE','JEFE',1,'Mauricio.Lasserre@cermaq.com', '+56 65 2563200' ,'CALBUCO-HUELMO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (31, 1, 89, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (32, 1, 21, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (33, 1, 19, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (34, 1, 14, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (35, 1, 15, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (36, 1, 90, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (37, 1, 7, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200','CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (38, 1, 20, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (39, 1, 17, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (40, 1, 16, 'VICTOR GONZALEZ','JEFE',2,'victor.gonzalez@cermaq.com', '+56 65 2563200' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (41, 6, 91, 'JORGE PEÑA','JEFE',3,'jorge.pena@cookeaqua.com', '+5697609626' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (42, 2, 92, 'ALEJANDRO CARRILLO','JEFE',3,'acarrillo@marinefarm.cl', '+56 9 82417504' ,'AYSEN','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (43, 2, 46, 'CLAUDIO ANDRADE','JEFE',1,'candrade@marinefarm.cl', '+5699590986' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (44, 2, 31, 'CLAUDIO ANDRADE','JEFE',1,'candrade@marinefarm.cl', '+5699590986' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (45, 2, 34, 'CLAUDIO ANDRADE','JEFE',1,'candrade@marinefarm.cl', '+5699590986' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (46, 2, 45, 'CLAUDIO ANDRADE','JEFE',1,'candrade@marinefarm.cl', '+5699590986' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (47, 2, 33, 'CLAUDIO ANDRADE','JEFE',1,'candrade@marinefarm.cl', '+5699590986' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (48, 2, 39, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (49, 2, 38, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (50, 2, 42, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (51, 2, 44, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (52, 2, 43, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (53, 2, 40, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (54, 2, 93, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (55, 2, 94, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (56, 2, 32, 'CLAUDIO ANDRADE','JEFE',2,'candrade@marinefarm.cl', '+5699590986' ,'QUELLON','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (57, 2, 35, 'SERGIO VASQUEZ','JEFE',3,'svasquez@marinefarm.cl', '+56995023772' ,'AYSEN','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (58, 2, 37, 'SERGIO VASQUEZ','JEFE',3,'svasquez@marinefarm.cl', '+56995023772' ,'AYSEN','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (59, 2, 41, 'SERGIO VASQUEZ','JEFE',3,'svasquez@marinefarm.cl', '+56995023772' ,'AYSEN','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (60, 2, 35, 'SERGIO VASQUEZ','JEFE',3,'svasquez@marinefarm.cl', '+56995023772' ,'AYSEN2','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (61, 3, 51, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (62, 3, 52, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (63, 3, 81, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (64, 3, 53, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (65, 3, 56, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (66, 3, 70, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (67, 3, 69, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (68, 3, 71, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (69, 3, 61, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (70, 3, 62, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (71, 3, 63, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (72, 3, 66, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (73, 3, 95, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (74, 3, 50, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (75, 3, 67, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (76, 3, 64, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (77, 3, 96, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (78, 3, 97, 'AQUILES VELAZQUEZ','JEFE',3,'Aquiles.Velazquez@mowi.com', '9 65090673' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (79, 3, 47, 'BENJAMIN CASTRO','JEFE',2,'Benjamin.Castro@mowi.com', '+56 9 96979149','CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (80, 3, 48, 'BENJAMIN CASTRO','JEFE',2,'Benjamin.Castro@mowi.com', '+56 9 96979149' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (81, 3, 78, 'DANIEL CEBALLO','JEFE',3,'Daniel.Ceballo@mowi.com', 'NULL' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (82, 3, 79, 'DANIEL CEBALLO','JEFE',3,'Daniel.Ceballo@mowi.com', 'NULL' ,'PUERTO CHACABUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (83, 3, 98, 'EUGENIA GONZALEZ','JEFE',1,'Eugenia.Gonzalez@mowi.com', 'NULL' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (84, 3, 58, 'HECTOR CID','JEFE',2,'Hector.Cid@mowi.com', '9 985814443' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (85, 3, 68, 'PATRICIO PEREZ','JEFE',1,'Patricio.Perez@mowi.com', '+56 9 91872115' ,'CALBUCO-HUELMO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (86, 3, 99, 'PATRICIO PEREZ','JEFE',2,'Patricio.Perez@mowi.com', '+56 9 91872115' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (87, 3, 72, 'RODRIGO PAVEZ','JEFE',2,'Rodrigo.Pavez@mowi.com', '9 89033038' ,'CHONCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (88, 3, 74, 'ROBINSON CORDOVA','JEFE',1,'robinson.cordova@marineharvest.com', '+56 9 93271453' ,'CALBUCO-HUELMO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (89, 3, 55, 'RODOLFO GUZMAN','JEFE',1,'Rodolfo.Guzman@mowi.com', '+56 9 42055481' ,'CALBUCO-HUELMO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (90, 4, 100, 'FELIPE GONZALEZ','JEFE',1,'FGONZALEZ@ventisqueros.cl', '56 9 91854401' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (91, 4, 101, 'FELIPE GONZALEZ','JEFE',1,'FGONZALEZ@ventisqueros.cl', '56 9 91854401' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (92, 4, 102, 'FELIPE GONZALEZ','JEFE',1,'FGONZALEZ@ventisqueros.cl', '56 9 91854401' ,'CALBUCO','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (93, 4, 103, 'FELIPE GONZALEZ','JEFE',1,'FGONZALEZ@ventisqueros.cl', '56 9 91854401' ,'HORNOPIREN','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (94, 4, 104, 'FELIPE GONZALEZ','JEFE',1,'FGONZALEZ@ventisqueros.cl', '56 9 91854401' ,'HORNOPIREN','2019-07-29 19:41:30','2019-07-29 19:41:30');
                ";
        
        DB::select($sql);        

    }
}
