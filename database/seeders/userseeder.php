<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userseeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {


      $user = new User();
      $user->name = "Wilson";
      $user->Paterno = "Viracocha";
      $user->Materno = "Laura";
      $user->Ci = "8377140";
      $user->Expedido = "LP";
      $user->Celular = "75838914";
      $user->Genero = "M";
      $user->Cargo = "Administrador";
      $user->Lugar_Designado = "Alcaldia";
      $user->perfil = "/storage/perfiles/perfilmas.jpg";
      $user->Estado = "superUsuario";
      $user->email = "wilson@gob.bo";
      // $user->Password = Hash::make('adminadmin');
      $user->Password = Hash::make('wilsmith');
      $user->assignRole('Administrador');
      $user->save();


      $user = new User();
      $user->name = "francisco";
      $user->Paterno = "Quispe";
      $user->Materno = "Mamani";
      $user->Ci = "000000";
      $user->Expedido = "LP";
      $user->Celular = "000000";
      $user->Genero = "userprueba";
      $user->Cargo = "Admin";
      $user->Lugar_Designado = "Alcaldia";
      $user->perfil = "/storage/perfiles/perfilmas.jpg";
      $user->Estado = "superUsuario";
      $user->email = "francisco@gob.bo";
      // $user->Password = Hash::make('adminadmin');
      $user->Password = Hash::make('fr4nch3sco');
      $user->assignRole('Admin');
      $user->save();
   }
}
