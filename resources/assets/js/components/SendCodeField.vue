<template>
    <div class="form-group">
        <div class="form-group" :class="{'has-error': errorPhone}">
            <label for="phone" class="col-md-4 control-label">手机号码</label>

            <div class="col-md-4">
                <input type="text" class="form-control" name="phone" v-model="phone" required>

                <span class="help-block" v-show="errorPhone">
                    <strong>{{errorPhone}}</strong>
                </span>
            </div>
        </div>

        <label for="code" class="col-md-4 control-label">验证码</label>

        <div class="col-md-2">
            <input type="text" class="form-control" name="code" v-model="code" required>
            <span class="help-block" v-show="errorCode">
                <strong>{{errorCode}}</strong>
            </span>
        </div>
        <div class="col-md-2">
            <button type="button"
                    class="btn btn-default"
                    :class="{disabled: counter !== 0}"
                    @click="sendCode">
                发送验证码
                <span v-show="counter > 0">({{counter}})</span>
            </button>
        </div>
    </div>
</template>
<script>
    export default{
        name: 'sendCodeField',
        props: [],
        data () {
        return {
            phone: null,
            code: null,
            counter: 0
        }
    },
    computed: {
        errorPhone () {
            if (this.phone == null || this.checkPhone(this.phone)) {
                return false
            }

            return '手机号码不正确！';
        },
        errorCode () {
            if (this.code == null || this.code.length == 4) {
                return false
            }

            return '4 位验证码'
        }
    },
    methods: {
        startCount (value = 60) {
            this.counter = value

            var self = this
            var clock = setInterval(function () {
                if (self.counter === 0) {
                    clearInterval(clock)
                    return
                }
                self.counter -= 1
            }, 1000)
        },
        sendCode () {
            if (this.phone == null || this.counter > 0 || !this.checkPhone(this.phone)) {
                return
            }

            var self = this
            this.$http.post('/api/phone/code', {phone: this.phone})
                    .then(function (response) {
                        self.startCount()
                    })
                    .then(function (error) {
                        console.log(error)
                    })
        },
        checkPhone: function (phone) {
            return !!phone.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/)
        }
    }
    }
</script>