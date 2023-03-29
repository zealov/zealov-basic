import Vue from "vue";
import router from '~/router'
import store from '~/store'
import ElementUI from 'element-ui';
import App from '~/components/App'

Vue.use(ElementUI);
Vue.prototype.$Bus = new Vue();
Vue.config.productionTip = false
new Vue({
    store,
    router,
    ...App
})
