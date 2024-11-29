import axios from "axios";

export default {
    data() {
        return {
            // Bạn có thể thêm các thuộc tính data chung ở đây
        };
    },
    methods: {
        async callApi(method, url, data = {}) {
            
            try {
              const response = await axios({
                method: method,
                url   : url,
                data  : data,
              });
                
              return response.data;  // Trả về dữ liệu API
            } catch (error) {
              console.error("API Error:", error);
              return error.response;  // Trả về lỗi nếu có
            }
        },
    }
};
