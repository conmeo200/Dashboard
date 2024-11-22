export default {
    data() {
        return {
            // Bạn có thể thêm các thuộc tính data chung ở đây
        };
    },
    methods: {
        info(desc, title = "Hey") {
            this.$Notice.info({
                title: title,
                desc : desc,
            });
        },
        success(desc, title = "Great!") {
            this.$Notice.success({
                title: title,
                desc : desc,
            });
        },
        warning(desc, title = "Warning!") {
            this.$Notice.warning({
                title: title,
                desc : desc,
            });
        },
        error(desc, title = "Oops!") {
            this.$Notice.error({
                title: title,
                desc : desc,
            });
        },
    },
};
