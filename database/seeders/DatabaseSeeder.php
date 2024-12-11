<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar autores
        $autores = [
            ['Nome' => 'J.K. Rowling'],
            ['Nome' => 'J.R.R. Tolkien'],
            ['Nome' => 'George Orwell'],
            ['Nome' => 'Jane Austen'],
            ['Nome' => 'Mark Twain'],
            ['Nome' => 'Agatha Christie'],
            ['Nome' => 'Stephen King'],
            ['Nome' => 'Leo Tolstoy'],
            ['Nome' => 'Gabriel García Márquez'],
            ['Nome' => 'Harper Lee'],
            ['Nome' => 'Ernest Hemingway'],
            ['Nome' => 'F. Scott Fitzgerald'],
            ['Nome' => 'Charles Dickens'],
            ['Nome' => 'Victor Hugo'],
            ['Nome' => 'Homer'],
            ['Nome' => 'Mary Shelley'],
            ['Nome' => 'Bram Stoker'],
            ['Nome' => 'Arthur Conan Doyle'],
            ['Nome' => 'J.D. Salinger'],
            ['Nome' => 'Emily Brontë'],
        ];
        DB::table('Autor')->insert($autores);

        // Criar assuntos
        $assuntos = [
            ['Descricao' => 'Fantasia'],
            ['Descricao' => 'Distopia'],
            ['Descricao' => 'Romance'],
            ['Descricao' => 'Clássico'],
            ['Descricao' => 'Suspense'],
            ['Descricao' => 'Ficção Científica'],
            ['Descricao' => 'História'],
            ['Descricao' => 'Drama'],
            ['Descricao' => 'Aventura'],
            ['Descricao' => 'Mistério'],
        ];
        DB::table('Assunto')->insert($assuntos);


        // Criar livros
        $livros = [
            ['Titulo' => 'Harry Potter e a Pedra Filosofal', 'Editora' => 'Bloomsbury', 'AnoPublicacao' => '1997', 'Valor' => 39.90],
            ['Titulo' => 'O Senhor dos Anéis: A Sociedade do Anel', 'Editora' => 'Allen & Unwin', 'AnoPublicacao' => '1954', 'Valor' => 49.90],
            ['Titulo' => '1984', 'Editora' => 'Secker & Warburg', 'AnoPublicacao' => '1949', 'Valor' => 29.90],
            ['Titulo' => 'Orgulho e Preconceito', 'Editora' => 'T. Egerton', 'AnoPublicacao' => '1813', 'Valor' => 19.90],
            ['Titulo' => 'As Aventuras de Tom Sawyer', 'Editora' => 'American Publishing Company', 'AnoPublicacao' => '1876', 'Valor' => 24.90],
            ['Titulo' => 'E Não Sobrou Nenhum', 'Editora' => 'Collins Crime Club', 'AnoPublicacao' => '1939', 'Valor' => 34.90],
            ['Titulo' => 'O Iluminado', 'Editora' => 'Doubleday', 'AnoPublicacao' => '1977', 'Valor' => 44.90],
            ['Titulo' => 'Guerra e Paz', 'Editora' => 'The Russian Messenger', 'AnoPublicacao' => '1869', 'Valor' => 59.90],
            ['Titulo' => 'Cem Anos de Solidão', 'Editora' => 'Editorial Sudamericana', 'AnoPublicacao' => '1967', 'Valor' => 39.90],
            ['Titulo' => 'O Sol é Para Todos', 'Editora' => 'J.B. Lippincott & Co.', 'AnoPublicacao' => '1960', 'Valor' => 27.90],
            ['Titulo' => 'O Velho e o Mar', 'Editora' => "Charles Scribner's Sons", 'AnoPublicacao' => '1952', 'Valor' => 39.90],
            ['Titulo' => 'O Grande Gatsby', 'Editora' => "Charles Scribner's Sons", 'AnoPublicacao' => '1925', 'Valor' => 49.90],
            ['Titulo' => 'Um Conto de Duas Cidades', 'Editora' => 'Chapman & Hall', 'AnoPublicacao' => '1859', 'Valor' => 29.90],
            ['Titulo' => 'Os Miseráveis', 'Editora' => 'A. Lacroix, Verboeckhoven & Cie.', 'AnoPublicacao' => '1862', 'Valor' => 19.90],
            ['Titulo' => 'Ilíada', 'Editora' => 'Desconhecida', 'AnoPublicacao' => '1800', 'Valor' => 24.90],
            ['Titulo' => 'Frankenstein', 'Editora' => 'Lackington', 'AnoPublicacao' => '1818', 'Valor' => 34.90],
            ['Titulo' => 'Drácula', 'Editora' => 'Archibald Constable and Company', 'AnoPublicacao' => '1897', 'Valor' => 44.90],
            ['Titulo' => 'As Aventuras de Sherlock Holmes', 'Editora' => 'George Newnes Ltd', 'AnoPublicacao' => '1892', 'Valor' => 59.90],
            ['Titulo' => 'O Apanhador no Campo de Centeio', 'Editora' => 'Little, Brown and Company', 'AnoPublicacao' => '1951', 'Valor' => 39.90],
            ['Titulo' => 'O Morro dos Ventos Uivantes', 'Editora' => 'Thomas Cautley Newby', 'AnoPublicacao' => '1847', 'Valor' => 27.90],
            // Outros 20 livros fictícios para completar
            ['Titulo' => 'A Máquina do Tempo', 'Editora' => 'William Heinemann', 'AnoPublicacao' => '1895', 'Valor' => 39.90],
            ['Titulo' => 'Os Três Mosqueteiros', 'Editora' => "Baudry's European Library", 'AnoPublicacao' => '1844', 'Valor' => 49.90],
            ['Titulo' => 'Moby Dick', 'Editora' => 'Richard Bentley', 'AnoPublicacao' => '1851', 'Valor' => 29.90],
            ['Titulo' => 'Crime e Castigo', 'Editora' => 'The Russian Messenger', 'AnoPublicacao' => '1866', 'Valor' => 19.90],
            ['Titulo' => 'O Nome da Rosa', 'Editora' => 'Bompiani', 'AnoPublicacao' => '1980', 'Valor' => 24.90],
            ['Titulo' => 'A Revolução dos Bichos', 'Editora' => 'Secker & Warburg', 'AnoPublicacao' => '1945', 'Valor' => 34.90],
            ['Titulo' => 'O Pequeno Príncipe', 'Editora' => 'Reynal & Hitchcock', 'AnoPublicacao' => '1943', 'Valor' => 44.90],
            ['Titulo' => 'Duna', 'Editora' => 'Chilton Books', 'AnoPublicacao' => '1965', 'Valor' => 59.90],
            ['Titulo' => 'O Hobbit', 'Editora' => 'George Allen & Unwin', 'AnoPublicacao' => '1937', 'Valor' => 39.90],
            ['Titulo' => 'Alice no País das Maravilhas', 'Editora' => 'Macmillan', 'AnoPublicacao' => '1865', 'Valor' => 27.90],
            ['Titulo' => 'Os Irmãos Karamazov', 'Editora' => 'The Russian Messenger', 'AnoPublicacao' => '1880', 'Valor' => 39.90],
            ['Titulo' => 'O Conde de Monte Cristo', 'Editora' => 'Desconhecida', 'AnoPublicacao' => '1844', 'Valor' => 49.90],
            ['Titulo' => 'O Retrato de Dorian Gray', 'Editora' => 'Ward, Lock & Co.', 'AnoPublicacao' => '1890', 'Valor' => 29.90],
            ['Titulo' => 'A Metamorfose', 'Editora' => 'Desconhecida', 'AnoPublicacao' => '1915', 'Valor' => 19.90],
            ['Titulo' => 'Os Sofrimentos do Jovem Werther', 'Editora' => 'Desconhecida', 'AnoPublicacao' => '1774', 'Valor' => 24.90],
            ['Titulo' => 'Ulisses', 'Editora' => 'Shakespeare and Company', 'AnoPublicacao' => '1922', 'Valor' => 34.90],
            ['Titulo' => 'Madame Bovary', 'Editora' => 'Revue de Paris', 'AnoPublicacao' => '1856', 'Valor' => 44.90],
            ['Titulo' => 'O Médico e o Monstro', 'Editora' => 'Longmans, Green & Co.', 'AnoPublicacao' => '1886', 'Valor' => 59.90],
            ['Titulo' => 'Fahrenheit 451', 'Editora' => 'Ballantine Books', 'AnoPublicacao' => '1953', 'Valor' => 39.90],
            ['Titulo' => 'O Processo', 'Editora' => 'Desconhecida', 'AnoPublicacao' => '1925', 'Valor' => 27.90],
            ['Titulo' => 'Coração das Trevas', 'Editora' => "Blackwood's Magazine", 'AnoPublicacao' => '1899', 'Valor' => 39.90],
        ];
        DB::table('Livro')->insert($livros);

        // Relacionar livros e autores
        $livrosAutores = [
            ['Livro_Codl' => 1, 'Autor_CodAu' => 1],
            ['Livro_Codl' => 2, 'Autor_CodAu' => 2],
            ['Livro_Codl' => 3, 'Autor_CodAu' => 3],
            ['Livro_Codl' => 4, 'Autor_CodAu' => 4],
            ['Livro_Codl' => 5, 'Autor_CodAu' => 5],
            ['Livro_Codl' => 6, 'Autor_CodAu' => 6],
            ['Livro_Codl' => 7, 'Autor_CodAu' => 7],
            ['Livro_Codl' => 8, 'Autor_CodAu' => 8],
            ['Livro_Codl' => 9, 'Autor_CodAu' => 9],
            ['Livro_Codl' => 10, 'Autor_CodAu' => 10],
            ['Livro_Codl' => 11, 'Autor_CodAu' => 11],
            ['Livro_Codl' => 12, 'Autor_CodAu' => 12],
            ['Livro_Codl' => 13, 'Autor_CodAu' => 13],
            ['Livro_Codl' => 14, 'Autor_CodAu' => 14],
            ['Livro_Codl' => 15, 'Autor_CodAu' => 15],
            ['Livro_Codl' => 16, 'Autor_CodAu' => 16],
            ['Livro_Codl' => 17, 'Autor_CodAu' => 17],
            ['Livro_Codl' => 18, 'Autor_CodAu' => 18],
            ['Livro_Codl' => 19, 'Autor_CodAu' => 19],
            ['Livro_Codl' => 20, 'Autor_CodAu' => 20],
            ['Livro_Codl' => 21, 'Autor_CodAu' => 1],
            ['Livro_Codl' => 22, 'Autor_CodAu' => 2],
            ['Livro_Codl' => 23, 'Autor_CodAu' => 3],
            ['Livro_Codl' => 24, 'Autor_CodAu' => 4],
            ['Livro_Codl' => 25, 'Autor_CodAu' => 5],
            ['Livro_Codl' => 26, 'Autor_CodAu' => 6],
            ['Livro_Codl' => 27, 'Autor_CodAu' => 7],
            ['Livro_Codl' => 28, 'Autor_CodAu' => 8],
            ['Livro_Codl' => 29, 'Autor_CodAu' => 9],
            ['Livro_Codl' => 30, 'Autor_CodAu' => 10],
            ['Livro_Codl' => 31, 'Autor_CodAu' => 11],
            ['Livro_Codl' => 32, 'Autor_CodAu' => 12],
            ['Livro_Codl' => 33, 'Autor_CodAu' => 13],
            ['Livro_Codl' => 34, 'Autor_CodAu' => 14],
            ['Livro_Codl' => 35, 'Autor_CodAu' => 15],
            ['Livro_Codl' => 36, 'Autor_CodAu' => 16],
            ['Livro_Codl' => 37, 'Autor_CodAu' => 17],
            ['Livro_Codl' => 38, 'Autor_CodAu' => 18],
            ['Livro_Codl' => 39, 'Autor_CodAu' => 19],
            ['Livro_Codl' => 40, 'Autor_CodAu' => 20],
        ];
        DB::table('Livro_Autor')->insert($livrosAutores);

        // Relacionar livros e assuntos
        $livrosAssuntos = [
            ['Livro_Codl' => 1, 'Assunto_CodAs' => 1],
            ['Livro_Codl' => 2, 'Assunto_CodAs' => 1],
            ['Livro_Codl' => 3, 'Assunto_CodAs' => 2],
            ['Livro_Codl' => 4, 'Assunto_CodAs' => 3],
            ['Livro_Codl' => 5, 'Assunto_CodAs' => 7],
            ['Livro_Codl' => 6, 'Assunto_CodAs' => 5],
            ['Livro_Codl' => 7, 'Assunto_CodAs' => 5],
            ['Livro_Codl' => 8, 'Assunto_CodAs' => 7],
            ['Livro_Codl' => 9, 'Assunto_CodAs' => 3],
            ['Livro_Codl' => 10, 'Assunto_CodAs' => 3],
            ['Livro_Codl' => 11, 'Assunto_CodAs' => 6],
            ['Livro_Codl' => 12, 'Assunto_CodAs' => 4],
            ['Livro_Codl' => 13, 'Assunto_CodAs' => 7],
            ['Livro_Codl' => 14, 'Assunto_CodAs' => 3],
            ['Livro_Codl' => 15, 'Assunto_CodAs' => 8],
            ['Livro_Codl' => 16, 'Assunto_CodAs' => 6],
            ['Livro_Codl' => 17, 'Assunto_CodAs' => 5],
            ['Livro_Codl' => 18, 'Assunto_CodAs' => 9],
            ['Livro_Codl' => 19, 'Assunto_CodAs' => 3],
            ['Livro_Codl' => 20, 'Assunto_CodAs' => 3],
            ['Livro_Codl' => 21, 'Assunto_CodAs' => 10],
            ['Livro_Codl' => 22, 'Assunto_CodAs' => 1],
            ['Livro_Codl' => 23, 'Assunto_CodAs' => 2],
            ['Livro_Codl' => 24, 'Assunto_CodAs' => 3],
            ['Livro_Codl' => 25, 'Assunto_CodAs' => 7],
            ['Livro_Codl' => 26, 'Assunto_CodAs' => 5],
            ['Livro_Codl' => 27, 'Assunto_CodAs' => 6],
            ['Livro_Codl' => 28, 'Assunto_CodAs' => 8],
            ['Livro_Codl' => 29, 'Assunto_CodAs' => 9],
            ['Livro_Codl' => 30, 'Assunto_CodAs' => 3],
            ['Livro_Codl' => 31, 'Assunto_CodAs' => 4],
            ['Livro_Codl' => 32, 'Assunto_CodAs' => 2],
            ['Livro_Codl' => 33, 'Assunto_CodAs' => 7],
            ['Livro_Codl' => 34, 'Assunto_CodAs' => 6],
            ['Livro_Codl' => 35, 'Assunto_CodAs' => 5],
            ['Livro_Codl' => 36, 'Assunto_CodAs' => 8],
            ['Livro_Codl' => 37, 'Assunto_CodAs' => 9],
            ['Livro_Codl' => 38, 'Assunto_CodAs' => 10],
            ['Livro_Codl' => 39, 'Assunto_CodAs' => 1],
            ['Livro_Codl' => 40, 'Assunto_CodAs' => 4],
        ];
        DB::table('Livro_Assunto')->insert($livrosAssuntos);
    }
}
