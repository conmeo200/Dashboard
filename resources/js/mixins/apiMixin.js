import axios from "axios";

export default {
    data() {
        return {};
    },
  
    methods: {
        async callApi(method, url, data = {}, recaptcha = false) {
            try {
                console.log(this.$recaptchaSiteKey); 
                if (recaptcha && (method === 'POST' || method === 'PUT')) {
                    
                    const token = await grecaptcha.execute('6LecCp4qAAAAAH8z5ECCqPg1tmK7pw9v1vWgt_GJ', { action: 'submit_form' });
        
                    if (!data || typeof data !== 'object') {
                        data = {};
                    }
                
                    data['token'] = token;
                }
                
                const response = await axios({
                    method: method,
                    url   : url,
                    data  : data,
                });
        
                return response.data;
            } catch (error) {
                console.error("API Error:", error);
                return error.response;
            }
        },  
    }
};
