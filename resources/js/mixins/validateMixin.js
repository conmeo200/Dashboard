export default {
    data() {
        return {
            // Bạn có thể thêm các thuộc tính data chung ở đây
        };
    },
    methods: {
        validateParam(value) {
            if (!value) return this.error('Data Invalid');

            return true;
        },
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
        },
        numberOnly(event, maxLength, leadingZero = true, allowDecimal = false) {
            let value = event.target.value;

            if (allowDecimal) {
                value = value.replace(/[^0-9.]/g, '');

                let parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
            } else {
                value = value.replace(/[^0-9]/g, '');
            }

            if (!leadingZero) {
                if (value.startsWith('0') && value.length > 1 && (allowDecimal ? value[1] !== '.' : true)) {
                    value = value.replace(/^0+/, '');
                }
            }

            if (maxLength && value.length > maxLength) {
                value = value.slice(0, maxLength);
            }

            this.price = value;
        }
    },
};
