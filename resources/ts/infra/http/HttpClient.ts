import axios from "axios";
import store from "../../plugins/store";
export default interface HttpClient {
    get (url: string, config?: any): Promise<any>;
    post (url: string, body: any): Promise<any>;
    put (url: string, body: any): Promise<any>;
    delete (url: string): Promise<any>
}

export class AxiosAdapter implements HttpClient {
    private api;

    constructor() {
        this.api = axios.create({
            baseURL: window.location.origin,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        this.api.interceptors.response.use(
            this.interceptSuccess,
            this.interceptError
        );
    }

    async get(url: string, config?: any): Promise<any> {
        const response = await this.api.get(url, config);
        return response.data;
    }

    async post(url: string, body: any): Promise<any> {
        const response = await this.api.post(url, body);
        return response.data;
    }

    async put(url: string, body: any): Promise<any> {
        const response = await this.api.put(url, body);
        return response.data;
    }

    async delete(url: string): Promise<any> {
        const response = await this.api.delete(url)
        return response.data
    }

    private interceptSuccess(response: any) {
        if (response.status === 200 || response.status === 201) {
            const method = response.config.method; // Retorna 'post', 'put', 'delete', etc.
            if (method === 'post') {
                store.commit('alert/show', {
                    message: 'Cadastro realizado com sucesso.',
                    type: 'success'
                })
            } else if (method === 'put') {
                store.commit('alert/show', {
                    message: 'Cadastro atualizado com sucesso.',
                    type: 'success'
                })
            } else if (method === 'delete') {
                store.commit('alert/show', {
                    message: 'Cadastro excluído com sucesso.',
                    type: 'success'
                })
            }
        }

        return response;
    }

    private interceptError(error: any) {
        return Promise.reject(error);
    }
}
