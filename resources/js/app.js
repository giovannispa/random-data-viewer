import './bootstrap';
import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router/index'

// import the package
import VueAwesomePaginate from "vue-awesome-paginate";

// import the necessary css file
import "vue-awesome-paginate/dist/style.css";


const app = createApp(App)

app.use(router)
app.use(VueAwesomePaginate);
app.mount('#app')
