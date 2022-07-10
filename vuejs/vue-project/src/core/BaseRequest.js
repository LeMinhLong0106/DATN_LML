const apiUrl = 'http://localhost:8000/api/';
import axios from "axios";
export default {
    getHeader() {
        let token = localStorage.getItem('token');
        if (token == null) {
            return {};
        }
        return {
            'Authorization': 'Bearer ' + token
        }
    },
    get(url) {
        return axios.get(apiUrl + url, {
            headers: this.getHeader()
        });
    },

    post(url, data) {
        return axios.post(apiUrl + url, data, {
            headers: this.getHeader()
        });
    },
    
    put(url, data) {
        return axios.put(apiUrl + url, data, {
            headers: this.getHeader()
        });
    },

    delete(url) {
        return axios.delete(apiUrl + url, {
            headers: this.getHeader()
        });
    },
}