document.addEventListener('DOMContentLoaded', () => {
    const block = {
        phone: '',
        init() {
            const input = document.querySelector('input[name=phone]');
            input.addEventListener('keydown', e => this.inputKeyDown(e));
        },
        inputKeyDown(event) {
            if (Number(event.key) && event.target.value.length < 12) {
                this.phone += event.key;
                this.phone.value = this.changeFirstNum(this.phone.value);
            }
            event.target.value = this.phone;
        },
        changeFirstNum(str) {
            if (str.charAt(0) === '8') {
                return str.replace('8', '+7');
            }
            return str;
        }
    }
    block.init();
});