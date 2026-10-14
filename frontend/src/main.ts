import './assets/main.css'

import { createApp } from 'vue'
import Root from './Root.vue'
import router from './router/index'

createApp(Root).use(router).mount('#app')
