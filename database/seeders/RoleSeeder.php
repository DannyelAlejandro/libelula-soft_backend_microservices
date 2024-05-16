<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creacion de roles
        $roleAdmin = Role::create([ 'name' => 'ADMIN', 'alias' => 'Administrador' ]);
        $roleAuthor = Role::create([ 'name' => 'AUTHORS', 'alias' => 'Autores' ]);
        $roleBook = Role::create([ 'name' => 'BOOKS', 'alias' => 'Libros' ]);

        // Access
        Permission::create([ 'name' => 'users.index', 'alias' => 'Inicio usuarios', 'description' => 'Visualizar usuarios' ])->syncRoles($roleAdmin);
        Permission::create([ 'name' => 'users.create', 'alias' => 'Crear usuarios', 'description' => '' ])->syncRoles($roleAdmin);
        Permission::create([ 'name' => 'users.update', 'alias' => 'Editar usuarios', 'description' => '' ])->syncRoles($roleAdmin);
        Permission::create([ 'name' => 'users.destroy', 'alias' => 'Eliminar usuarios', 'description' => '' ])->syncRoles($roleAdmin);

        // Microservices
        Permission::create([ 'name' => 'authors.index', 'alias' => 'Inicio Autores', 'description' => 'Visualizar autores' ])->syncRoles($roleAdmin, $roleAuthor);
        Permission::create([ 'name' => 'authors.show', 'alias' => 'Ver Autor', 'description' => '' ])->syncRoles($roleAdmin, $roleAuthor, $roleBook);
        Permission::create([ 'name' => 'authors.create', 'alias' => 'Crear Autores', 'description' => '' ])->syncRoles($roleAdmin, $roleAuthor);
        Permission::create([ 'name' => 'authors.update', 'alias' => 'Editar Autores', 'description' => '' ])->syncRoles($roleAdmin, $roleAuthor);
        Permission::create([ 'name' => 'authors.destroy', 'alias' => 'Eliminar Autores', 'description' => '' ])->syncRoles($roleAdmin, $roleAuthor);

        Permission::create([ 'name' => 'books.index', 'alias' => 'Inicio Libros', 'description' => 'Visualizar libros' ])->syncRoles($roleAdmin, $roleBook, $roleAuthor);
        Permission::create([ 'name' => 'books.show', 'alias' => 'Ver Libro', 'description' => '' ])->syncRoles($roleAdmin, $roleBook, $roleAuthor);
        Permission::create([ 'name' => 'books.create', 'alias' => 'Crear Libros', 'description' => '' ])->syncRoles($roleAdmin, $roleBook);
        Permission::create([ 'name' => 'books.update', 'alias' => 'Editar Libros', 'description' => '' ])->syncRoles($roleAdmin, $roleBook);
        Permission::create([ 'name' => 'books.destroy', 'alias' => 'Eliminar Libros', 'description' => '' ])->syncRoles($roleAdmin, $roleBook);
    }
}
