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
      $user->name = "admin";
      $user->Paterno = "admin";
      $user->Materno = "admin";
      $user->Ci = "000000";
      $user->Expedido = "userprueba";
      $user->Celular = "000000";
      $user->Genero = "userprueba";
      $user->Cargo = "userprueba";
      $user->Lugar_Designado = "userprueba";
      $user->perfil = "/storage/perfiles/perfilmas.jpg";
      $user->Estado = "userprueba";
      $user->email = "admin@gob.bo";
      // $user->Password = Hash::make('adminadmin');
      $user->Password = Hash::make('adminadmin');
      $user->save();
   }
}
