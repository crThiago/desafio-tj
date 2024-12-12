import HttpClient from "../http/HttpClient";

export default class RelatorioGateway {
    constructor(private httpClient: HttpClient) {}

    async index(params?: any): Promise<any> {
        return await this.httpClient.get('/api/relatorio', { params });
    }
}
