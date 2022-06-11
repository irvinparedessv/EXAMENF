<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Hash;
use \App\Models\User;
use App\Models\Vendedor;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user=  User::create([
            'name' => 'auditor',
            'email' => 'auditor@yopmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $role = Role::create(['name' => 'Auditor']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

        $user2=  User::create([
            'name' => 'vendedor',
            'email' => 'vendedor@yopmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $role2 = Role::create(['name' => 'Vendedor']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role2->syncPermissions($permissions);
     
        $user2->assignRole([$role2->id]);

        $user3=  User::create([
            'name' => 'vendedor2',
            'email' => 'vendedor2@yopmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user3->assignRole([$role2->id]);
        $user4=  User::create([
            'name' => 'vendedor3',
            'email' => 'vendedor3@yopmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user4->assignRole([$role2->id]);
        $user5=  User::create([
            'name' => 'vendedor4',
            'email' => 'vendedor4@yopmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user5->assignRole([$role2->id]);
        $user6=  User::create([
            'name' => 'vendedor5',
            'email' => 'vendedor5@yopmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user6->assignRole([$role2->id]);
        $vendedor=Vendedor::create([
            'dui' => '111111-1',
            'nit' => '21212121212-1',
            'direccion' => 'desssss',
            'id_usuario' => $user2->id
        ]);
        $vendedor2=Vendedor::create([
            'dui' => '111111-1',
            'nit' => '21212121232-0',
            'direccion' => 'desssss',
            'id_usuario' => $user3->id
        ]);
        $vendedor3=Vendedor::create([
            'dui' => '111113-1',
            'nit' => '212131212-1',
            'direccion' => 'desssss',
            'id_usuario' => $user4->id
        ]);
        $vendedor4=Vendedor::create([
            'dui' => '111141-1',
            'nit' => '212123212-1',
            'direccion' => 'desssss',
            'id_usuario' => $user5->id
        ]);
        $vendedor4=Vendedor::create([
            'dui' => '111141-0',
            'nit' => '212123212-1',
            'direccion' => 'desssss',
            'id_usuario' => $user6->id
        ]);

     Product::create([
            'nombre' => 'COMPU',
            'direccion' => 'desssss',
            'precio_unitario'=> 20,
            'existencia'=>10,
            'garantia'=>10,
            'id_vendedor' => $vendedor->id
        ]);
        Product::create([
            'nombre' => 'COMPU2',
            'direccion' => 'desssss',
            'precio_unitario'=> 20,
            'existencia'=>10,
            'garantia'=>10,
            'id_vendedor' => $vendedor->id
        ]);
        Product::create([
            'nombre' => 'COMPU3',
            'direccion' => 'desssss',
            'precio_unitario'=> 20,
            'existencia'=>10,
            'garantia'=>10,
            'id_vendedor' => $vendedor->id
        ]);
        Product::create([
            'nombre' => 'COMPU4',
            'direccion' => 'desssss',
            'precio_unitario'=> 20,
            'existencia'=>10,
            'garantia'=>10,
            'id_vendedor' => $vendedor2->id
        ]);
        Product::create([
            'nombre' => 'COMPU5',
            'direccion' => 'desssss',
            'precio_unitario'=> 20,
            'existencia'=>10,
            'garantia'=>10,
            'id_vendedor' => $vendedor2->id
        ]);


    }
}
