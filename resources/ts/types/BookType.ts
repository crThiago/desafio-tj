export type BookForm = {
    Codl: number | null,
    Titulo: string | null,
    Editora: string | null,
    AnoPublicacao: string | null,
    Valor: number | null,
    Autores: number[] | null,
    Assuntos: number[] | null,
    errors: any[],
}
