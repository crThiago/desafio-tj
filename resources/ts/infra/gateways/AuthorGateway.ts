import HttpClient from "../http/HttpClient";

export default class AuthorGateway {
    constructor(private httpClient: HttpClient) {}

    async show(id: number): Promise<any> {
        return await this.httpClient.get(`/api/autor/${id}`);
    }

    async index(params?: any): Promise<any> {
        return await this.httpClient.get('/api/autor', { params });
    }

    async store(data: any): Promise<any> {
        return await this.httpClient.post('/api/autor', data);
    }

    async update(id: number, data: any): Promise<any> {
        return await this.httpClient.put(`/api/autor/${id}`, data);
    }

    async destroy(id: number): Promise<any> {
        return await this.httpClient.delete(`/api/autor/${id}`);
    }
}
