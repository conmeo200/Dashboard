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
            if (typeof desc === "object" && desc !== null) {
                // Duyệt qua các key-value trong Object
                Object.entries(desc).forEach(([key, value]) => {
                    this.$Notice.error({
                        title: title, // Đính kèm key nếu cần
                        desc: value, // Hiển thị từng giá trị
                    });
                });
            } else {
                this.$Notice.error({
                    title: title,
                    desc: desc, // Nếu không phải Object, hiển thị trực tiếp
                });
            }
        },
    },
};
