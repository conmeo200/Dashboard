export default {
    data() {
        return {
            // Bạn có thể thêm các thuộc tính data chung ở đây
        };
    },
    methods: {
        callApi(method, url, data) {
            try {
                axios({
                    method: method,
                    url: url,
                    data: data,
                });
            } catch (error) {
                return error.response;
            }
        }
    },
};
