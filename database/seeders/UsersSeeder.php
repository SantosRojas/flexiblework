<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            
        [
            "name" => "Romy karina", 
            "last_name" => "Mayta Paulet", 
            "work_area" => "SALUD OCUPACIONAL", 
            "role" => "manager", 
            "email" => "romy.mayta@bbraun.com", 
            "password" => "1320287"
        ],
    

        [
            "name" => "Edwin", 
            "last_name" => "Zamora Diaz", 
            "work_area" => "VENTAS CANAL PRIVADO", 
            "role" => "user", 
            "email" => "edwin.zamora@bbraun.com", 
            "password" => "6045616"
        ],
    

        [
            "name" => "Omar wilfredo", 
            "last_name" => "Balarezo Silva", 
            "work_area" => "AVITUM", 
            "role" => "user", 
            "email" => "omar.balarezo@bbraun.com", 
            "password" => "6174535"
        ],
    

        [
            "name" => "Carmen aixa", 
            "last_name" => "Bolaños Sotomayor", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "carmen.bolanos@bbraun.com", 
            "password" => "6449466"
        ],
    

        [
            "name" => "Rosalia shirley", 
            "last_name" => "Ochoa Lopez", 
            "work_area" => "FINANZAS", 
            "role" => "manager", 
            "email" => "rosalia.ochoa@bbraun.com", 
            "password" => "6768248"
        ],
    

        [
            "name" => "Raul gustavo", 
            "last_name" => "Sanchez Remicio", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "manager", 
            "email" => "gustavo1.sanchez@bbraun.com", 
            "password" => "6770596"
        ],
    

        [
            "name" => "Luis enrique", 
            "last_name" => "Peña Santana", 
            "work_area" => "ALMACEN DROGUERIA", 
            "role" => "user", 
            "email" => "luis.pena@bbraun.com", 
            "password" => "7022181"
        ],
    

        [
            "name" => "Patricia del rocio", 
            "last_name" => "Celis Celis", 
            "work_area" => "AIS", 
            "role" => "user", 
            "email" => "patricia.celis@bbraun.com", 
            "password" => "7252509"
        ],
    

        [
            "name" => "Abraham", 
            "last_name" => "Gomez Saavedra", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "abraham.gomez@bbraun.com", 
            "password" => "7538620"
        ],
    

        [
            "name" => "Julio", 
            "last_name" => "Mendoza Lopez", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "julio.mendoza@bbraun.com", 
            "password" => "7755946"
        ],
    

        [
            "name" => "Luis enrique", 
            "last_name" => "Cieza Salazar", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "manager", 
            "email" => "luis.cieza@bbraun.com", 
            "password" => "7763932"
        ],
    

        [
            "name" => "Fernando jose", 
            "last_name" => "Castro Garcia-calderon", 
            "work_area" => "AESCULAP", 
            "role" => "user", 
            "email" => "fernando.castro@bbraun.com", 
            "password" => "7771090"
        ],
    

        [
            "name" => "Emilia", 
            "last_name" => "Montalvo Valderrama", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "emilia.montalvo@bbraun.com", 
            "password" => "7960613"
        ],
    

        [
            "name" => "Janet rut", 
            "last_name" => "Diaz Felix", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "manager", 
            "email" => "janet.diaz@bbraun.com", 
            "password" => "8040890"
        ],
    

        [
            "name" => "Jose", 
            "last_name" => "Ordoñez Valdiviezo", 
            "work_area" => "ALMACEN DROGUERIA", 
            "role" => "user", 
            "email" => "jose.ordonez@bbraun.com", 
            "password" => "8157588"
        ],
    

        [
            "name" => "Milagros", 
            "last_name" => "Verastegui Pimentel", 
            "work_area" => "AESCULAP", 
            "role" => "user", 
            "email" => "milagros.verastegui@bbraun.com", 
            "password" => "8695371"
        ],
    

        [
            "name" => "Max felipe", 
            "last_name" => "Alcala Cotos", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "manager", 
            "email" => "max.alcala@bbraun.com", 
            "password" => "9304501"
        ],
    

        [
            "name" => "Beatriz", 
            "last_name" => "Diaz Rios", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "user", 
            "email" => "beatriz.diaz@bbraun.com", 
            "password" => "9599814"
        ],
    

        [
            "name" => "Azucena", 
            "last_name" => "Cartty Pizarro", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "manager", 
            "email" => "azucena.cartty@bbraun.com", 
            "password" => "9607059"
        ],
    

        [
            "name" => "Sara victoria", 
            "last_name" => "Romero Santa cruz", 
            "work_area" => "AESCULAP", 
            "role" => "user", 
            "email" => "sara1.romero@bbraun.com", 
            "password" => "9657173"
        ],
    

        [
            "name" => "Karin edith", 
            "last_name" => "Aguirre Aguirre", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "user", 
            "email" => "karin.aguirre@bbraun.com", 
            "password" => "9844910"
        ],
    

        [
            "name" => "Cesar enrique", 
            "last_name" => "Peña Condori", 
            "work_area" => "ALMACEN DROGUERIA", 
            "role" => "user", 
            "email" => "cesar.pena@bbraun.com", 
            "password" => "9957373"
        ],
    

        [
            "name" => "Percy oscar", 
            "last_name" => "Huaranca Venegas", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "percy.huaranca@bbraun.com", 
            "password" => "10021391"
        ],
    

        [
            "name" => "Antonio miguel", 
            "last_name" => "Chang Fon", 
            "work_area" => "INFORMATICA", 
            "role" => "manager", 
            "email" => "antonio.chang@bbraun.com", 
            "password" => "10304529"
        ],
    

        [
            "name" => "Nelson", 
            "last_name" => "Casana Carlos", 
            "work_area" => "PLANEAMIENTO", 
            "role" => "manager", 
            "email" => "nelson.casana@bbraun.com", 
            "password" => "10453219"
        ],
    

        [
            "name" => "Maria celia", 
            "last_name" => "Zegarra Carbajal", 
            "work_area" => "VENTAS CANAL PRIVADO", 
            "role" => "manager", 
            "email" => "celia.zegarra@bbraun.com", 
            "password" => "10536267"
        ],
    

        [
            "name" => "Gladys elva", 
            "last_name" => "Saravia Bermudez", 
            "work_area" => "AIS", 
            "role" => "user", 
            "email" => "gladys.saravia@bbraun.com", 
            "password" => "10587981"
        ],
    

        [
            "name" => "Cristhian ronald", 
            "last_name" => "Tapia Calderon", 
            "work_area" => "FRUTIFLEX", 
            "role" => "manager", 
            "email" => "cristhian.tapia@bbraun.com", 
            "password" => "10694864"
        ],
    

        [
            "name" => "Haydee lourdes", 
            "last_name" => "De la cruz Vargas", 
            "work_area" => "ALMACEN DROGUERIA", 
            "role" => "user", 
            "email" => "lourdes.delacruz@bbraun.com", 
            "password" => "10870279"
        ],
    

        [
            "name" => "Nicolai", 
            "last_name" => "Vasquez Yap sam", 
            "work_area" => "AIS", 
            "role" => "manager", 
            "email" => "nicolai.vasquez@bbraun.com", 
            "password" => "16718381"
        ],
    

        [
            "name" => "Orietta jessica", 
            "last_name" => "Torres Chavez", 
            "work_area" => "AVITUM", 
            "role" => "user", 
            "email" => "orietta.torres@bbraun.com", 
            "password" => "16729512"
        ],
    

        [
            "name" => "Cesar walter", 
            "last_name" => "Tamay Montoya", 
            "work_area" => "ALMACEN DROGUERIA", 
            "role" => "user", 
            "email" => "cesar.tamay@bbraun.com", 
            "password" => "16762141"
        ],
    

        [
            "name" => "Jose ricardo", 
            "last_name" => "Arrascue Armestar", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "ricardo.arrascue@bbraun.com", 
            "password" => "16774574"
        ],
    

        [
            "name" => "Hector", 
            "last_name" => "Cubas Casana", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "hector.cubas@bbraun.com", 
            "password" => "18099883"
        ],
    

        [
            "name" => "Rina vlady", 
            "last_name" => "Varea Y ratto", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "manager", 
            "email" => "rina.varea@bbraun.com", 
            "password" => "22423990"
        ],
    

        [
            "name" => "Ruben fabrizio", 
            "last_name" => "Noriega Guevara", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "fabrizio.noriega@bbraun.com", 
            "password" => "24006322"
        ],
    

        [
            "name" => "Guillermo ernesto", 
            "last_name" => "Cuenca Gaviria", 
            "work_area" => "RRHH", 
            "role" => "manager", 
            "email" => "guillermo.cuenca@bbraun.com", 
            "password" => "25608310"
        ],
    

        [
            "name" => "Cristel milagritos", 
            "last_name" => "Sampen Vera", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "manager", 
            "email" => "cristel.sampen@bbraun.com", 
            "password" => "25777559"
        ],
    

        [
            "name" => "Anabel maria", 
            "last_name" => "Cueva Martinez", 
            "work_area" => "AVITUM", 
            "role" => "manager", 
            "email" => "anabel.cueva@bbraun.com", 
            "password" => "30488315"
        ],
    

        [
            "name" => "Juan carlos", 
            "last_name" => "Campos Palacios", 
            "work_area" => "COMPRAS", 
            "role" => "manager", 
            "email" => "juancarlos.campos@bbraun.com", 
            "password" => "32926018"
        ],
    

        [
            "name" => "Rosario pilar", 
            "last_name" => "Meza Neyra", 
            "work_area" => "AESCULAP", 
            "role" => "manager", 
            "email" => "rosario.meza@bbraun.com", 
            "password" => "40213577"
        ],
    

        [
            "name" => "Omar alberto", 
            "last_name" => "Flores Lopez", 
            "work_area" => "GERENCIA DIRECTO", 
            "role" => "user", 
            "email" => "omar.flores@bbraun.com", 
            "password" => "40437984"
        ],
    

        [
            "name" => "Veronica liliana", 
            "last_name" => "Robles Leon", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "manager", 
            "email" => "liliana.robles@bbraun.com", 
            "password" => "40555452"
        ],
    

        [
            "name" => "Sonia del pilar", 
            "last_name" => "Otiniano Vasquez", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "user", 
            "email" => "sonia.otiniano@bbraun.com", 
            "password" => "40564292"
        ],
    

        [
            "name" => "Martha melissa", 
            "last_name" => "Guerra Bejarano", 
            "work_area" => "GERENCIA DIRECTO", 
            "role" => "user", 
            "email" => "martha.guerra@bbraun.com", 
            "password" => "40691591"
        ],
    

        [
            "name" => "Melik jeannet", 
            "last_name" => "Olivares Herrera", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "melik.olivares@bbraun.com", 
            "password" => "40712616"
        ],
    

        [
            "name" => "Yudith cecilia", 
            "last_name" => "Solano Sayas", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "manager", 
            "email" => "yudith.solano@bbraun.com", 
            "password" => "41000001"
        ],
    

        [
            "name" => "Ciro giancarlo", 
            "last_name" => "Hurtado Torres", 
            "work_area" => "FINANZAS", 
            "role" => "user", 
            "email" => "giancarlo.hurtado@bbraun.com", 
            "password" => "41077154"
        ],
    

        [
            "name" => "Renzo martin", 
            "last_name" => "Galindo Camacho", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "renzo.galindo@bbraun.com", 
            "password" => "41103494"
        ],
    

        [
            "name" => "Jacqueline ines", 
            "last_name" => "Pilco Pino", 
            "work_area" => "DIRECCIÓN TÉCNICA DROGUERIA", 
            "role" => "user", 
            "email" => "jacqueline.pilco@bbraun.com", 
            "password" => "41170467"
        ],
    

        [
            "name" => "Carmen miriela", 
            "last_name" => "Sanchez Andrade", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "manager", 
            "email" => "carmen1.sanchez@bbraun.com", 
            "password" => "41243494"
        ],
    

        [
            "name" => "Carlos omar", 
            "last_name" => "Chero Anastacio", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "carlos.chero@bbraun.com", 
            "password" => "41399417"
        ],
    

        [
            "name" => "Katherine lizet", 
            "last_name" => "Florian Villacorta", 
            "work_area" => "AESCULAP", 
            "role" => "manager", 
            "email" => "katherine.florian@bbraun.com", 
            "password" => "41637072"
        ],
    

        [
            "name" => "Cynthia anali", 
            "last_name" => "Moreno Verastegui", 
            "work_area" => "CONTABILIDAD", 
            "role" => "user", 
            "email" => "cynthia.moreno@bbraun.com", 
            "password" => "41663782"
        ],
    

        [
            "name" => "Cynthia", 
            "last_name" => "Rodriguez Robladillo", 
            "work_area" => "AESCULAP", 
            "role" => "manager", 
            "email" => "cynthia.rodriguez@bbraun.com", 
            "password" => "41666364"
        ],
    

        [
            "name" => "Pedro gabriel", 
            "last_name" => "Julca Quispe", 
            "work_area" => "ALMACEN DROGUERIA", 
            "role" => "user", 
            "email" => "pedro1.julca@bbraun.com", 
            "password" => "41772910"
        ],
    

        [
            "name" => "Diego gonzalo miguel", 
            "last_name" => "Menendez Mendizabal", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "diego.menendez@bbraun.com", 
            "password" => "41775724"
        ],
    

        [
            "name" => "Jeimy ruth", 
            "last_name" => "Matumay Espichan", 
            "work_area" => "AVITUM", 
            "role" => "user", 
            "email" => "jeimy.matumay@bbraun.com", 
            "password" => "41825953"
        ],
    

        [
            "name" => "Miguel angel", 
            "last_name" => "Perez Rimarachin", 
            "work_area" => "CONTABILIDAD", 
            "role" => "user", 
            "email" => "angel.perez@bbraun.com", 
            "password" => "42382052"
        ],
    

        [
            "name" => "Mario luis", 
            "last_name" => "Velasquez Bardales", 
            "work_area" => "CONTABILIDAD", 
            "role" => "user", 
            "email" => "mario.velasquez@bbraun.com", 
            "password" => "42506411"
        ],
    

        [
            "name" => "Juan eduardo", 
            "last_name" => "Wong Murga", 
            "work_area" => "COMPRAS", 
            "role" => "manager", 
            "email" => "juan.wong@bbraun.com", 
            "password" => "43523115"
        ],
    

        [
            "name" => "Jorge manuel", 
            "last_name" => "Tomioka Matsukawa", 
            "work_area" => "GERENCIA DIRECTO", 
            "role" => "manager", 
            "email" => "jorge.tomioka@bbraun.com", 
            "password" => "43601523"
        ],
    

        [
            "name" => "Alvaro felipe", 
            "last_name" => "Miyahira Teran", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "manager", 
            "email" => "alvaro.miyahira@bbraun.com", 
            "password" => "43905064"
        ],
    

        [
            "name" => "Paulo cesar", 
            "last_name" => "Ascuez Valero", 
            "work_area" => "FINANZAS", 
            "role" => "user", 
            "email" => "paulo.ascuez@bbraun.com", 
            "password" => "44122949"
        ],
    

        [
            "name" => "Marina lourdes", 
            "last_name" => "Rojas Lazaro", 
            "work_area" => "RRHH", 
            "role" => "user", 
            "email" => "marina.rojas@bbraun.com", 
            "password" => "44182967"
        ],
    

        [
            "name" => "Marielena", 
            "last_name" => "Sanchez Quispe", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "user", 
            "email" => "marielena.sanchez@bbraun.com", 
            "password" => "44193049"
        ],
    

        [
            "name" => "Vicky rocio", 
            "last_name" => "Pajita Capcha", 
            "work_area" => "VENTAS CANAL PRIVADO", 
            "role" => "user", 
            "email" => "rocio.pajita@bbraun.com", 
            "password" => "44258725"
        ],
    

        [
            "name" => "Luis enrique", 
            "last_name" => "Gutierrez Alvarez", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "luisenrique.gutierrez@bbraun.com", 
            "password" => "44870685"
        ],
    

        [
            "name" => "Katerine cris", 
            "last_name" => "Alanya Paredes", 
            "work_area" => "VENTAS CANAL PRIVADO", 
            "role" => "user", 
            "email" => "katerine.alanya@bbraun.com", 
            "password" => "44910710"
        ],
    

        [
            "name" => "Cesar luis", 
            "last_name" => "Galarza Lopez", 
            "work_area" => "COMPRAS", 
            "role" => "user", 
            "email" => "cesar.galarza@bbraun.com", 
            "password" => "44967836"
        ],
    

        [
            "name" => "Marylin lizzeth", 
            "last_name" => "Aliaga Orderique", 
            "work_area" => "AESCULAP", 
            "role" => "manager", 
            "email" => "marylin.aliaga@bbraun.com", 
            "password" => "45119524"
        ],
    

        [
            "name" => "Fabiola victoria", 
            "last_name" => "Bendezu Paqui", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "fabiola.bendezu@bbraun.com", 
            "password" => "45347730"
        ],
    

        [
            "name" => "Aldo ivan", 
            "last_name" => "Garcia Guarniz", 
            "work_area" => "AIS", 
            "role" => "user", 
            "email" => "aldo.garcia@bbraun.com", 
            "password" => "45578383"
        ],
    

        [
            "name" => "Sheyla agnes", 
            "last_name" => "Wong Altamirano", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "sheyla.wong@bbraun.com", 
            "password" => "45629365"
        ],
    

        [
            "name" => "Luis miguel", 
            "last_name" => "Rivera Espinoza", 
            "work_area" => "FINANZAS", 
            "role" => "user", 
            "email" => "luis.rivera@bbraun.com", 
            "password" => "45645308"
        ],
    

        [
            "name" => "Gina paola", 
            "last_name" => "Moreno Fasanando", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "gina.moreno@bbraun.com", 
            "password" => "45671552"
        ],
    

        [
            "name" => "Vanessa rosario", 
            "last_name" => "Fernandez Donayre", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "manager", 
            "email" => "vanessa.fernandez@bbraun.com", 
            "password" => "46207808"
        ],
    

        [
            "name" => "Diana jessica", 
            "last_name" => "Guillen Mayorga", 
            "work_area" => "AVITUM", 
            "role" => "user", 
            "email" => "diana.guillen@bbraun.com", 
            "password" => "46314232"
        ],
    

        [
            "name" => "Jacklyn johana", 
            "last_name" => "Carmen Lozano", 
            "work_area" => "AESCULAP", 
            "role" => "user", 
            "email" => "jacklyn.carmen1@bbraun.com", 
            "password" => "46345375"
        ],
    

        [
            "name" => "Karen melva", 
            "last_name" => "Licera Pomiano", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "user", 
            "email" => "karen.licera@bbraun.com", 
            "password" => "46359271"
        ],
    

        [
            "name" => "Pedro hugo", 
            "last_name" => "Villanueva Parian", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "pedro.villanueva@bbraun.com", 
            "password" => "46444059"
        ],
    

        [
            "name" => "Elias wilder", 
            "last_name" => "Cabanillas Juarez", 
            "work_area" => "AIS", 
            "role" => "user", 
            "email" => "elias1.cabanillas@bbraun.com", 
            "password" => "46497526"
        ],
    

        [
            "name" => "Hugo daniel", 
            "last_name" => "Mejia Martinez", 
            "work_area" => "COMPRAS", 
            "role" => "user", 
            "email" => "hugo.mejia@bbraun.com", 
            "password" => "46871562"
        ],
    

        [
            "name" => "Yanet miriam", 
            "last_name" => "Torres Quispe", 
            "work_area" => "FINANZAS", 
            "role" => "user", 
            "email" => "yanet.torres@bbraun.com", 
            "password" => "47075652"
        ],
    

        [
            "name" => "Maria esther", 
            "last_name" => "Jaime Chise", 
            "work_area" => "CONTABILIDAD", 
            "role" => "manager", 
            "email" => "maria.jaime@bbraun.com", 
            "password" => "47190350"
        ],
    

        [
            "name" => "Karen elizabeth", 
            "last_name" => "Chihuan Zevallos", 
            "work_area" => "DIRECCIÓN TÉCNICA DROGUERIA", 
            "role" => "user", 
            "email" => "karen.chihuan@bbraun.com", 
            "password" => "47241267"
        ],
    

        [
            "name" => "Melissa astrid", 
            "last_name" => "Cajahuanca Arias", 
            "work_area" => "DIRECCIÓN TÉCNICA DROGUERIA", 
            "role" => "user", 
            "email" => "melissa.cajahuanca@bbraun.com", 
            "password" => "47294256"
        ],
    

        [
            "name" => "Piero reynaldo", 
            "last_name" => "Quinto Jimenez", 
            "work_area" => "CONTROLLING", 
            "role" => "manager", 
            "email" => "piero.quinto@bbraun.com", 
            "password" => "47308224"
        ],
    

        [
            "name" => "Cesar junior", 
            "last_name" => "Vera Castillo", 
            "work_area" => "ALMACEN DROGUERIA", 
            "role" => "manager", 
            "email" => "cesar.vera@bbraun.com", 
            "password" => "47433674"
        ],
    

        [
            "name" => "Joselyn consuelo", 
            "last_name" => "Huapaya Ticse", 
            "work_area" => "AESCULAP", 
            "role" => "user", 
            "email" => "joselyn.huapaya@bbraun.com", 
            "password" => "47529787"
        ],
    

        [
            "name" => "Sheyla isabel", 
            "last_name" => "Ruiz Ramon", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "user", 
            "email" => "sheyla.ruiz@bbraun.com", 
            "password" => "47759649"
        ],
    

        [
            "name" => "Sheyla maritza", 
            "last_name" => "Matos Peña", 
            "work_area" => "HOSPITAL CARE", 
            "role" => "user", 
            "email" => "sheyla.matos@bbraun.com", 
            "password" => "47804036"
        ],
    

        [
            "name" => "Karina elibeth", 
            "last_name" => "Torres Meza", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "user", 
            "email" => "karina.torres1@bbraun.com", 
            "password" => "48279482"
        ],
    

        [
            "name" => "Santos herminio", 
            "last_name" => "Rojas Gutierrez", 
            "work_area" => "INFORMATICA", 
            "role" => "user", 
            "email" => "santos.rojas@bbraun.com", 
            "password" => "48500341"
        ],
    

        [
            "name" => "Jhudith enma", 
            "last_name" => "Cuenca Alfaro", 
            "work_area" => "DIRECCIÓN TÉCNICA DROGUERIA", 
            "role" => "user", 
            "email" => "jhudith.cuenca@bbraun.com", 
            "password" => "70114204"
        ],
    

        [
            "name" => "Piero andre", 
            "last_name" => "Diaz Hidalgo", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "piero.diaz@bbraun.com", 
            "password" => "70125582"
        ],
    

        [
            "name" => "Yessenia edith", 
            "last_name" => "Yañez Castañeda", 
            "work_area" => "DIRECCIÓN TÉCNICA DROGUERIA", 
            "role" => "user", 
            "email" => "yessenia.yanez@bbraun.com", 
            "password" => "70244233"
        ],
    

        [
            "name" => "Christopher", 
            "last_name" => "Mitterhofer Castellano", 
            "work_area" => "FRUTIFLEX", 
            "role" => "manager", 
            "email" => "christopher.mitterhofer@bbraun.com", 
            "password" => "70333295"
        ],
    

        [
            "name" => "Daniel", 
            "last_name" => "Fernandez Villar", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "daniel12.fernandez@bbraun.com", 
            "password" => "70410736"
        ],
    

        [
            "name" => "Edmundo martin", 
            "last_name" => "Mansilla Acosta", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "edmundo.mansilla@bbraun.com", 
            "password" => "70411395"
        ],
    

        [
            "name" => "Andrea", 
            "last_name" => "Zambrano Hospina", 
            "work_area" => "AESCULAP", 
            "role" => "user", 
            "email" => "andrea.zambrano1@bbraun.com", 
            "password" => "70437800"
        ],
    

        [
            "name" => "Carlos alberto", 
            "last_name" => "Tapia Colonia", 
            "work_area" => "AIS", 
            "role" => "user", 
            "email" => "carlos1.tapia@bbraun.com", 
            "password" => "70569388"
        ],
    

        [
            "name" => "Yanira arelys", 
            "last_name" => "Alor Balbin", 
            "work_area" => "GERENCIA DIRECTO", 
            "role" => "user", 
            "email" => "yanira.alor@bbraun.com", 
            "password" => "70608496"
        ],
    

        [
            "name" => "William francisco", 
            "last_name" => "Novoa Diaz", 
            "work_area" => "CONTROLLING", 
            "role" => "user", 
            "email" => "william.novoa@bbraun.com", 
            "password" => "70935845"
        ],
    

        [
            "name" => "Evelyn damaris", 
            "last_name" => "Ñacari Sulca", 
            "work_area" => "DIRECCIÓN TÉCNICA DROGUERIA", 
            "role" => "user", 
            "email" => "damaris.nacari@bbraun.com", 
            "password" => "70970803"
        ],
    

        [
            "name" => "Jose eduardo", 
            "last_name" => "Casusol Huavil", 
            "work_area" => "INFORMATICA", 
            "role" => "user", 
            "email" => "jose.casusol@bbraun.com", 
            "password" => "71486979"
        ],
    

        [
            "name" => "Romi vianne", 
            "last_name" => "Sullca Bendezu", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "romi.sullca@bbraun.com", 
            "password" => "72253631"
        ],
    

        [
            "name" => "Edisson yordano", 
            "last_name" => "Hernandez Quispe", 
            "work_area" => "PLANEAMIENTO", 
            "role" => "manager", 
            "email" => "edisson.hernandez@bbraun.com", 
            "password" => "72355426"
        ],
    

        [
            "name" => "Roberto rafael", 
            "last_name" => "Vilchez San martin", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "roberto.vilchez@bbraun.com", 
            "password" => "72771670"
        ],
    

        [
            "name" => "Marisol", 
            "last_name" => "Mejia Montalvo", 
            "work_area" => "PRODUCCION FARMA", 
            "role" => "user", 
            "email" => "marisol.mejia@bbraun.com", 
            "password" => "73023830"
        ],
    

        [
            "name" => "Nathaly gianella", 
            "last_name" => "Moreno Tolentino", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "nathaly.moreno@bbraun.com", 
            "password" => "73390499"
        ],
    

        [
            "name" => "Greyssi geraldine", 
            "last_name" => "Guevara Yzaciga", 
            "work_area" => "SERVICIO AL CLIENTE", 
            "role" => "user", 
            "email" => "greysi.guevara@bbraun.com", 
            "password" => "74156485"
        ],
    

        [
            "name" => "Raul william", 
            "last_name" => "Sanchez Pachas", 
            "work_area" => "SERVICIO TECNICO", 
            "role" => "user", 
            "email" => "raul1.sanchez@bbraun.com", 
            "password" => "75435713"
        ],
    

        [
            "name" => "Sebastian mauricio", 
            "last_name" => "Miñan Mendez", 
            "work_area" => "GERENCIA DIRECTO", 
            "role" => "user", 
            "email" => "sebastian.minan@bbraun.com", 
            "password" => "75973707"
        ],
    

        [
            "name" => "Zonali joselin", 
            "last_name" => "Paitan Guillen", 
            "work_area" => "GERENCIA DIRECTO", 
            "role" => "user", 
            "email" => "zonali.paitan@bbraun.com", 
            "password" => "77701870"
        ],
    

        ];

        // foreach ($users as $user) {
        //     User::create($user);
        // }



    }
}
