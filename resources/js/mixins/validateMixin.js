export default {
    data() {
        return {
            // Bạn có thể thêm các thuộc tính data chung ở đây
        };
    },
    methods: {
        validateValue(name, value) {
            if (!value) return this.error('Field ' + name + ' is required!');

            return true;
        },
        validateIsJson(name, value) {
            if (!value) return this.error('Field ' + name + ' is required!');

            try {
                JSON.parse(value); 
            } catch (e) {
                return this.error('Field ' + name + ' must be a valid JSON!');
            }
        
            return true;
        },
        validateIsUrl(name, value) {
            if (!value) {
                return this.error('Field ' + name + ' is required!');
            }
        
            try {
                new URL(value);
            } catch (e) {
                return this.error('Field ' + name + ' must be a valid URL!');
            }
        
            return true;
        }
    },
};
