import axios from "axios";

export default {
    data() {
        return {
           prefix_url: 'http://localhost.nginx/'
       }  
    },
    methods: {
        async callApi(method, endpoint, data = {}, recaptcha = false) {
            
            const url = this.prefix_url + endpoint;

            try {                
                // if (recaptcha && (method === 'POST' || method === 'PUT')) {
                    
                //     const token = await grecaptcha.execute('6LecCp4qAAAAAH8z5ECCqPg1tmK7pw9v1vWgt_GJ', { action: 'submit_form' });
        
                //     if (!data || typeof data !== 'object') {
                //         data = {};
                //     }
                
                //     data['token'] = token;
                // }
                
                const response = await axios({
                    method: method,
                    url   : url,
                    data  : data,
                });
        
                if (response && response.data)
                    return response.data;
                else {
                    this.error('System Error');
                    return;
                }                    
            } catch (error) {
                console.error("API Error:", error);
                //return error.response;
            }
        },  
    }
};
