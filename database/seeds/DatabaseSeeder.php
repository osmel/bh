<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
   

        $this->call(RoleSeeder::class); //1

        factory(User::class)->create([ 
                'name'=>'osmel calderon bernal',
                'email'=>'osmel.calderon@gmail.com',
                'role_id'=>'1', //admin
                'photo'=>'',
                'password'=>bcrypt('osmel5458'), //encriptarla
        ]); 


        factory(User::class)->create([ 
                'name'=>'jean duvan',
                'email'=>'duvi@gmail.com',
                'role_id'=>'2', //cliente
                'photo'=>'',
                'password'=>bcrypt('osmel5458'), //encriptarla
        ]); 

        factory(User::class)->create([ 
                'name'=>'alex jhon',
                'email'=>'alex@gmail.com',
                'role_id'=>'4', //candidato
                'photo'=>'',
                'password'=>bcrypt('osmel5458'), //encriptarla
        ]);         

        //factory(User::class,2)->create();

        $this->call(ClienteSeeder::class); 

        $this->call(TipoVacanteSeeder::class); 
        $this->call(FaseSeeder::class); 
        $this->call(SemaforoSeeder::class); 
        $this->call(AreaSeeder::class); 

        $this->call(PuestoSeeder::class); 
        
        $this->call(PreguntaSeeder::class);
        $this->call(TemplateSeeder::class);
        $this->call(PreguntaTemplateSeeder::class);

        $this->call(ZonaSeeder::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(NivelSeeder::class); 
        $this->call(EstadoSeeder::class);

       $this->call(AdjuntoSeeder::class);
       $this->call(VacanteSeeder::class);
       $this->call(AdjuntoVacanteSeeder::class); 
        

        $this->call(ContactoSeeder::class); 

       
       $this->call(CandidatoSeeder::class); 

        $this->call(TipoReferenciaSeeder::class); 
        $this->call(ReferenciaSeeder::class); 


        $this->call(TipoEntrevistaSeeder::class); 
        
        $this->call(SelectorTipoSeeder::class); 
        $this->call(EntrevistaSeeder::class); 

         $this->call(SituacionSeeder::class); 
         $this->call(EstatuSeeder::class); 
       $this->call(CandidatoVacanteSeeder::class); 





        
        //$this->call(DescuentoSeeder::class);   //esto es para existencia, "no catalogo"

        //clientes, proveedores
        //registro de existencias
        
        /*
        $this->call(FabricanteSeeder::class); //1
        $this->call(CategoriaSeeder::class);  //1
        
        $this->call(MotorSeeder::class);
        $this->call(MarcasSeeder::class); 
        $this->call(ModelosSeeder::class);
        
        $this->call(VariacionSeeder::class);
        $this->call(ProductosSeeder::class); 
        $this->call(Producto_VariacionSeeder::class); //relacion mucho a mucho
        
        
        $this->call(CodigoSeeder::class);  // ultimo
        $this->call(DescripcionSeeder::class); // ultimo
        $this->call(photoSeeder::class);  // ultimo
        */

    }
}
