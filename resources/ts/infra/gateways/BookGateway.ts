import HttpClient from "../http/HttpClient";

export default class BookGateway {
    constructor(private httpClient: HttpClient) {}

    async show(id: number): Promise<any> {
        return await this.httpClient.get(`/api/livro/${id}`);
    }

    async index(params?: any): Promise<any> {
        return await this.httpClient.get('/api/livro', { params });
    }

    async store(data: any): Promise<any> {
        return await this.httpClient.post('/api/livro', data);
    }

    async update(id: number, data: any): Promise<any> {
        return await this.httpClient.put(`/api/livro/${id}`, data);
    }

    async destroy(id: number): Promise<any> {
        return await this.httpClient.delete(`/api/livro/${id}`);
    }
}
