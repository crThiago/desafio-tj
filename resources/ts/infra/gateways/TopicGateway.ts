import HttpClient from "../http/HttpClient";

export default class TopicGateway {
    constructor(private httpClient: HttpClient) {}

    async show(id: number): Promise<any> {
        return await this.httpClient.get(`/api/assunto/${id}`);
    }

    async index(params?: any): Promise<any> {
        return await this.httpClient.get('/api/assunto', { params });
    }

    async store(data: any): Promise<any> {
        return await this.httpClient.post('/api/assunto', data);
    }

    async update(id: number, data: any): Promise<any> {
        return await this.httpClient.put(`/api/assunto/${id}`, data);
    }

    async destroy(id: number): Promise<any> {
        return await this.httpClient.delete(`/api/assunto/${id}`);
    }
}
